<?php
session_start();
require_once "dbcon.php";
$user_id = $_SESSION['user_id'];
if (!$user_id) {
    echo "error";
    exit;
}
// Calculate total amount
$sql = "SELECT c.quantity, f.item_prc FROM cart c JOIN food_items f ON c.item_id = f.item_id WHERE c.user_id = $user_id";
$res = mysqli_query($con, $sql);
$total_amount = 0;
while ($row = mysqli_fetch_assoc($res)) {
    $total_amount += $row['quantity'] * $row['item_prc'];
}
$date = date("Y-m-d H:i:s");
// Insert cancelled order
$insert = "INSERT INTO orders (user_id, total_amount, order_date, order_status)
           VALUES ($user_id, $total_amount, '$date', 'Cancelled')";
mysqli_query($con, $insert);
echo mysqli_insert_id($con);
?>
