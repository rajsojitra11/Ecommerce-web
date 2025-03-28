<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:../userlogin.php');
    exit;
}
include('../include/header.php');
include('../include/navbar.php');
include('../include/sidebar.php');
include('../config/conn.php');

?>
<link rel="stylesheet" href="../admin/admincss/sty.css">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Update Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
    <div class="reg-container">
        <h2>Update Profile</h2>
        <form action="update.php" method="POST">
            <input type="text" id="username" placeholder="Enter Username" name="uname" required>
            <input type="text" id="username" placeholder="Enter Old Password" name="opass" required>
            <input type="text" id="username" placeholder="Enter New Password" name="npass" required>
            <input type="password" id="password" placeholder="Enter Confirmpassword" name="cpass" required>

            <button type="submit" name="btn2">Update</button>

        </form>
    </div>
</div>




<?php
include('../include/footer.php');
?>
<?php
$dataQuery = "SELECT * FROM regdetails WHERE usertype='Admin'";
$dataResult = mysqli_query($conn, $dataQuery);
$row = mysqli_fetch_assoc($dataResult);
?>
<?php

if (isset($_POST['btn2'])) {
    $uname = $_POST['uname'];
    $opass = $_POST['opass'];
    $npass = $_POST['npass'];
    $cpass = $_POST['cpass'];

    if ($opass == $row['passw'] && $npass == $cpass) {

        $query = "UPDATE regdetails SET email='$uname', passw='$npass' WHERE usertype='Admin'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("Location:./index.php");
            exit();
        } else {
            echo "somthing wrong..!";
        }
        exit();
    } else {
        echo "<script>alert('Enter correct password')</script>";
    }
}
?>