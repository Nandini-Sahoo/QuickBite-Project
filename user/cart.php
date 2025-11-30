<?php
include_once 'navbar.php';
require_once 'dbcon.php';

$user_id = $_SESSION['user_id'];

// Fetch cart items
$sql = "SELECT c.cart_id, c.quantity, f.item_name, f.item_prc, f.item_img
        FROM cart c 
        JOIN food_items f ON c.item_id = f.item_id
        WHERE c.user_id = $user_id";

$res = mysqli_query($con, $sql);
$item_count = mysqli_num_rows($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Cart</title>
</head>

<body class="bg-light">
<div class="container mt-4">
    
    <h3>Your Cart</h3>

    <?php if ($item_count == 0): ?>

        <!-- EMPTY CART MESSAGE -->
        <div class="alert alert-warning mt-4 text-center" style="font-size: 20px;">
            Cart is Empty!
        </div>

    <?php else: ?>

        <!-- CART TABLE -->
        <table class="table table-bordered mt-3 bg-white">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
            <?php 
            $grand_total = 0;
            while ($row = mysqli_fetch_assoc($res)):
                $total = $row['quantity'] * $row['item_prc'];
                $grand_total += $total;
            ?>
                <tr>
                    <td width="100"><img src="../upload_img/<?= $row['item_img']; ?>" width="80"></td>
                    <td><?= $row['item_name']; ?></td>
                    <td>₹<?= $row['item_prc']; ?></td>
                    <td><?= $row['quantity']; ?></td>
                    <td>₹<?= $total; ?></td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <!-- GRAND TOTAL -->
        <h4 class="text-end">Grand Total: ₹<?= $grand_total; ?></h4>

        <!-- PLACE ORDER BUTTON -->
        <button id="placeOrderBtn" class="btn btn-success mt-3">
            Place Order
        </button>

        <div id="orderMsg" class="alert alert-info mt-3 d-none">
            Order placed! Cart will be cleared in <span id="timer">10</span> seconds...
        </div>

    <?php endif; ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JS SECTION -->
<script>
$("#placeOrderBtn").click(function () {

    $("#orderMsg").removeClass("d-none");

    let sec = 10;
    let timer = setInterval(() => {
        sec--;
        $("#timer").text(sec);

        if (sec <= 0) {
            clearInterval(timer);

            $.post("clear_cart.php", function () {
    location.reload();
        });
        }
    }, 1000);
});
</script>

</body>
</html>
