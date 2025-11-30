<?php
include_once 'navbar.php';
require_once 'dbcon.php'; 

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

$qry = "SELECT * FROM users WHERE user_id=?";
$stmt = $con->prepare($qry);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$res = $stmt->get_result();
$user=$res->fetch_assoc();

if (isset($_POST['update_pic'])) {

    // Upload details
    $image = $_FILES['profile_image']['name'];
    $new = time()."-".$_FILES['profile_image']['tmp_name'];
    $tmp_location= $_FILES['profile_image']['tmp_name'];
    $path = "./uploads/$new";

    // Move file
    move_uploaded_file($temp_name, $path);

    // Update DB (fixed column name: user_img)
    $update = $con->prepare("UPDATE users SET user_img = ? WHERE user_id = ?");
    $update->bind_param("si", $image, $user_id);
    $update->execute();

    echo "<script>alert('Profile Picture Updated Successfully'); window.location.href='profile.php';</script>";
}
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
    <img src="./uploads/<?php echo $user['user_img']; ?>" class="profile-img mb-3" alt="profile">

    <h3><?php echo $user['user_name']; ?></h3>
    <p><b>Email:</b> <?php echo $user['user_email']; ?></p>
    <p><b>Phone:</b> <?php echo $user['user_ph_no']; ?></p>
    <p><b>Address:</b> <?php echo $user['user_address']; ?></p>

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