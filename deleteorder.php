<?php

require_once('./user.php');
require_once('./account.php');

session_start();

if ($_SESSION['user'] == null) {
    header("Location: ./index.php");
}


$id = $_GET['id'];
$user = $_SESSION['user'];

//create connection
$db_server = "127.0.0.1";
$db_username = "root";
$db_password = "kmrdeveloper315";
$db_name = "quanlidonhang";

$con = new mysqli($db_server, $db_username, $db_password, $db_name);
$sql = "DELETE FROM TBL_ORDER WHERE id=$id";
// var_dump($sql);
$con->query($sql);
$sql2 = "SELECT DISTINCT TBL_ORDER.id, TBL_ORDER.status, TBL_ITEM.name, TBL_ORDER.date, TBL_CUSTOMER.name as n, TBL_ITEM.price, TBL_ORDER.count, TBL_ORDER.address from TBL_ORDER, TBL_CUSTOMER, TBL_ITEM, TBL_USER WHERE TBL_USER.id={$user->id} AND TBL_ITEM.id=TBL_ORDER.item_id AND TBL_CUSTOMER.id=TBL_ORDER.customer_id";
$result = $con->query($sql2);

while ($row = mysqli_fetch_assoc($result)) {
    $price = $row['price'] * $row['count'];
    $status = "Chưa giao";
    if ($row['status'] == 0) $status = "Chưa giao";
    else $status = "Đã giao";
    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td><td>" . $row['n'] . "</td><td>". $row['date'] . "</td><td>" . $row['address'] . "</td><td>" . $price ."</td><td>".$status."</td><td><button type=\"button\" class=\"btn btn-light pmd-btn-fab pmd-ripple-effect\" onclick=\"deleteOrder(".$row['id'].")\"><i class=\"fas fa-times\"></i></button></td></tr>";
}
?>
