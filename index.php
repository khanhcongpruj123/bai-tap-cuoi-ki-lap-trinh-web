<?php

    $username = $password = "";

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "khanh") {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
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