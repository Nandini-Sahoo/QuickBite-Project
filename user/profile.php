<?php
session_start();
include_once 'dbcon.php'; 

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

$con= mysqli_connect("localhost","root","","quickbite");
$query = "SELECT name,email,phone,delivery_address,profile_image FROM user WHERE id='$user_id' ";
$result = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($result);

if(isset($_POST['update_pic'])){
    $image = $_FILES['profile_image']['name'];
    $temp = $_FILES['profile_image']['tmp_name'];
    $path = "../images/".$image;

    move_uploaded_file($temp, $path);

    mysqli_query($con, "UPDATE users SET profile_image='$image' WHERE id='$user_id'");
    echo "<script>alert('Profile Picture Updated Successfully'); window.location.href='profile.php';</script>";
}

include_once 'nav.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>User Profile - Quickbite</title>
<link rel="stylesheet" href="../asset/bootstrap.min.css">

<style>
body{
    background: url('../images/bg-food-wall.jpg');
    background-size: cover;
    background-repeat: no-repeat;
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
</style>
</head>

<body>

<div class="profile-card text-center">
    <img src="../images/<?php echo $user['profile_image']; ?>" class="profile-img mb-3">

    <h3><?php echo $user['name']; ?></h3>
    <p><b>Email:</b> <?php echo $user['email']; ?></p>
    <p><b>Phone:</b> <?php echo $user['phone']; ?></p>
    <p><b>Address:</b> <?php echo $user['delivery_address']; ?></p>

    <hr>

    <form method="post" enctype="multipart/form-data" onsubmit="return validatePic()">
        <label class="form-label">Change Profile Picture</label>
        <input type="file" class="form-control" name="profile_image" id="profile_image" required>
        <button type="submit" name="update_pic" class="btn btn-update mt-3">Update Profile Picture</button>
    </form>
</div>

<script>
function validatePic(){
    let file = document.getElementById("profile_image").value;
    if(file == ""){
        alert("Please select an image.");
        return false;
    }
    return true;
}
</script>

</body>
</html>