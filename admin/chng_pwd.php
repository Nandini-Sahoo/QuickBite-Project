<?php
require_once 'dbcon.php';
if(!isset($_GET['id']))
header('location: admin_controls.php');
$id=$_GET['id'];
$qry="SELECT * FROM admin WHERE admin_id=?";
$stmt=$con->prepare($qry);
$stmt->bind_param("i",$id);
$stmt->execute();
$res=$stmt->get_result();
if($res->num_rows > 0){
$data=$res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../asset/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/bootstrap-icons.min.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #dae3edff;
            background: url("../images/admin_bgimg1.avif") no-repeat center center fixed;
            background-size: cover;
        }
        
    </style>
</head>
<body>
    <div class="d-flex justify-content-center mt-5">
    <div class="text-start border border-2 border-opacity-75 shadow p-5 mx-auto rounded"
         style="background: rgba(228, 224, 224, 0.2); backdrop-filter: blur(2px);">
         <h3>Name: <?php echo $data['admin_name'] ?></h3>
    <form action="chng_pwd.php" method="post">
        <input type="hidden" name="id" value="<?php echo $data['admin_id']; ?>">
        <div class="input-group mb-3">
            <input type="password" id="oldPwd" class="form-control" value="<?php echo $data['admin_pwd'] ?>">
            <button class="btn btn-outline-secondary" type="button" id="toggleOldPwd" onclick="togglePass('oldPwd', 'toggleOldPwd')">👁️</button>
        </div>

        <div class="input-group mb-3">
            <input type="password" id="newPwd" name="newPwd" class="form-control" placeholder="Enter New Password">
            <button class="btn btn-outline-secondary" type="button" id="toggleNewPwd" onclick="togglePass('newPwd', 'toggleNewPwd')">👁️</button>
        </div>
        <input type="submit" value="Change" class="btn btn-outline-success">
    </form>
    </div>
    </div>
    <script src="../asset/bootstrap.bundle.min.js"></script>
    <script>
        function togglePass(inputId, btnId) {
            const input = document.getElementById(inputId);
            const btn = document.getElementById(btnId);

            if (input.type === "password") {
                input.type = "text";
                btn.textContent = "🙈";
            } else {
                input.type = "password";
                btn.textContent = "👁️";
            }
        }
    </script>
</body>
</html>
<?php }
if($_SERVER['REQUEST_METHOD']=='POST'){
    $new_pwd=$_POST['newPwd'];
    $id=$_POST['id'];
    $qry="UPDATE admin SET admin_pwd=? WHERE admin_id=?";
    $stmt=$con->prepare($qry);
    $stmt->bind_param("si",$new_pwd, $id);
    if(!$stmt)
    echo $con->error;
    if($stmt->execute()){
    ?>
    <script>
    alert('Password Changed!');
    window.location="admin_controls.php";
    </script>
    <?php
    } else echo "<h3 class='text-danger'>ERROR: ". $con->connect_error()."</h3>";
    }
    $con->close();
?>