<?php

require_once('./user.php');
require_once('./account.php');

session_start();

if ($_SESSION['user'] == null) {
    header("Location: ./index.php");
}

$user = $_SESSION['user'];

//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "kmrdeveloper315";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);

$item = $_POST['item'];
$customer_name = $_POST['customer_name'];
$address = $_POST['address'];
$count = $_POST['count'];
$date = $_POST['date-order'];
$sex = $_POST['sex'];



if ($item != null) {
    $get_item_id_sql = "SELECT id FROM TBL_ITEM WHERE name='$item'";
    $id_item = mysqli_fetch_assoc($con->query($get_item_id_sql))['id'];
    
    $insert_customer_sql = "INSERT INTO TBL_CUSTOMER(id, name, address) VALUES(0, '".$customer_name."', '".$address."')";
    $con->query($insert_customer_sql);
    // var_dump($insert_customer_sql);

    $get_customer_id_sql = "SELECT id FROM TBL_CUSTOMER WHERE name='$customer_name'";
    $id_customer = mysqli_fetch_assoc($con->query($get_customer_id_sql))['id'];
    // var_dump($id_customer);

    $valid_date = date('Y-m-d H:i:s', $date);
    $insert_order_sql = "INSERT INTO TBL_ORDER(id, item_id, user_id, customer_id, count, address, date, status) VALUES(0, ".$id_item.", ".$user->id.", ".$id_customer.", ".$count.", '".$address."', '".$valid_date."', 0)";
    // var_dump($insert_order_sql);
    $con->query($insert_order_sql);
    header('Location: ./home.php');
}

$get_all_item_sql = "SELECT DISTINCT * FROM TBL_ITEM";
$all_item_result = $con->query($get_all_item_sql)

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
    <div class="container">
        <form action="#" method="POST">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="item-selection">Mặt hàng</label>
                    <select type="text" class="custom-select my-1 mr-sm-2 form-control" id="validationDefault01" name="item" required>
                        <?php

                        while ($row = mysqli_fetch_assoc($all_item_result)) {
                            echo "<option>";
                            echo "<img src=\"./assets/".$row['thumnail']."\">";
                            echo "<div>" . $row['name'] . "</div>";
                            echo "</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Tên khách hàng</label>
                    <input type="text" class="form-control" id="validationDefault01" name="customer_name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Địa chỉ</label>
                    <input type="text" class="form-control" id="validationDefault01" name="address" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Số lượng</label>
                    <input type="number" class="form-control" id="validationDefault01" name="count" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date-picker">Ngày mua</label>
                    <input type="date" class="form-control" id="date-picker" name="date-order">
                </div>
            </div>
            <div class="form-row">
                <button class="btn btn-secondary" type="button">Huỷ bỏ</button>
                <button class="btn btn-primary" type="submit">Lưu</button>
            </div>
        </form>
    </div>
</body>

</html>