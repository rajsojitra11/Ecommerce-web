<?php

include '../config/conn.php';
session_start();

if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];
} else {
   $user_id = '';
};

// session_start();

// if(isset($_SESSION['user_id'])){
//    $user_id = $_SESSION['user_id'];
// }else{
//    $user_id = '';
// };

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../userside/css/style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="orders">

      <h1 class="heading">placed orders</h1>

      <div class="box-container">

         <?php
         if ($user_id == '') {
            echo '<p class="empty">please login to see your orders</p>';
         } else {
            // Assuming $conn is a valid MySQLi connection
            $query = "SELECT * FROM `orders` WHERE uid = '$user_id'";  // Be cautious with SQL injection.
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
               while ($fetch_orders = $result->fetch_assoc()) {
         ?>
                  <div class="box">
                     <p>placed on : <span><?= $fetch_orders['placed_on']; ?></span></p>
                     <p>name : <span><?= $fetch_orders['name']; ?></span></p>
                     <p>email : <span><?= $fetch_orders['email']; ?></span></p>
                     <p>number : <span><?= $fetch_orders['number']; ?></span></p>
                     <p>address : <span><?= $fetch_orders['address']; ?></span></p>
                     <p>payment method : <span><?= $fetch_orders['method']; ?></span></p>
                     <p>your orders : <span><?= $fetch_orders['total_product']; ?></span></p>
                     <p>total price : <span>Rs. <?= $fetch_orders['total_price']; ?>/-</span></p>
                     <p> payment status : <span style="color:<?php if ($fetch_orders['pyment_staus'] == 'Pending') {
                                                                  echo 'red';
                                                               } else {
                                                                  echo 'green';
                                                               }; ?>"><?= $fetch_orders['pyment_staus']; ?></span> </p>
                  </div>
         <?php
               }
            } else {
               echo '<p class="empty">no orders placed yet!</p>';
            }
         }
         ?>

      </div>

   </section>













   <?php include '../include/ufooter.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>