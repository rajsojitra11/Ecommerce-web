<?php
session_start();
include("./config/conn.php");
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
    <div class="login-container">
        <h1>Login</h1>
        <form action="userlogin.php" method="POST">
            <input type="text" id="username" placeholder="Enter your Email" name="email" required>

            <input type="password" id="password" placeholder="Enter your password" name="passw" required>

            <button type="submit" name="btnn1">Sign In</button>
            <div class="options">
                <label>
                    <input type="checkbox" name="remember">
                    Remember Me
                </label>

                <a href="userreg.php">Register New Member</a>
            </div>
        </form>
    </div>
</body>

</html>

<?php

if (isset($_POST['btnn1'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['passw']);



    $query = "SELECT * FROM regdetails WHERE email = '$email' AND passw = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row["usertype"] == "Customer") {

            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            header('Location:./userside/home.php');
        } else if ($row["usertype"] == "Admin") {
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['firstname'];
            header('Location:admin/index.php');
            exit;
        }
    } else {

        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>