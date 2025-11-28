<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/bootstrap-icons.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #dae3edff;
            background: url("../images/admin_bgimg1.avif") no-repeat center center fixed;
            background-size: cover;
        }
        
    </style>
</head>
<body>
    <div class="d-flex justify-content-center mt-5">
    <div class="text-start border border-2 border-opacity-75 shadow p-5 mx-auto rounded"
         style="background: rgba(228, 224, 224, 0.2); backdrop-filter: blur(2px);">

        <img src="../images/<?php echo $_SESSION['admin_img'] ?>" alt="profile"
             width="200" height="200" class="img-fluid rounded mb-3">

        <h3>Name: <?php echo $_SESSION['admin_name'] ?></h3>
        <h4>Email: <?php echo $_SESSION['admin_email'] ?></h4>
        <h4>Phone No.: <?php echo $_SESSION['admin_ph_no'] ?></h4>
        <h4>Date Joined: <?php echo $_SESSION['admin_doj'] ?></h4>

        <a href="admin_dashboard.php" class="btn me-2" style="background-color: #52b788;">← Go Back</a>
        <a href="admin_logout.php" class="btn" style="background-color: #ff758f;">Log Out</a>
    </div>
    </div>
    <script src="../asset/bootstrap.bundle.min.js"></script>
</body>
</html>