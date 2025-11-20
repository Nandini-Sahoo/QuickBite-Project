<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
$msg="";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$name = $_POST['admin_name'];
$email = $_POST['admin_email'];
$phone = $_POST['phone'];
$doj = $_POST['doj'];
$cpwd = $_POST['cpwd'];

$file_name = $_FILES['admin_img']['name'];
$new_name =  $file_name;
$tmp_location = $_FILES['admin_img']['tmp_name'];
$upload_path = "../images/$new_name";

if(move_uploaded_file($tmp_location, $upload_path)){
    $qry="INSERT INTO admin (admin_name, admin_pwd, admin_email, admin_ph_no, admin_doj, admin_img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt=$con->prepare($qry);
    $stmt-> bind_param("ssssss",$name, $cpwd, $email, $phone, $doj, $new_name);
    if($stmt->execute()){
            $msg = "New Admin Added!";
        } else {
            $msg = $conn->error;
        }
    } else {
        $msg = "Error: ".$_FILES['admin_img']['error'];
    }
$con->close();
}
?>
<div class="container">
<a href="admin_controls.php" class="btn mt-5" style="background-color: #a7c957;">← Go Back</a>
<h2 class="new-item rounded mt-5 p-2">ADD NEW ADMIN</h2>
<h3 class="text-success text-center fw-bold"><?php echo $msg; ?></h3>
<form id="chkform" action="add_admin.php" method="post" class="border border-2 border-opacity-50 shadow p-3 mb-5 mx-auto w-50 rounded add-form" enctype="multipart/form-data" onsubmit="validateForm(event)">
    <div class="mb-3">
    <label class="form-label">Admin Name:</label>
    <input type="text" class="form-control" name="admin_name" required>
    </div>
    <div class="mb-3">
    <label class="form-label">Email ID:</label><br>
    <input type="email" class="form-control" name="admin_email">
    </div>
    <div class="mb-3">
    <label class="form-label">Phone No.:</label>
    <input type="tel" class="form-control" name="phone">
    </div>
    <div class="mb-3">
    <label class="form-label">Date Of Joining:</label>
    <input type="date" class="form-control" name="doj">
    </div>
    <div class="mb-3">
    <label class="form-label">Upload Image:</label>
    <input type="file" class="form-control" name="admin_img">
    </div>
    <div class="mb-3">
    <label class="form-label">Password:</label>
    <input type="password" class="form-control" name="pwd">
    </div>
    <div class="mb-3">
    <label class="form-label">Confirm Password:</label>
    <input type="password" class="form-control" name="cpwd">
    </div>
    <p id="err" class="text-danger"></p>
    <button type="submit" class="btn" style="background-color: #e4c1f9;">Add + </button>
</form>
<script>
    function validateForm(e){
    let err=false
    let msg=""
    let form=document.getElementById("chkform")
    let email=form.elements["admin_email"].value
    let phone=form.elements["phone"].value
    let doj=form.elements["doj"].value
    let pwd=form.elements["pwd"].value
    let cpwd=form.elements["cpwd"].value
    let Err=document.getElementById("err")

    let mobRegx = /^[6-9][0-9]{9}$/
    let emailRegx = /^[a-z0-9_\.]{3,}@[a-z0-9\.]{3,15}\.[a-z]{2,5}$/
    let passRegx = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&!~`*])[A-Za-z0-9@#$%^&!~`*]{8,16}$/
    let minDate = new Date("2025-11-01")
    let maxDate = new Date()
    let givenDate = new Date(doj)
    if(doj === "" || givenDate > maxDate || givenDate < minDate){
    msg += "Please enter DOJ<br>"
    err = true
    }
    if(phone === "" || !mobRegx.test(phone)){
    msg += "Please enter a 10 digit valid phone number"
    err = true
    }
    if(email === "" || !emailRegx.test(email)){
    msg += "Please enter a valid Email"
    err = true
    }
    if (pwd === "" || !passRegx.test(pwd)) {
    msg +=
    `Password must contain:<br>
    - 1 lowercase letter<br>
    - 1 uppercase letter<br>
    - 1 number<br>
    - 1 special character (@ # $ % ^ & ! ~ \` *)<br>
    - Length between 8 and 16 characters<br>`
    err = true
    }
    if(cpwd==="" || pwd != cpwd){
    msg += "Password and Confirm Password must match<br>"
    err=true
    }
    if(err){
        Err.innerHTML=msg
        e.preventDefault()
    }
}
</script>
