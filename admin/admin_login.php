<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_dashboard.php");
    exit();
}
$msg = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    require_once "dbcon.php";
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $qry = "SELECT * FROM admin WHERE admin_name = ? AND admin_email = ?";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $admin = $result->fetch_assoc();

        if($admin['admin_pwd'] == $password){ 
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['admin_name'] = $admin['admin_name'];
            $_SESSION['admin_email'] = $admin['admin_email'];
            $_SESSION['admin_ph_no'] = $admin['admin_ph_no'];
            $_SESSION['admin_doj'] = $admin['admin_doj'];
            $_SESSION['admin_img'] = $admin['admin_img'];
            header("location: ../admin/admin_dashboard.php");
            exit();
        } else $msg = "Incorrect Password!";
    } else $msg = "Admin Not Found!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>QuickBite | Admin Login </title>
<link rel="stylesheet" href="../asset/bootstrap.min.css">
<link rel="stylesheet" href="../asset/bootstrap-icons.min.css">
 <style>
    body {
      background-color: #a1d5a9ff;
    }
    .logo-img {
      height: 45px;
      width: 45px;
      object-fit: cover;
      border-radius: 50%;
    }
    .login-card {
    width: 400px;
    background: rgba(255,255,255,0.92);
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 0 20px rgba(0,0,0,0.35);
    margin: 30px 0 0 48px;
}
.eye-icon {
    position: absolute;
    right: 20px;
    top: 75%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
}

.eye-icon:hover {
   opacity: 1;
}
</style>
</head>
<body class="d-flex flex-column min-vh-100">
  <nav class="navbar bg-white shadow-sm px-4">
    <div class="d-flex align-items-center">
      <img src="../images/logo.jpg" alt="QuickBite Logo" class="logo-img me-2">
      <h4 class="fw-bold m-0">
        <span class="text-warning">Quick</span><span class="text-success">Bite</span>
      </h4>
    </div>
  </nav>

 <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
    
            <div class="login-card">
        <h3 class="text-center text-tertiary  fw-bold">Admin Login</h2>
        
        <?php if($msg != ""){ ?>
            <div class="alert alert-danger py-2"><?php echo $msg; ?></div>
        <?php } ?>
        <form action="admin_login.php" method="POST">
            <label class=" form-label fw-semibold mt-2">Name</label>
                    <input type="text" name="name" class="form-control mb-3 rounded-pill" placeholder="Enter Name" required>

               <label class=" form-label fw-semibold mt-2">Email</label>
                    <input type="email" name="email" class="form-control mb-3 rounded-pill" placeholder="Enter Email" required>

                 <div class="form-group position-relative mb-3">
                    <label class="form-label fw-semibold ">Password</label>
                   <input type="password" class="form-control mb-2 rounded-pill" name="password" id="password" placeholder="Enter password" required>
                   <i class="eye-icon bi bi-eye-slash" id="eyeicon"></i> 
                 </div>
          <input type="submit" value="Login" class="btn btn-warning w-100 fw-bold rounded-pill ">
        </form>
        <a href="../user/splash.php" class="btn btn-warning mt-3 rounded-pill fw-bold" type="submit">Back</a>
        </div>
    </div>
</div>
</div>

<script>
    let eyeicon = document.getElementById("eyeicon");
    let pwd = document.getElementById("password");

eyeicon.onclick = function () {
    if (pwd.type === "password") {
        pwd.type = "text";
        eyeicon.classList.remove("bi-eye-slash");        
        eyeicon.classList.add("bi-eye");        

    } else {
        pwd.type = "password";
        eyeicon.classList.remove("bi-eye");        
        eyeicon.classList.add("bi-eye-slash");        
    }
}
</script>
<script src="../asset/bootstrap.bundle.min.js"></script></body>
</body>
</html>