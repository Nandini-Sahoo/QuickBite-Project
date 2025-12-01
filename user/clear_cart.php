<?php
session_start();
require_once "dbcon.php";

$user_id = $_SESSION['user_id'];
$order_id = $_POST['order_id'];
mysqli_query($con,"UPDATE orders SET order_status = 'Confirmed' WHERE order_id = $order_id");
mysqli_query($con,"DELETE FROM cart WHERE user_id = $user_id");
echo "done";
?>
