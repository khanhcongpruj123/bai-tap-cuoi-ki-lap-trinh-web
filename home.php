<?php

require_once('./user.php');
require_once('./account.php');

session_start();

$user = null;
if (isset($_SESSION['user'])) $user = $_SESSION['user'];
if ($user != null && $user->role == "1") {
    header("Location: ./index.php");
}

//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);
$user =  $_SESSION['user'];

$sql = "SELECT DISTINCT TBL_ORDER.id, TBL_ORDER.count, TBL_ORDER.status, TBL_ITEM.name, TBL_ORDER.date, TBL_USER.name as n, TBL_ITEM.price, TBL_ORDER.count, TBL_ORDER.address from TBL_ORDER, TBL_ITEM, TBL_USER WHERE TBL_ITEM.id=TBL_ORDER.item_id AND TBL_ORDER.user_id=TBL_USER.id ORDER BY TBL_ORDER.date";
$result = $con->query($sql);

$sql_is_shipped = "SELECT * FROM TBL_ORDER WHERE status=1";
$sql_is_not_shipped = "SELECT * FROM TBL_ORDER WHERE status=0";

$shipped = mysqli_num_rows($con->query($sql_is_shipped));
$not_shipped = mysqli_num_rows($con->query($sql_is_not_shipped));

$get_all_item_sql = "SELECT DISTINCT * FROM TBL_ITEM";
$all_item_result = $con->query($get_all_item_sql)

?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lí đơn hàng</title>
    <link href="./resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./resources/fontawesome/css/all.css" rel="stylesheet" type="text/css" />
    <link href="./css/float.css" rel="stylesheet" type="text/css" />
    <script src="./resources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <meta charset="utf-8" />
    <script>
        
        function deleteOrder(id) {
            $.ajax({
                type: "GET",
                url: "deleteorder.php?id=" + id,
                success: () => {
                    window.location.reload()
                }
            })
        }

        function sign_out() {
            $.ajax({
                type: "GET",
                url: "signout.php",
                success: () => {
                    window.location = "index.php"
                }
            })
        }

        function edit_order(id) {
            window.location = "editorder.php?id=" + id
        }
    </script>
</head>

<body>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="./assets/ic_order.png" alt="" width="30" height="24" class="d-inline-block align-top">
                Quản lí cửa hàng
            </a>
        </div>
    </nav>
    <div class="container" style="margin-top: 10px;">
        <div class="col">
            <div class="row">
                <div class="col col-lg-3 card">
                    <div class="text-center">Tên tài khoản: <strong><?= $user->name ?></strong></div>
                    <!-- <div class="row">
                        <a type="button" class="btn btn-outline-primary" href="./insertorder.php">Thêm đơn hàng</a>
                    </div> -->
                    <div class="row">
                        <button type="button" class="btn btn-outline-primary" onclick="sign_out()">Đăng xuất</button>
                    </div>
                </div>
                <div class="col">
                    <div class="card row" style="padding: 5px; margin-left: 5px">
                        <div class="row text-center">
                        <div class="col">
                            <div>Chưa giao</div>
                            <div style="color: red; font-size: 50px;"><?= $not_shipped?></div>
                        </div>
                        <div class="col">
                            <div>Đã giao</div>
                            <div style="color: green; font-size: 50px;"><?= $shipped?></div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row card" style="margin-top: 10px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Tên đơn hàng</th>
                            <th scope="col">Người mua</th>
                            <th scope="col">Ngày mua</th>
                            <th scope="col">Địa điểm giao hàng</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody id="table-item">
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $price = $row['price'] * $row['count'];
                            $status = "Chưa giao";
                            if ($row['status'] == 0) $status = "Chưa giao";
                            else $status = "Đã giao";
                            echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['n'] . "</td><td>". $row['date'] . "</td><td>" . $row['address'] . "</td><td>".$row['count']."</td><td>" . $price ."</td><td>".$status."</td><td><button type=\"button\" class=\"btn btn-light pmd-btn-fab pmd-ripple-effect\" onclick=\"deleteOrder(".$row['id'].")\"><i class=\"fas fa-times\"></i></button></td><td><button type=\"button\" class=\"btn btn-light pmd-btn-fab pmd-ripple-effect\" onclick=\"edit_order(".$row['id'].")\"><i class=\"fas fa-edit\"></i></button></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>