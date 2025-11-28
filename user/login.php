<?php include_once 'navbar.php'; ?>
<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once "dbcon.php";
    $qry = "SELECT * FROM user WHERE user_email=?";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        session_start();
        $_SESSION['name'] = $data['name'];
        $_SESSION['email'] = $data['email'];
        header("location:dashboard.php");
        exit();
    } else {
        $msg = "Invalid Email or Password";
    }
}
?><style>
    body{
        background: url("../images/fast_food_bg.jpg") no-repeat center center fixed;
        background-size: cover;
    }
    .login-card {
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 0 18px rgba(0,0,0,0.15);
        background: #ffffff;
        transition: 0.3s;
    }
    .login-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 0 22px rgba(0,0,0,0.25);
    }
    .eye-icon {
    position: absolute;
    right: 20px;
    top: 75%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 18px;
}
.eye-icon:hover {
   opacity: 1;
}
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">

            <div class="login-card">
                <h3 class="text-center fw-bold">Welcome Back 👋</h3>
                <p class="text-center text-muted mb-4">Login to continue ordering your favourite food!</p>

                <?php if($msg != ""): ?>
                    <div class="alert alert-danger text-center py-2">
                        <?php echo $msg; ?>
                    </div>
                <?php endif; ?>
                <form action="login.php" method="post">

                    <label class=" form-label fw-semibold mt-2">Email</label>
                    <input type="email" name="email" class="form-control mb-3 rounded-pill" placeholder="Enter Email" required>

                 <div class="form-group position-relative mb-3">
                    <label class="form-label fw-semibold ">Password</label>
                   <input type="password" class="form-control mb-2 rounded-pill" name="password" id="password" placeholder="Enter password" required>
                        <i class="eye-icon bi bi-eye-slash" id="eyeicon"></i>  

                    </div>
                  <input type="submit" value="Login" class="btn btn-warning w-100 fw-bold rounded-pill ">
                </form>
                <p class="text-center mt-3">Don't have an account?
                    <a href="register.php" class="fw-semibold text-decoration-none text-danger">Register</a>
                </p>
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
