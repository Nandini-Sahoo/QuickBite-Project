<?php include_once 'navbar.php'; ?>
<?php
require_once 'dbconnect.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $confirm_password=$_POST['confirm_password'];

    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $folder = "uploads/".$image;

    $qry = "INSERT INTO user(user_name, user_gender, user_dob, user_ph_no, user_email, user_address, user_pwd, user_img) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("ssssssss",$name,$gender,$dob,$mobile,$email,$address,$password,$image);

    if($stmt->execute()){
        move_uploaded_file($tmp_name, $folder);
        echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registration Failed!');</script>";
    }
    $smt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QuickBite - Register</title>

<style>
    body {
        background: url("../images/bg2.webp") no-repeat center center fixed;
        background-size: cover;
        background-position: center center;
        background-repeat:no-repeat;
        min-height:100vh;
    }
    .register-card {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        padding: 25px;
        box-shadow: 0px 0px 20px rgba(0,0,0,0.3);
        margin-top:6px;
        backdrop-filter: blur(2px);
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
</head>
<body>

<div class="container my-4">
<div class="row">
<div class="col-md-6 mx-auto shadow p-4 rounded register-card">
    <h3 class="text-center text-black fs-2  fw-bold mb-3">Create Your QuickBite Account</h3>

    <form action="register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

        <label class="form-label fs-5 fw-bold">Your Name</label><br>
        <input type="text" class="form-control mb-2 rounded-pill" name="name" required><br>

        <label class="form-label fs-5 fw-bold">Gender</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="radio" name="gender" value="Other" required> Other <br><br>

        <label class="form-label fs-5 fw-bold">Date of Birth</label>
        <input type="date" class="form-control mb-2 rounded-pill" name="dob" min="1970-01-01" max="2015-12-31" required><br>

        <label class="form-label fs-5 fw-bold">Mobile Number</label>
        <input type="number" class="form-control mb-2 rounded-pill" name="mobile" maxlength="10" required><br>

        <label class="form-label fs-5 fw-bold">Email</label>
        <input type="email" class="form-control mb-2 rounded-pill" name="email" required><br>

        <label class="form-label fs-5 fw-bold">Delivery Address</label>
        <textarea class="form-control mb-2 rounded-pill" name="address" required></textarea><br>
       
        <div class="form-group position-relative mb-3">
        <label class="form-label fs-5 fw-bold">Password</label>
        <input type="password" class="form-control mb-2 rounded-pill" name="password" id="password" required>
            <i class="eye-icon bi bi-eye-slash" id="eyeicon"></i>        
        </div>
        
        <div class="form-group position-relative mb-3">
        <label class="form-label fs-5  fw-bold">Confirm Password</label>
        <input type="password" class="form-control mb-2 rounded-pill" name="confirm_password" id="confirm_password" required>
            <i class="eye-icon bi bi-eye-slash" id="eyeicon2"></i>        
        </div>

        <label class="form-label fs-5 fw-bold">Upload Profile Image</label>
        <input type="file" class="form-control mb-3 rounded-pill" name="image" required>

        <input type="submit" value="Register" class="btn btn-warning btn-outline-danger text-black w-100 rounded-pill">
    </form>
    <div class="text-center mt-3">
        <a href="login.php" class="text-decoration-none text-black"><b>Already have an account?Login</b></a>
    </div>
</div></div></div>
</body></html>

<script>
function validateForm(){
    let mobile = document.getElementsByName("mobile")[0].value;
    let dob = document.getElementsByName("dob")[0].value;
    let password = document.getElementsByName("password")[0].value;
    let confirm_password = document.getElementsByName("confirm_password")[0].value;
    
    if(mobile.length !== 10){
        alert("Mobile number must be exactly 10 digits!");
        return false;
    }
    let year = new Date(dob).getFullYear();
    if(year < 1970 || year > 2015){
        alert("Date of Birth must be between 1970 and 2015!");
        return false;
    }
    const passregex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@#$%^&*!]).{6,18}$/;

    if (!passregex.test(password)) {
    alert("Password must be 6-18 characters and include uppercase, lowercase, number, and special character!");
    return false;
   }

   if (password !== confirm_password) {
    alert("Password and Confirm Password do not match!");
    return false;
  }

  return true;
}

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

let eyeicon2 = document.getElementById("eyeicon2");
let pwd2 = document.getElementById("confirm_password");

eyeicon2.onclick = function () {
    if (pwd2.type === "password") {
        pwd2.type = "text";
        eyeicon2.classList.remove("bi-eye-slash");        
        eyeicon2.classList.add("bi-eye");        

    } else {
        pwd2.type = "password";
        eyeicon2.classList.remove("bi-eye");        
        eyeicon2.classList.add("bi-eye-slash");        
    }
}

</script>
