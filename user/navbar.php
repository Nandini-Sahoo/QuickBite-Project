<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quickbite | navbar</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/bootstrap-icons.min.css">
    <style>
      body{
        font-family: "Poppins", sans-serif;
        background-color: #FFD6D7 !important;
      }
      .menu-card { border-radius: 15px; overflow: hidden; transition: 0.2s; }
      .menu-card:hover { transform: scale(1.03); }
      .cat-btn { margin-right: 10px; }
      .nav-link{
        color: #000;
        font-weight: bold;
      }
      .nav-link:hover{
        color: #fff;
        text-decoration: underline;
      }
      .profile-card{
        background: rgba(255,255,255,0.82);
        padding: 30px;
        border-radius: 12px;
        max-width: 600px;
        margin: 50px auto;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.3);
      }
      .profile-img{
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 4px solid #c40000;
        object-fit: cover;
      }
      .btn-update{
        background: #c40000;
        color: white;
        font-weight: 500;
      }
      .navbar-brand { color: #ff6b35; font-weight: bold; }
      .food-card { border-radius: 12px; box-shadow: 0 6px 18px rgba(0,0,0,0.08); background: #fff; overflow:hidden; }
      .food-img { width:100%; height:150px; object-fit:cover; display:block; }
      .btn-orange { background:#ff6b35; color:#fff; border:none; }
      .badge-cart { position: relative; top: -8px; left: -5px; }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #ffb38a;">
  <div class="container">
   <a class="navbar-brand fw-bolder fs-4 text-danger" href="home.php">
      <img src="../images/logo.jpg" alt="logo" width="50" height="50" class="rounded-circle"> QuickBite 
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        
        <!-- Always visible -->
        <li class="nav-item">
          <a class="nav-link border-end" href="home.php"><i class="bi bi-house-door"></i>Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link border-end" href="#about-us"><i class="bi bi-file-earmark-person"></i>About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link border-end" href="#contact-us"><i class="bi bi-phone"></i>Contact Us</a>
        </li>

        <?php if (!isset($_SESSION['user_id'])) { ?>
            <!-- User NOT logged in -->
            <li class="nav-item ms-2">
              <a href="login.php" class="btn btn-danger rounded-pill px-4 fw-semibold">Login</a>
            </li>

        <?php } else { ?>
            <!-- User IS logged in -->
            <li class="nav-item">
              <a class="nav-link border-end" href="menu.php"><i class="bi bi-menu-down"></i>Menu</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="profile.php"><i class="bi bi-person-square"></i>Profile</a>
            </li>

            <li class="nav-item ms-2">
              <a href="logout.php" class="btn btn-danger rounded-pill px-4 fw-semibold">Logout</a>
            </li>
            <li class="nav-item ms-3">
            <a class="btn btn-light position-relative" href="cart.php"><i class="bi bi-cart4 text-danger fw-bold fs-5"></i>
          </a>
        </li>
        <?php } ?>

      </ul>
    </div>

  </div>
</nav>
<script src="../asset/bootstrap.bundle.min.js"></script>