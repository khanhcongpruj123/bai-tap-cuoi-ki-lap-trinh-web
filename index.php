<?php

session_start();

$user = $_SESSION['user'];

// var_dump($user);
if ($user != null && $user->role == "0") {
    header("Location: ./home.php");
}

//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "kmrdeveloper315";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);

$get_item_id_sql = "SELECT * FROM TBL_ITEM";
$id_item = mysqli_fetch_assoc($con->query($get_item_id_sql))['id'];

$result = $con->query($get_item_id_sql);

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>cuahangmaytinh</title>
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
        function buy(id) {
            window.location = "buy.php?id=" + id
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
        <div class="container"><a class="navbar-brand" href="index.php">iShop</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="order.php">Đơn hàng</a></li>
                </ul><span class="navbar-text actions"> <a class="login" href="signup.php">Đăng kí</a>
                    <?php

                    if ($user != null) {
                        echo "<a class=\"btn btn-light action-button\" role=\"button\" href=\"signout.php\">Đăng xuất</a></span></div>";
                    } else {
                        echo "<a class=\"btn btn-light action-button\" role=\"button\" href=\"signin.php\">Đăng nhập</a></span></div>";
                    }

                    ?>
            </div>
    </nav>
    <div class="article-list">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">iShop</h2>
                <p class="text-center">Chuyên cung cáp máy tính các loại</p>
            </div>

            <div class="row">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
            
                <div class=\"col-sm-6 col-md-4 item\"><a href=\"#\"><img class=\"img-thumbnail\" style=\"height: 200px\" src=\"./assets/".$row['thumnail']."\"></a>
                        <h3 class=\"name\">" . $row['name'] . "</h3>
                        <p class=\"description\">" . $row['price'] . "</p><button onclick=\"buy(".$row['id'].")\" type=\"button\" class=\"btn btn-primary\" href=\"#\"><i class=\"fas fa-cart-plus\"></i>\tMua ngay</i></a>
                    </div>

                ";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>