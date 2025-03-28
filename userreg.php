<?php
include('./config/conn.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./usercss/style.css">
</head>

<body>
    <div class="reg-container">
        <h1>Enter Your Details</h1>
        <form action="userreg.php" method="POST">
            <input type="text" id="username" placeholder="Enter Firstname" name="fname" required>
            <input type="text" id="username" placeholder="Enter Lastname" name="lname" required>
            <input type="text" id="username" placeholder="Enter Email" name="email" required>
            <input type="password" id="password" placeholder="Enter  password" name="pass" required>

            <button type="submit" name="btn">Sign In</button>
            <div class="options">

                <a href="userlogin.php">Already Have Account</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['btn'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $usertype = "Customer";


    $query = "INSERT INTO regdetails (firstname, lastname,email,passw,usertype)VALUES('$fname','$lname','$email','$pass','$usertype')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("location:userlogin.php");
        exit();
    } else {
        echo "<script>alert('There might be some error..!');</script>";
    }
}
?>