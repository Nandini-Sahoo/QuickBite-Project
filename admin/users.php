<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$qry="SELECT * FROM users";
$stmt=$con->prepare($qry);
$stmt->execute();
$res=$stmt->get_result();
?>
<h1 class="text-center text-decoration-underline my-3" style="color: #7209b7;">REGISTERED USERS</h1>
<table class="table table-primary table-striped mx-auto w-50 shadow p-3 mb-5 bg-body-tertiary rounded">
    <tr>
        <th>#</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Phone Number</th>
        <th></th>
    </tr>
    <?php
        $i=1;
        while($data=$res->fetch_assoc()){
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $data['user_id']; ?></td>
        <td><?php echo $data['user_name']; ?></td>
        <td><?php echo $data['user_ph_no']; ?></td>
        <td>
        <a class="btn" style="background-color: #adc178;" href="user_details.php?id=<?php echo $data['user_id'];
        ?>">Details</a>
        </td>
    </tr>
    <?php }
    $con->close();
    ?>
</table>