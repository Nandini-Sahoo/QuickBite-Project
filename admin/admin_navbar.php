<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}
$name=$_SESSION['admin_name'];
$img=$_SESSION['admin_img'];
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
          background: url("../images/admin_bgimg2.jpeg") no-repeat center center fixed;
          background-size: cover;
        }
        .head{
          background: linear-gradient(90deg, #168aad, #76c893);
        }
        .order_details{
          color: #22333b;
        }
        .item-heading{
          color: #023e8a;
          background-color: #ade8f4;
        }
        .add-btn{
          color: #ffffff;
          background-color: #4361ee;
        }
        .new-item{
          color: #b5179e;
          background-color: #ffccd5;
        }
        .add-form{
          border-color: #2a9d8f !important;
          background: radial-gradient(circle at center, #a8dadc, #fcddf2);

        }
        .box{
          background: radial-gradient(circle at center, #a3cef1, #b8c0ff);
          box-shadow: 0 4px 15px rgba(0, 0, 0, 0.6);
        }
        h5{
          color: #540d6e !important;
        }
    </style>
</head>
<body>
    <nav class="head navbar navbar-expand-lg border-bottom border-body shadow" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand mx-4" href="admin_profile.php">
      <img src="../images/<?php echo $img ?>" alt="profile" width="60" height="60" class="d-block align-text-top rounded-circle">
      <?php echo $name ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav gap-5">
        <li class="nav-item ms-5">
          <a class="btn btn-outline-light" aria-current="page" href="admin_dashboard.php"><i class="bi bi-ui-radios-grid me-2"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" aria-current="page" href="users.php"><i class="bi bi-people me-2"></i> User Details</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" aria-current="page" href="food_items.php"><i class="bi bi-fork-knife me-2"></i> Food Items</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" aria-current="page" href="orders.php"><i class="bi bi-list-ul me-2"></i> Orders</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-outline-light" aria-current="page" href="admin_controls.php"><i class="bi bi-person-gear me-2"></i> Admin Control</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <script src="../asset/bootstrap.bundle.min.js"></script>
    <script src="../asset/jquery-3.7.1.min.js"></script>
</body>
</html>