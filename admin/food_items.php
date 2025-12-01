<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';

$qry="SELECT * FROM food_items";
$stmt=$con->prepare($qry);
$stmt->execute();
$res=$stmt->get_result();
?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Manage Food Menu</h2>
        <a href="add_item.php" class="btn shadow-sm" style="background-color: #52b788;"><i class="bi bi-plus-circle"></i> Add Item
        </a>
    </div>

    <div class="card shadow-lg border-0">
            <table class="table table-hover align-middle shadow-lg border-0">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Item ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Available</th>
                    <th>Image</th>
                    <th>Rating</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $i=1;
                while($data=$res->fetch_assoc()){
                ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $data['item_id']; ?></td>
                    <td><?php echo $data['item_name']; ?></td>
                    <td><?php echo $data['item_desc']; ?></td>
                    <td>₹ <?= $data['item_prc']; ?></td>
                    <td>
                        <span class="badge bg-info text-dark"><?php echo $data['item_cat']; ?></span>
                    </td>

                    <td>
                        <?php if($data['is_available']) { ?>
                            <span class="badge bg-success">Yes</span>
                        <?php } else {?>
                            <span class="badge bg-danger">No</span>
                            <?php } ?>
                    </td>

                    <td>
                        <?php if ($data["item_img"] == null) { ?>
                            <span class="text-muted">No Image</span>
                        <?php } else ?>
                            <img src="../upload_img/<?php echo $data['item_img']; ?>" class="img-thumbnail rounded" style="width:70px; height:70px; object-fit:cover">
                    </td>

                    <td>
                        <span class="badge bg-warning text-dark"><?= $data['item_rating']; ?> ★</span>
                    </td>

                    <td>
                        <a href="update.php?id=<?php echo $data['item_id']; ?>" class="btn btn-sm btn-primary mb-2 w-100">Update</a>

                        <a href="item_delete.php?id=<?php echo $data['item_id']; ?>" class="btn btn-sm btn-danger w-100">Delete</a>
                    </td>
                </tr>
                <?php } ?>
                </tbody>

            </table>
    </div>
</div>

<?php $con->close(); ?>
