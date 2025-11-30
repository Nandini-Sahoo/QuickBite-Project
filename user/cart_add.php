<?php
include_once 'navbar.php';
require_once 'dbcon.php';

$user_id = $_SESSION['user_id'];
$item_id = $_POST['item_id'];

if (!$user_id) { die("User ID missing"); }

// check
$check = mysqli_query($con,
    "SELECT * FROM cart WHERE user_id=$user_id AND item_id=$item_id"
);

if (mysqli_num_rows($check) > 0) {

    if(!mysqli_query($con,
        "UPDATE cart SET quantity = quantity + 1 
         WHERE user_id=$user_id AND item_id=$item_id"
    )){
        echo mysqli_error($con);
        exit;
    }

} else {

    if(!mysqli_query($con,
        "INSERT INTO cart (user_id, item_id, quantity) VALUES ($user_id, $item_id, 1)"
    )){
        echo mysqli_error($con);
        exit;
    }
}
header("Location: cart.php");
exit;
?>
