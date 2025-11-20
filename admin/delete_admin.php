<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
if(!isset($_GET['id']))
header('location: admin_controls.php');
$id=$_GET['id'];
$qry="DELETE FROM admin WHERE admin_id=?";
$stmt=$con->prepare($qry);
$stmt->bind_param("i",$id);
$stmt->execute();
if($con->affected_rows > 0){
?>
<script>
alert("Admin Deleted!");
window.location = "admin_controls.php";
</script>
<?php } else {?>
<script>
alert("Admin Not Deleted!");
window.location = "admin_controls.php";
</script>
<?php
}
$con->close();
?>