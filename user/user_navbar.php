<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quickbite | navbar</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
      
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
   <a class="navbar-brand fw-bolder fs-4 text-danger" href="#">
      <i class="fa-solid fa-bowl-food"></i> QuickBite </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" 
    aria-expanded="false" aria-label="Toggle-navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="../index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="menu.php">Menu</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="about.php">About Us</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>

        <li class="nav-item ms-2">
          <a href="login.php" class="btn btn-danger rounded-pill px-4 fw-semibold">Login</a>
        </li>

      </ul>
    </div>

  </div>
</nav>
<script src="../asset/bootstrap.bundle.min.js"></script>

</body>
</html>