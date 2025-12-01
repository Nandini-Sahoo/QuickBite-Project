<?php
include_once 'admin_navbar.php';
require_once 'dbcon.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $doj = $_POST['doj'];

    $qry = "UPDATE admin SET admin_name=?, admin_email=?, admin_ph_no=?, admin_doj=?  WHERE admin_id=?";
    $stmt = $con->prepare($qry);

    if(!$stmt){
        die("SQL ERROR: " . $con->error);
    }
    $stmt->bind_param("ssssi", $name, $email, $phone, $doj, $id);

    if($stmt->execute()){
        echo "<script>alert('Admin Updated!'); window.location='admin_controls.php';</script>";
        exit;
    } else {
        die("<h3 class='text-danger'>ERROR: ". $stmt->error ."</h3>");
    }
}

if(!isset($_GET['id'])){
    header('location: admin_controls.php');
    exit;
}
$id = $_GET['id'];
$qry = "SELECT * FROM admin WHERE admin_id = ?";
$stmt = $con->prepare($qry);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if($res->num_rows == 0){
    die("<h3 class='text-danger'>Admin not found.</h3>");
}
$data = $res->fetch_assoc();
?>
<div class="container">
    <h2 class="text-warning">UPDATE ADMIN: <?php echo $data['admin_id']; ?></h2>

    <form action="update_admin.php" method="post" 
          class="border border-2 border-opacity-50 shadow p-3 mb-5 mx-auto w-50 rounded add-form">

        <input type="hidden" name="id" value="<?php echo $data['admin_id']; ?>">

        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo $data['admin_name']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email ID:</label>
            <input type="email" class="form-control" name="email" value="<?php echo $data['admin_email']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Phone No.:</label>
            <input type="tel" class="form-control" name="phone" value="<?php echo $data['admin_ph_no']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">DOJ:</label>
            <input type="date" class="form-control" name="doj" value="<?php echo $data['admin_doj']; ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
<?php
$con->close();
?>