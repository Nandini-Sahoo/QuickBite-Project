<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quickbite | navbar</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/bootstrap-icons.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
   <a class="navbar-brand fw-bolder fs-4 text-danger" href="#">
      <i class="fa-solid fa-bowl-food"></i> QuickBite 
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle-navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        
        <!-- Always visible -->
        <li class="nav-item">
          <a class="nav-link" href="home.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#about-us">About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#contact-us">Contact Us</a>
        </li>

        <?php if (!isset($_SESSION['user_id'])) { ?>
            <!-- User NOT logged in -->
            <li class="nav-item ms-2">
              <a href="login.php" class="btn btn-danger rounded-pill px-4 fw-semibold">Login</a>
            </li>

        <?php } else { ?>
            <!-- User IS logged in -->
            <li class="nav-item">
              <a class="nav-link" href="menu.php">Menu</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="profile.php">Profile</a>
            </li>

            <li class="nav-item ms-2">
              <a href="logout.php" class="btn btn-danger rounded-pill px-4 fw-semibold">Logout</a>
            </li>
            <li class="nav-item ms-3">
            <a class="btn btn-light position-relative" href="cart.php"><i class="bi bi-cart4"></i>
          </a>
        </li>
        <?php } ?>

      </ul>
    </div>

  </div>
</nav>

<script src="../asset/bootstrap.bundle.min.js"></script>