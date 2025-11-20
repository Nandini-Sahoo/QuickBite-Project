<?php include_once 'user_navbar.php'; ?>
<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    require_once "dbconnect.php";
    $qry = "SELECT * FROM quickbite WHERE email=?";
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
?>

<style>
    body{
        background-color:rgba(236, 85, 85, 1);
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
    .form-control {
        border-radius: 50px !important;
    }
    .btn-custom {
        border-radius: 50px;
        font-weight: 600;
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

                    <label class="fw-semibold mt-2">Email</label>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Enter Email" required>

                    <label class="fw-semibold">Password</label>
                    <input type="password" name="password" class="form-control mb-4" placeholder="Enter Password" required>

                    <input type="submit" value="Login" class="btn btn-warning w-100 btn-custom">
                </form>

                <p class="text-center mt-3">Don't have an account?
                    <a href="register.php" class="fw-semibold text-decoration-none text-danger">Register</a>
                </p>
            </div>

        </div>
    </div>
</div>