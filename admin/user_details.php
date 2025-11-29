<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';

if(!isset($_GET['id'])){
    header("location: users.php");
    exit;
}

$user_id = $_GET['id'];

$qry = "SELECT * FROM users WHERE user_id = ?";
$stmt = $con->prepare($qry);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if(!$user){
    echo "<h2 class='text-center text-danger'>User not found!</h2>";
    exit;
}

$qry2 = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt2 = $con->prepare($qry2);
$stmt2->bind_param("i", $user_id);
$stmt2->execute();
$orders = $stmt2->get_result();
?>
<div class="container my-4">

    <h1 class="text-center mb-4" style="color:#7209b7;">USER DETAILS</h1>

    <div class="card shadow-lg mb-4 border-0">
        <div class="row g-0">
            <div class="col-md-3 text-center p-3">
                <img src="uploads/<?php echo $user['user_img']; ?>" 
                     class="img-fluid rounded-circle border" 
                     style="width:150px; height:150px; object-fit:cover;">
            </div>

            <div class="col-md-9">
                <div class="card-body">
                    <h3 class="card-title text-primary"><?php echo $user['user_name']; ?></h3>
                    <p><strong>Gender:</strong> <?php echo $user['user_gender']; ?></p>
                    <p><strong>DOB:</strong> <?php echo $user['user_dob']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $user['user_ph_no']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['user_email']; ?></p>
                    <p><strong>Address:</strong> <?php echo $user['user_address']; ?></p>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-3">Orders</h2>

    <?php
    if($orders->num_rows == 0){
        echo "<h4 class='text-center text-secondary'>No orders placed yet.</h4>";
    }

    while($order = $orders->fetch_assoc()) {
        $order_id = $order['order_id'];

        $qry3 = "SELECT oi.quantity, oi.price, fi.item_name, fi.item_img
                 FROM order_items oi 
                 JOIN food_items fi ON oi.item_id = fi.item_id
                 WHERE oi.order_id = ?";
        $stmt3 = $con->prepare($qry3);
        $stmt3->bind_param("i", $order_id);
        $stmt3->execute();
        $items = $stmt3->get_result();
    ?>

    <div class="card mb-4 shadow border-0">
        <div class="card-header bg-info text-white">
            <strong>Order ID:</strong> <?php echo $order['order_id']; ?> |
            <strong>Status:</strong> <?php echo $order['order_status']; ?> |
            <strong>Date:</strong> <?php echo $order['order_date']; ?>
        </div>

        <div class="card-body">
            <h5 class="mb-3">Order Items</h5>
            <table class="table table-bordered">
                <tr class="table-secondary">
                    <th>Item</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Price (₹)</th>
                </tr>

                <?php while($row = $items->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><img src="uploads/<?php echo $row['item_img']; ?>" 
                             style="width:60px; height:60px; object-fit:cover;"
                             class="rounded"></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                </tr>
                <?php } ?>
            </table>

            <h5 class="text-end">Total Amount: 
                <span class="text-success fw-bold">₹<?php echo $order['total_amount']; ?></span>
            </h5>
        </div>
    </div>

    <?php } ?>
</div>

<?php $con->close(); ?>