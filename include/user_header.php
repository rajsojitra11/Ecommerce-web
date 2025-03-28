<?php
include '../config/conn.php';

if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];
} else {
   $user_id = '';
};

?>
<style>
   #nav-col {
      background-color: rgb(212, 215, 216);
   }
</style>
<header class="header" id="nav-col">

   <section class=" flex">

      <a href="home.php" class="logo">Shopie<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="orders.php">Orders</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
      </nav>

      <div class="icons">

         <?php
         // Count wishlist items
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE uid = ?");
         $count_wishlist_items->bind_param("i", $user_id); // Bind the user_id parameter
         $count_wishlist_items->execute();
         $wishlist_result = $count_wishlist_items->get_result();
         $total_wishlist_counts = $wishlist_result->num_rows; // Use num_rows instead of rowCount

         // Count cart items
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE uid = ?");
         $count_cart_items->bind_param("i", $user_id); // Bind the user_id parameter
         $count_cart_items->execute();
         $cart_result = $count_cart_items->get_result();
         $total_cart_counts = $cart_result->num_rows; // Use num_rows instead of rowCount
         ?>

         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php"><i class="fas fa-search"></i></a>
         <a href="wishlist.php"><i class="fas fa-heart"></i><!--<span>(<?= $total_wishlist_counts; ?>)</span>--></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><!--<span>(<?= $total_cart_counts; ?>)</span>--></a>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
         // Assuming $conn is a MySQLi connection
         $query = "SELECT * FROM `regdetails` WHERE id = ?";
         $stmt = $conn->prepare($query);

         // Bind the parameter (assuming $user_id is already defined)
         $stmt->bind_param("i", $user_id);

         // Execute the query
         $stmt->execute();

         // Get the result
         $result = $stmt->get_result();

         // Check if the row exists
         if ($result->num_rows > 0) {
            $fetch_profile = $result->fetch_assoc();

         ?>
            <p><?= $fetch_profile["firstname"]; ?></p>
            <a href="update_user.php" class="btn">update profile</a>
            <div class="flex-btn">
               <!-- <a href="user_register.php" class="option-btn">register</a> -->
               <!-- <a href="user_login.php" class="option-btn">login</a> -->
            </div>
            <a href="../logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a>
         <?php
         } else {
         ?>
            <!-- <p>please login or register first!</p> -->
            <div class="flex-btn">
               <!-- <a href="user_register.php" class="option-btn">register</a> -->
               <!-- <a href="user_login.php" class="option-btn">login</a> -->
            </div>
         <?php
         }
         ?>


      </div>

   </section>

</header>