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
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../userside/css/style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="products">

      <h1 class="heading">category</h1>

      <div class="box-container">

         <?php

         $category = $_GET['category'];
         $query = "SELECT * FROM `product` WHERE productname LIKE '%$category%'";
         $result = $conn->query($query);

         if ($result->num_rows > 0) {
            while ($fetch_product = $result->fetch_assoc()) {
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_product['pid']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_product['productname']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_product['productprice']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_product['productimg']; ?>">
                  <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                  <a href="quick_view.php?pid=<?= $fetch_product['pid']; ?>" class="fas fa-eye"></a>
                  <img src="../admin<?= $fetch_product['productimg']; ?>" alt="No img found">
                  <div class="name"><?= $fetch_product['productname']; ?></div>
                  <div class="flex">
                     <div class="price"><span>RS. </span><?= $fetch_product['productprice']; ?><span>/-</span></div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>
                  <input type="submit" value="add to cart" class="btn" name="add_to_cart">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">no products found!</p>';
         }
         ?>

      </div>

   </section>













   <?php include '../include/ufooter.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>