<?php

include '../config/conn.php';
session_start();

if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];
} else {
   $user_id = '';
};


if (isset($_POST['send'])) {

   // Sanitize and assign POST data
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   // Insert the new message directly without checking if it's already sent
   $insert_message = $conn->prepare("INSERT INTO `messages`(email, name, message) VALUES(?, ?, ?)");
   $insert_message->execute([$email, $name, $msg]);

   // Success message
   $message[] = 'Message sent successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="contact">

      <form action="" method="post">
         <h3>get in touch</h3>
         <input type="text" name="name" placeholder="enter your name" required maxlength="20" class="box">
         <input type="email" name="email" placeholder="enter your email" required maxlength="50" class="box">
         <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
         <input type="submit" value="send message" name="send" class="btn">
      </form>

   </section>













   <?php include '../include/ufooter.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>