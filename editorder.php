<?php

require_once('./user.php');
require_once('./account.php');

session_start();

if ($_SESSION['user'] == null) {
    header("Location: ./index.php");
}

$id_order = $_GET['id'];

$user = $_SESSION['user'];

//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);

$item = $customer_name = $address = $count = $date = $sex = null;
$status = null;
if (isset($_POST['item'])) $item = $_POST['item'];
if (isset($_POST['customer_name'])) $customer_name = $_POST['customer_name'];
if (isset($_POST['address'])) $address = $_POST['address'];
if (isset($_POST['count'])) $count = $_POST['count'];
if (isset($_POST['date-order'])) $date = $_POST['date-order'];
if (isset($_POST['sex'])) $sex = $_POST['sex'];
if (isset($_POST['status'])) {
    $status = 0;
    if ($_POST['status'] == 'Đã giao') $status = 1;
}


if ($item != null) {

    $get_user_id_sql = "SELECT TBL_USER.id FROM TBL_USER, TBL_ORDER WHERE TBL_USER.id=TBL_ORDER.user_id AND TBL_ORDER.id=$id_order";
    $user_id = mysqli_fetch_assoc($con->query($get_user_id_sql))['id'];

    $get_item_id_sql = "SELECT id FROM TBL_ITEM WHERE name='$item'";
    $id_item = mysqli_fetch_assoc($con->query($get_item_id_sql))['id'];

    $con->query("DELETE FROM TBL_ORDER WHERE id=$id_order");

    $valid_date = date('Y-m-d', strtotime($date));
    $insert_order_sql = "INSERT INTO TBL_ORDER(id, item_id, user_id, count, address, date, status) VALUES(0, " . $id_item . ", " . $user_id . ", " . $count . ", '" . $address . "', '" . $valid_date . "', " . $status . ")";
    // var_dump($insert_order_sql);
    $con->query($insert_order_sql);
    header('Location: ./home.php');
}

$get_all_item_sql = "SELECT DISTINCT * FROM TBL_ITEM";
$all_item_result = $con->query($get_all_item_sql);

$sql = "SELECT DISTINCT TBL_ORDER.id, TBL_ORDER.status, TBL_USER.name as n, TBL_ITEM.name, TBL_ORDER.date, TBL_ITEM.price, TBL_ORDER.count, TBL_ORDER.address from TBL_ORDER, TBL_ITEM, TBL_USER WHERE TBL_USER.id={$user->id} AND TBL_ITEM.id=TBL_ORDER.item_id AND TBL_ORDER.id=$id_order";
$result = mysqli_fetch_assoc($con->query($sql));

?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lí đơn hàng</title>
    <link href="./resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./resources/fontawesome/css/all.css" rel="stylesheet" type="text/css" />
    <script src="./resources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <meta charset="utf-8" />
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
    <div class="container">
        <form action="#" method="POST">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="item-selection">Mặt hàng</label>
                    <select type="text" class="custom-select my-1 mr-sm-2 form-control" id="item-selection" name="item" required>
                        <?php

                        while ($row = mysqli_fetch_assoc($all_item_result)) {
                            if ($row['name'] == $result['name']) {
                                echo "<option selected>";
                            } else {
                                echo "<option>";
                            }
                            echo "<img src=\"./assets/" . $row['thumnail'] . "\">";
                            echo "<div>" . $row['name'] . "</div>";
                            echo "</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Tên khách hàng</label>
                    <input type="text" class="form-control" id="validationDefault01" name="customer_name" value="<?= $result['n'] ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Địa chỉ</label>
                    <input type="text" class="form-control" id="validationDefault01" value="<?= $result['address'] ?>" name="address" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Số lượng</label>
                    <input type="number" class="form-control" id="validationDefault01" value="<?= $result['count'] ?>" name="count" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date-picker">Ngày mua</label>
                    <input type="date" class="form-control" id="date-picker" value="<?= $result['date'] ?>" name="date-order">
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="item-status">Trạng thái</label>
                <select type="text" class="custom-select my-1 mr-sm-2 form-control" id="item-status" name="status" required>
                    <option>Chưa giao</option>
                    <?php
                    if ($result['status'] == 1) {
                        echo "<option selected>Đã giao</option>";
                    } else {
                        echo "<option>Đã giao</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-row">
                <button class="btn btn-secondary" type="button">Huỷ bỏ</button>
                <button class="btn btn-primary" type="submit">Lưu</button>
            </div>
        </form>
    </div>
</body>

</html>