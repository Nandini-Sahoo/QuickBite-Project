<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
if(!isset($_GET['id']))
header('location: food_items.php');
$id=$_GET['id'];
$qry="DELETE FROM food_items WHERE item_id=?";
$stmt=$con->prepare($qry);
$stmt->bind_param("i",$id);
$stmt->execute();
if($con->affected_rows > 0){
?>
<script>
alert("Item Deleted!");
window.location = "food_items.php";
</script>
<?php } else {?>
<script>
alert("Item Not Deleted!");
window.location = "food_items.php";
</script>
<?php
}
$con->close();
?>