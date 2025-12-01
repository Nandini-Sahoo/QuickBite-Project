<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $available = $_POST['available'];
    $rating = $_POST['rating'];
    if($available === 'Yes')
        $avail = 1;
    else if($available === 'No')
        $avail = 0;
    $qry = "UPDATE food_items SET item_name=?, item_desc=?, item_prc=?, item_cat=?, is_available=?, item_rating=? WHERE $item_id=?";
    $stmt=$con->prepare($qry);
    if(!$stmt)
        echo $con->error;
    $stmt->bind_param("ssdsidi",$name, $desc, $price, $category, $avail, $rating, $id);
    if($stmt->execute()){
    ?>
    <script>
    alert('Item Updated!');
    window.location="food_items.php";
    </script>
    <?php
    } else echo "<h3 class='text-danger'>ERROR: ". $con->connect_error()."</h3>";
    $con->close();
}
?>