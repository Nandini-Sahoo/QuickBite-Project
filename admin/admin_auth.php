<?php
session_start();
require_once "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $qry = "SELECT * FROM admin WHERE admin_name = ? AND admin_email = ?";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: admin_login.php?error=Invalid credentials");
        exit();
    }

    $admin = $result->fetch_assoc();

    if ($password !== $admin['admin_pwd']) {
        header("Location: admin_login.php?error=Wrong password");
        exit();
    }

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_id'] = $admin['admin_id'];
    $_SESSION['admin_name'] = $admin['admin_name'];
    $_SESSION['admin_email'] = $admin['admin_email'];
    $_SESSION['admin_ph_no'] = $admin['admin_ph_no'];
    $_SESSION['admin_doj'] = $admin['admin_doj'];
    $_SESSION['admin_img'] = $admin['admin_img'];

    header("Location: admin_dashboard.php");
    exit();
}
?>