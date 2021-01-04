<?php

require_once('./account.php');
require_once('./user.php');

session_start();

$username = $password = "";

$username = $_POST["username"];
$password = $_POST["password"];
$confirm = $_POST['confirm'];
$name = $_POST['name'];
$sex = $_POST['sex'];

//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);

if ($username != null && $password == $confirm) {
    $create_account_sql = "INSERT TBL_ACCOUNT(id, username, password) VALUES(0, '$username', '$password')";
    $con->query($create_account_sql);

    $get_id_sql = "SELECT id FROM TBL_ACCOUNT WHERE username='$username' AND password='$password'";
    $id_account = mysqli_fetch_assoc($con->query($get_id_sql))['id'];

    if ($sex == "Nam") $sex = 0;
    else $sex = 1;
    $create_user_sql = "INSERT INTO TBL_USER(id, name, sex, id_account, role) VALUES(0, '$name', $sex, $id_account, 1)";
    $con->query($create_user_sql);
    header("Location: signin.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>iShop</title>
    <link href="./resources/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="./resources/fontawesome/css/fontawesome.min.css" rel="stylesheet" type="text/css" />
    <link href="./css/signin.css" rel="stylesheet" type="text/css" />
    <script src="./resources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <meta charset="utf-8" />
</head>

<body class="text-center">
    <main class="form-signin">
        <form action="" method="POST">
            <img class="mb-4" src="./assets/ic_order.png" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">iShop</h1>
            <label for="input_username" class="visually-hidden">Tên đăng nhập</label>
            <input type="text" id="input_username" class="form-control" placeholder="Tên đăng nhập" required autofocus name="username">
            <label for="input_password" class="visually-hidden">Mật khẩu</label>
            <input type="password" id="input_password" class="form-control" placeholder="Mật khẩu" required name="password">
            <label for="input_confirm" class="visually-hidden">Xác nhận</label>
            <input type="password" id="input_confirm" class="form-control" placeholder="Xác nhận" required name="confirm">
            <label for="input_name" class="visually-hidden">Tên</label>
            <input type="password" id="input_name" class="form-control" placeholder="Tên" required name="name">
            <label for="input_name" class="visually-hidden">Tên</label>
            <select type="password" id="input_name" class="custom-select my-1 mr-sm-2 form-control" required name="sex">
                <option>Nam</option>
                <option>Nữ</option>
            </select>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Đăng kí</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
        </form>
    </main>
</body>

</html>