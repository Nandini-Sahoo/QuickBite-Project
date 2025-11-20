<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
if(!isset($_GET['order_id']))
header('location: orders.php');
$order_id=$_GET['order_id'];
$qry = "SELECT o.*, u.user_name, u.user_id, u.user_ph_no FROM orders o JOIN users u ON o.user_id = u.user_id WHERE o.order_id = ?";
$stmt = $con->prepare($qry);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$res = $stmt->get_result();

$qry_items = "SELECT f.item_name, f.item_prc, oi.quantity, oi.price FROM order_items oi JOIN food_items f ON oi.item_id = f.item_id WHERE oi.order_id = ?";
$stmt_items = $con->prepare($qry_items);
$stmt_items->bind_param("i", $order_id);
$stmt_items->execute();
$res_items = $stmt_items->get_result();

if ($res->num_rows > 0) {
    $order = $res->fetch_assoc();
?>
<div class="container mt-5">
    <div class="card p-4 shadow-lg">
        <h3 class="text-primary mb-3">Order Details (ID: <?php echo $order['order_id']; ?>)</h3>
        <p><strong>Customer Name:</strong> <?php echo $order['user_name']; ?></p>
        <p><strong>Customer ID:</strong> <?php echo $order['user_id']; ?></p>
        <p><strong>Phone:</strong> <?php echo $order['user_ph_no']; ?></p>
        <p><strong>Order Date:</strong> <?php echo $order['order_date']; ?></p>
        <p><strong>Status:</strong> <?php echo $order['order_status']; ?></p>

        <hr>
        <h5>Items Bought:</h5>
        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Subtotal (₹)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                while ($item = $res_items->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $item['item_name']; ?></td>
                        <td><?php echo $item['item_prc']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h5 class="text-end mt-3">Total Amount: <span class="fw-bold text-success">₹<?php echo $order['total_amount']; ?></span></h5>
    </div>
</div>
<?php
} else
echo "<h1 class='text-danger'>404: Invalid Order ID!</h1>";
$con->close();
?>