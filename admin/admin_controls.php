<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$qry="SELECT * FROM admin";
$stmt=$con->prepare($qry);
$stmt->execute();
$res=$stmt->get_result();
?>
<div class="container">
    <h1 class="item-heading rounded p-1 mt-5">MANAGE ADMIN</h1>
    <a href="add_admin.php" class="btn add-btn">Add Admin</a>
    <h2 class="text-center text-decoration-underline my-3" style="color: #8f0aaaff;">ADMINS</h2>
    <table class="table table-primary table-striped mx-auto w-50 shadow p-3 mb-5 bg-body-tertiary rounded">
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Image</th>
            <th>Change Password</th>
            <th>Update Admin</th>
            <th>Delete Admin</th>
        </tr>
        <?php
            $i=1;
            while($data=$res->fetch_assoc()){
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $data['admin_name']; ?></td>
            <td><img src="../images/<?php echo $data['admin_img']; ?>" alt="profile" width="50" height="50" class="img-fluid rounded"></td>
            <td>
            <a href="chng_pwd.php?id=<?php echo $data['admin_id']; ?>"><img class="img-fluid rounded" src="../images/chngpwd.png" alt="img" width="50" height="50"></a>
            </td>
            <td>
            <a href="update_admin.php?id=<?php echo $data['admin_id']; ?>"><img class="img-fluid rounded" src="../images/update.webp" alt="img" width="50" height="50"></a>
            </td>
            <td>
            <a href="delete_admin.php?id=<?php echo $data['admin_id']; ?>"><img class="img-fluid rounded" src="../images/delete.png" alt="img" width="50" height="50"></a>
            </td>
        </tr>
        <?php }
        $con->close();
         ?>
    </table>
</div>