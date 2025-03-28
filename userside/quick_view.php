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

include '../include/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../userside/css/style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="quick-view">

      <h1 class="heading">quick view</h1>

      <?php
      $pid = $_GET['pid'];

      // Assuming you have a valid MySQLi connection stored in $conn
      $query = "SELECT * FROM `product` WHERE pid = ?";
      $stmt = $conn->prepare($query);

      // Bind the parameter
      $stmt->bind_param("i", $pid); // "i" means the parameter is an integer
      $stmt->execute();
      $result = $stmt->get_result();

      // Check if any rows were returned
      if ($result->num_rows > 0) {
         while ($fetch_product = $result->fetch_assoc()) {
      ?>
            <form action="" method="post" class="box">
               <input type="hidden" name="pid" value="<?= $fetch_product['pid']; ?>">
               <input type="hidden" name="name" value="<?= $fetch_product['productname']; ?>">
               <input type="hidden" name="price" value="<?= $fetch_product['productprice']; ?>">
               <input type="hidden" name="image" value="<?= $fetch_product['productimg']; ?>">
               <div class="row">
                  <div class="image-container">
                     <div class="main-image">
                        <img src="../admin<?= $fetch_product['productimg']; ?>" alt="No img found">
                     </div>
                     <div class="sub-image">
                        <img src="../admin<?= $fetch_product['productimg']; ?>" alt="">
                        <img src="../admin<?= $fetch_product['productimg']; ?>" alt="">
                        <img src="../admin<?= $fetch_product['productimg']; ?>" alt="">
                     </div>
                  </div>
                  <div class="content">
                     <div class="name"><?= $fetch_product['productname']; ?></div>
                     <div class="flex">
                        <div class="price"><span>Rs. </span><?= $fetch_product['productprice']; ?><span>/-</span></div>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                     </div>
                     <div class="details"><?= $fetch_product['productdetails']; ?></div>
                     <div class="flex-btn">
                        <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                        <input class="option-btn" type="submit" name="add_to_wishlist" value="add to wishlist">
                     </div>
                  </div>
               </div>
            </form>
      <?php
         }
      } else {
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>

   </section>













   <?php include '../include/ufooter.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>