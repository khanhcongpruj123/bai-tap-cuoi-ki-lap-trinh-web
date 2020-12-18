<?php

    require_once('./account.php');
    require_once('./user.php');

    session_start();

    $username = $password = "";

    $username = $_POST["username"];
    $password = $_POST["password"];

    //create connection
    $db_server = "127.0.0.1";
    $db_username = "root";
    $db_password = "kmrdeveloper315";
    $db_name = "quanlidonhang";

    $con = new mysqli($db_server, $db_username, $db_password, $db_name);
    $sql = "SELECT * FROM TBL_ACCOUNT WHERE username='$username' AND password='$password'";
    $result = $con->query($sql);

    if (mysqli_num_rows($result) == 1) {
        $acc = mysqli_fetch_assoc($result);
        $id = $acc['id'];
        $sql2 = "SELECT * FROM TBL_USER WHERE id_account=$id";
        $result2 = $con->query($sql2);
        $u = mysqli_fetch_assoc($result2);
        
        $account = new Account($acc['id'], $acc['username'], $acc['password']);
        $user = new User($u['id'], $u['name'], $u['sex'], $account);

        $_SESSION['user'] = $user;
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lí đơn hàng</title>
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
            <h1 class="h3 mb-3 fw-normal">Quản lí đơn hàng</h1>
            <label for="inputEmail" class="visually-hidden">Tên đăng nhập</label>
            <input type="text" id="input_username" class="form-control" placeholder="Tên đăng nhập" required autofocus
                name="username">
            <label for="inputPassword" class="visually-hidden">Mật khẩu</label>
            <input type="password" id="input_password" class="form-control" placeholder="Password" required
                name="password">
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Nhớ mật khẩu
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Đăng nhập</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
        </form>
    </main>
</body>

</html>