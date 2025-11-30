<?php
session_start();
require_once "dbcon.php";

$user_id = $_SESSION['user_id'];

mysqli_query($con, "DELETE FROM cart WHERE user_id = $user_id");

echo "done";
?>
