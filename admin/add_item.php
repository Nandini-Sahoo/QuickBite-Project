<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$msg="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$item_name = $_POST['item_name'];
$desc = $_POST['desc'];
$price = $_POST['price'];
$category = $_POST['category'];
$rating = $_POST['rating'];

$file_name = $_FILES['item_img']['name'];
$new_name =  time()."-".$file_name;
$tmp_location = $_FILES['item_img']['tmp_name'];
$upload_path = "../upload_img/$new_name";

if(move_uploaded_file($tmp_location, $upload_path)){
    $qry="INSERT INTO food_items (item_name, item_desc, item_prc, item_cat, item_img, item_rating) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt=$con->prepare($qry);
    $stmt-> bind_param("ssdssd",$item_name, $desc, $price, $category, $new_name, $rating);
    if($stmt->execute()){
            $msg = "New Item Added!";
        } else {
            $msg = $conn->error;
        }
    } else {
        $msg = "Error: ".$_FILES['item_img']['error'];
    }
$con->close();
}
?>
<div class="container">
<a href="food_items.php" class="btn mt-5" style="background-color: #a7c957;">← Go Back</a>
<h2 class="new-item rounded mt-5 p-2">ADD NEW FOOD ITEM</h2>
<h3 class="text-success text-center fw-bold"><?php echo $msg; ?></h3>
<form action="add_item.php" method="post" class="border border-2 border-opacity-50 shadow p-3 mb-5 mx-auto w-50 rounded add-form" enctype="multipart/form-data" onsubmit="validateForm(event)">
    <div class="mb-3">
    <label class="form-label">Item Name:</label>
    <input type="text" class="form-control" name="item_name" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Description:</label><br>
    <textarea name="desc" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
    <label class="form-label">Price:</label>
    <input type="text" class="form-control" name="price" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Category:</label><br>
    <input type="radio" value="Starters / Appetizers" name="category" required> Starters / Appetizers<br>
    <input type="radio" value="Main Course" name="category" required> Main Course<br>
    <input type="radio" value="Fast Food" name="category" required> Fast Food<br>
    <input type="radio" value="Desserts" name="category" required> Desserts<br>
    <input type="radio" value="Beverages / Drinks" name="category" required> Beverages / Drinks<br>
    <input type="radio" value="Salads" name="category" required> Salads<br>
    </div>
    <div class="mb-3">
    <label class="form-label">Upload Image:</label>
    <input type="file" class="form-control" name="item_img" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Rating:</label>
    <input type="text" class="form-control" name="rating" required>
    </div>
    <button type="submit" class="btn" style="background-color: #e4c1f9;">Add + </button>
</form>
