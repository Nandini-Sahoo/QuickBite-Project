<?php
session_start();
require_once "dbcon.php";

$user_id = $_SESSION['user_id'];

if (!$user_id) {
    echo "error";
    exit;
}

$sql = "SELECT c.item_id, c.quantity, f.item_prc FROM cart c JOIN food_items f ON c.item_id = f.item_id WHERE c.user_id = $user_id";
$res = mysqli_query($con, $sql);

$total_amount = 0;
$cart_items = [];

while ($row = mysqli_fetch_assoc($res)) {
    $total_amount += $row['quantity'] * $row['item_prc'];
    $cart_items[] = [
        "item_id" => $row['item_id'],
        "quantity" => $row['quantity'],
        "price" => $row['item_prc']
    ];
}

if ($total_amount <= 0) {
    echo "error";
    exit;
}

$date = date("Y-m-d H:i:s");
$insert = "INSERT INTO orders (user_id, total_amount, order_date, order_status) VALUES ($user_id, $total_amount, '$date', 'Pending')";

mysqli_query($con, $insert);

$order_id = mysqli_insert_id($con);

foreach ($cart_items as $ci) {

    $item_id = $ci['item_id'];
    $qty = $ci['quantity'];
    $price = $ci['price'];

    mysqli_query($con,"INSERT INTO order_items (order_id, item_id, quantity, price) VALUES ($order_id, $item_id, $qty, $price)");
}
echo $order_id;
?>
