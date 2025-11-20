<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$qry="SELECT * FROM orders";
$stmt=$con->prepare($qry);
$stmt->execute();
$res=$stmt->get_result();
?>
<h1 class="text-center text-decoration-underline my-3" style="color: #0077b6;">ORDERS</h1>
<table class="table table-primary table-striped mx-auto w-50 shadow p-3 mb-5 bg-body-tertiary rounded">
    <tr>
        <th>#</th>
        <th>Order No.</th>
        <th>Customer No.</th>
        <th>Price</th>
        <th>Status</th>
    </tr>
    <?php
        $i=1;
        while($data=$res->fetch_assoc()){
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $data['order_id']; ?></td>
        <td><?php echo $data['user_id']; ?></td>
        <td><?php echo $data['total_amout']; ?></td>
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