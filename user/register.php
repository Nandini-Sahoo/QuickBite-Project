<?php include_once 'user_navbar.php'; ?>
<?php
require_once 'dbcon.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    $image = $_FILES['image']['name'];
    $new_name = time()."-".$image;
    $tmp_location = $_FILES['image']['tmp_name'];
    $folder = "uploads/".$new_name;

    $qry = "INSERT INTO quickbite(name, gender, dob, mobile, email, address, password, image) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("ssssssss",$name,$gender,$dob,$mobile,$email,$address,$password,$image);

    if($stmt->execute()){
        move_uploaded_file($tmp_name, $folder);
        echo "<script>alert('Registration Successful!'); window.location='user_login.php';</script>";
    } else {
        echo "<script>alert('Registration Failed!');</script>";
    }
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
        background: url("../images/fast_food_bg.jpg") no-repeat center center fixed;
        background-size: cover;
    }
    .register-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 30px;
        padding: 25px;
        box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
        margin-top: 40px;
    }
</style>
</head>
<body>

<div class="container my-4">
<div class="row">
<div class="col-md-6 mx-auto shadow p-4 rounded" style="background:white;">
    <h3 class="text-center text-danger mb-3">Create Your QuickBite Account</h3>

    <form action="register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

        <label class="form-label">Your Name:</label><br>
        <input type="text" class="form-control mb-2 rounded-pill" name="name" required><br>

        <label class="form-label">Gender</label>
        <input type="radio" name="gender" value="Male" required> Male
        <input type="radio" name="gender" value="Female" required> Female
        <input type="radio" name="gender" value="Other" required> Other <br><br>

        <label class="form-label">Date of Birth</label>
        <input type="date" class="form-control mb-2 rounded-pill" name="dob" min="1970-01-01" max="2015-12-31" required><br>

        <label class="form-label">Mobile Number</label>
        <input type="number" class="form-control mb-2 rounded-pill" name="mobile" maxlength="10" required><br>

        <label class="form-label">Email</label>
        <input type="email" class="form-control mb-2 rounded-pill" name="email" required><br>

        <label class="form-label">Address</label>
        <textarea class="form-control mb-2 rounded-pill" name="address" required></textarea><br>

        <label class="form-label">Password</label>
        <input type="password" class="form-control mb-2 rounded-pill" name="password" required><br>

        <label class="form-label">Confirm Password</label>
        <input type="password" class="form-control mb-2 rounded-pill" name="confirm_password" required>

        <label class="form-label">Upload Profile Image</label>
        <input type="file" class="form-control mb-3 rounded-pill" name="image" required>

        <input type="submit" value="Register" class="btn btn-danger w-100 rounded-pill">
    </form>

    <div class="text-center mt-3">
        <a href="user_login.php" class="text-decoration-none text-danger">Already have an account? <b>Login</b></a>
    </div>

</div>
</div>
</div></body>
</html>

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
    const passRegex = /^(?=.[a-z])(?=.[A-Z])(?=.\d)(?=.[@$!%?&])[A-Za-z\d@$!%?&]{6,18}$/;
    if(!passRegex.test(password)){
        alert("Password must be 6-18 characters and include uppercase, lowercase, number, and special character!");
        return false;
    }
    if(password !== confirm_password){
        alert("Password and Confirm Password do not match!");
        return false;
    }

    return true;
}
</script>