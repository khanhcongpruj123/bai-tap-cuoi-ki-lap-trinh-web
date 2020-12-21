<?php

require_once('./user.php');
require_once('./account.php');

session_start();

if ($_SESSION['user'] == null) {
    header("Location: ./index.php");
}

$user = $_SESSION['user'];
$item_id = $_GET['id'];


//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "kmrdeveloper315";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);

//get detail item
$get_item_detail_sql = "SELECT * FROM TBL_ITEM WHERE id=$item_id";
$item_detail = mysqli_fetch_assoc($con->query($get_item_detail_sql));


// handle post
$item = $_POST['item'];
$customer_name = $_POST['customer_name'];
$address = $_POST['address'];
$count = $_POST['count'];
$date = $_POST['date-order'];
$sex = $_POST['sex'];



if ($address != null) {
    $id_item = $item_detail['id'];
    // var_dump($insert_customer_sql);

    $valid_date = date('Y-m-d', strtotime($date));
    $insert_order_sql = "INSERT INTO TBL_ORDER(id, item_id, user_id, count, address, date, status) VALUES(0, " . $id_item . ", " . $user->id . ", " . $count . ", '" . $address . "', '" . $valid_date . "', 0)";
    // var_dump($insert_order_sql);
    $con->query($insert_order_sql);
    header('Location: ./index.php');
}

$get_all_item_sql = "SELECT DISTINCT * FROM TBL_ITEM";
$all_item_result = $con->query($get_all_item_sql)

?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lí đơn hàng</title>
    <!-- <link href="./resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link href="./resources/fontawesome/css/all.css" rel="stylesheet" type="text/css" />
    <!-- <script src="./resources/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <script src="./js/jquery.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Article-List.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script>
        function getDate(){
            alert('Ok')
            var today = new Date();
            document.getElementById("date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="#">iShop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <!-- <li class="nav-item"><a class="nav-link active" href="index.html">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Đơn hàng</a></li> -->
                </ul>
                <span class="navbar-text actions"> <a class="login" href="">Đăng kí</a>
                    <?php

                    if ($user != null) {
                        echo "<a class=\"btn btn-light action-button\" role=\"button\" href=\"signout.php\">Đăng xuất</a></span></div>";
                    } else {
                        echo "<a class=\"btn btn-light action-button\" role=\"button\" href=\"signin.php\">Đăng nhập</a></span></div>";
                    }

                    ?>
            </div>
    </nav>
    <div class="container">
        <form action="#" method="POST">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label for="item-selection">Mặt hàng</label>
                    <input type="text" class="form-control" id="item-selection" name="customer_name" value="<?= $item_detail['name'] ?>" disabled required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Tên khách hàng</label>
                    <input type="text" class="form-control" id="validationDefault01" name="customer_name" value="<?= $user->name ?>" disabled required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Địa chỉ</label>
                    <input type="text" class="form-control" id="validationDefault01" name="address" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="validationDefault01">Số lượng</label>
                    <input type="number" class="form-control" id="validationDefault01" name="count" value="1" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date-picker">Ngày mua</label>
                    <input type="date" class="form-control" id="date-picker" name="date-order" value="<? echo(date("Y-m-d")); ?>" id="date">
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