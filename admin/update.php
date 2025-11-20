<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
if(!isset($_GET['id']))
header('location: food_items.php');
$id=$_GET['id'];
$qry="SELECT * FROM food_items WHERE item_id = ?";
$stmt=$con->prepare($qry);
$stmt->bind_param("i",$id);
$stmt->execute();
$res=$stmt->get_result();
if($res->num_rows > 0){
$data=$res->fetch_assoc();
?>
<div class="container">
<h2 class="text-primary">UPDATE ITEM: <?php echo $data['item_id']; ?></h2>
<form action="update_item.php" method="post" class="border border-2 border-opacity-50 shadow p-3 mb-5 mx-auto w-50 rounded add-form" enctype="multipart/form-data">
    <input type="hidden" class="form-control" name="id" value="<?php echo $data['item_id'] ?>">
    <div class="mb-3">
        <label class="form-label">Item Name:</label>
        <input type="text" class="form-control" name="name" value="<?php echo $data['item_name'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Description:</label>
        <textarea name="desc" class="form-control"><?php echo $data['item_desc'] ?></textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Price:</label>
        <input type="text" class="form-control" name="price" value="<?php echo $data['item_prc'] ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="radio" value="Starters / Appetizers" name="category" <?php $data['item_cat'] === 'Starters / Appetizers'? print "checked": print "" ?>> Starters / Appetizers<br>
        <input type="radio" value="Main Course" name="category" <?php $data['item_cat'] === 'Main Course' ? print "checked": print "" ?>>Main Course<br>
        <input type="radio" value="Fast Food" name="category" <?php $data['item_cat'] === 'Fast Food' ? print "checked": print "" ?>>Fast Food<br>
        <input type="radio" value="Desserts" name="category" <?php $data['item_cat'] === 'Desserts'? print "checked": print "" ?>> Desserts<br>
        <input type="radio" value="Beverages / Drinks" name="category" <?php $data['item_cat'] === 'Beverages / Drinks'? print "checked": print "" ?>> Beverages / Drinks<br>
        <input type="radio" value="Salads" name="category" <?php $data['item_cat'] === 'Salads'? print "checked": print "" ?>> Salads<br>
    </div>
    <div class="mb-3">
        <label class="form-label">Availability:</label>
        <input type="text" class="form-control" name="available" value="<?php echo ($data['is_available'] == 1) ? 'Yes' : 'No'; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Rating:</label>
        <input type="text" class="form-control" name="rating" value="<?php echo $data['item_rating'] ?>">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
</div>
<?php }
$con->close();
?>