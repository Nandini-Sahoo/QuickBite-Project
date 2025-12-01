<?php
session_start();
require_once "dbcon.php";

$user_id = $_SESSION['user_id'];

if (!$user_id) {
    echo "error";
    exit;
}

// Calculate total amount from cart
$sql = "SELECT c.item_id, c.quantity, f.item_prc 
        FROM cart c 
        JOIN food_items f ON c.item_id = f.item_id 
        WHERE c.user_id = $user_id";

$res = mysqli_query($con, $sql);

$total_amount = 0;
$cart_items = []; // store items for order_items


while ($row = mysqli_fetch_assoc($res)) {
    $total_amount += $row['quantity'] * $row['item_prc'];

    // Store item details for order_items insertion
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

// Insert into orders table
$date = date("Y-m-d H:i:s");
$insert = "INSERT INTO orders (user_id, total_amount, order_date, order_status) 
           VALUES ($user_id, $total_amount, '$date', 'Pending')";

mysqli_query($con, $insert);

// Get generated order_id
$order_id = mysqli_insert_id($con);

// 🔥 INSERT CART ITEMS INTO order_items TABLE
foreach ($cart_items as $ci) {

    $item_id = $ci['item_id'];
    $qty     = $ci['quantity'];
    $price   = $ci['price']; // price per item

    mysqli_query(
        $con,
        "INSERT INTO order_items (order_id, item_id, quantity, price)
         VALUES ($order_id, $item_id, $qty, $price)"
    );
}

// You can clear cart here if needed
// mysqli_query($con, "DELETE FROM cart WHERE user_id=$user_id");

echo $order_id;
?>
