<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$qry="SELECT * FROM orders";
$stmt=$con->prepare($qry);
$stmt->execute();
$res=$stmt->get_result();
?>
<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Orders</h2>
    </div>
    <table class="table table-hover align-middle shadow-lg border-0">
        <thead class="table-dark">
        <tr>
        <th>#</th>
        <th>Order No.</th>
        <th>Customer No.</th>
        <th>Price</th>
        <th>Status</th>
        <th>Action</th>
        </tr>
        </thead>
    <?php
        $i=1;
        while($data=$res->fetch_assoc()){
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $data['order_id']; ?></td>
        <td><?php echo $data['user_id']; ?></td>
        <td><?php echo $data['total_amount']; ?></td>
        <td><?php echo $data['order_status']; ?></td>
        <td>
        <a class="btn" style="background-color: #adc178;" href="order_details.php?id=<?php echo $data['order_id'];
        ?>">Details</a>
        </td>
    </tr>
    <?php }
    $con->close();
     ?>
</table>
</div>