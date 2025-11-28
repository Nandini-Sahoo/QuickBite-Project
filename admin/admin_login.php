<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - QuickBite</title>

  <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #dae3edff;
            background: url("../images/admin_bgimg2.jpeg") no-repeat center center fixed;
            background-size: cover;
        }
        .login-box {
            max-width: 420px;
            margin: 80px auto;
            padding: 30px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 18px rgba(0,0,0,0.25);
        }
        .title {
            font-weight: bold;
            font-size: 26px;
            text-align: center;
            margin-bottom: 20px;
            color: #ff5722;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <div class="title">Admin Login</div>

        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= $_GET['error']; ?></div>
        <?php endif; ?>

        <form id="loginForm" action="admin_auth.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-control" required placeholder="Enter admin name">
            </div>

            <div class="mb-3">
                <label class="form-label">Email ID</label>
                <input type="email" name="email" class="form-control" required placeholder="Enter email">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="pass" class="form-control" required placeholder="Enter password">
                    <button type="button" class="btn btn-outline-secondary" onclick="togglePass()">👁</button>
                </div>
            </div>

            <button class="btn btn-danger w-100 mt-3" type="submit">Login</button>
        </form>
        <a href="../user/splash.php" class="btn btn-warning mt-3" type="submit">Back</a>
    </div>

    <script>
        function togglePass() {
            let p = document.getElementById("pass");
            p.type = (p.type === "password") ? "text" : "password";
        }
    </script>

<script src="../asset/bootstrap.bundle.min.js"></script></body>
</html>
