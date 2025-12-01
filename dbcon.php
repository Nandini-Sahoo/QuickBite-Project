<?php
$HOST = "localhost";
$USER = "root";
$PASSWORD = "";
$DB = "quickbite";
$PORT = 3307;
$con = new mysqli($HOST, $USER, $PASSWORD, $DB, $PORT);
// $con = new mysqli($HOST, $USER, $PASSWORD, $DB);
if($con->connect_error)
    die ("ERROR: ".$con->connect_error);
?>