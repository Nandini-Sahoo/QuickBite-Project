<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickBite | Splash</title>
  
  <link rel="stylesheet" href="../asset/bootstrap.min.css">
  <style>
    body{
      background-color:beige;
    }
  </style>
  </head>

  <body class="d-flex flex-column justify-content-center align-items-center text-center min-vh-100">

  <h1 class="fw-bold mb-2">
    <span class="text-warning">Quick</span><span class="text-success">Bite</span>
  </h1>

  <p class="text-black mb-4 px-3 fw-bold"> Crave. Click. Delivered </p>

  <img src="../images/logo.jpg" alt="logo" class="rounded-circle shadow mb-4 img-fluid" style="width:220px; height:220px; object-fit:cover;">

  <button class="btn btn-warning text-white px-4 py-2 rounded-pill fw-semibold" id="getStarted">
    Get Started
  </button>
  <footer class="text-danger small mt-5">
    © 2025 QuickBite
</footer>

<script>
    setTimeout(() => {
      window.location.href = "register.php";
    }, 500000);
    document.getElementById("getStarted").addEventListener("click", function() {
      window.location.href = "register.php";
    });
  </script>
</body>
</html>