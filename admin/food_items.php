<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$qry="SELECT * FROM food_items";
$stmt=$con->prepare($qry);
$stmt->execute();
$res=$stmt->get_result();
?>
<div class="container">
    <h1 class="item-heading mt-5 p-1 rounded">MANAGE FOOD MENU</h1>
    <a href="add_item.php" class="btn add-btn mb-4">Add Item</a>
    <table class="table table-primary table-striped mx-auto shadow p-3 mb-5 bg-body-tertiary rounded">
        <tr>
        <th>#</th>
        <th>Item ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Category</th>
        <th>Avalability</th>
        <th>Image</th>
        <th>Rating</th>
        <th colspan="2">Operations</th>
    </tr>
    <?php
        $i=1;
        while($data=$res->fetch_assoc()){
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $data['item_id']; ?></td>
        <td><?php echo $data['item_name']; ?></td>
        <td><?php echo $data['item_desc']; ?></td>
        <td><?php echo $data['item_prc']; ?></td>
        <td><?php echo $data['item_cat']; ?></td>
        <td><?php $data['is_available'] ? print "Yes" : print "No"; ?></td>
        <td>
            <?php
                if ($data["item_img"] == null)
                    echo "No image available";
                else {
                ?>
                    <img src="../upload_img/<?php echo $data['item_img'] ?>" class="img-fluid">
            <?php } ?>
        </td>
        <td><?php echo $data['item_rating']; ?></td>
        <td>
        <td>
        <a class="btn" style="background-color: #fcbf49;" href="update.php?id=<?php echo $data['item_id'];
        ?>">Update</a>
        </td>
        <td>
        <a class="btn" style="background-color: #ff758f;" href="item_delete.php?id=<?php echo $data['item_id'];
        ?>">Delete</a>
        </td>
    </tr>
    <?php }
    $con->close();
     ?>
    </table>
</div>