<?php

include '../config/conn.php';

session_start();

if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];
}

include '../include/wishlist_cart.php';

if (isset($_POST['delete'])) {
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE wid = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE uid = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>wishlist</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../userside/css/style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="products">

      <h3 class="heading">your wishlist</h3>

      <div class="box-container">

         <?php
         $grand_total = 0;
         $query = "SELECT * FROM `wishlist` WHERE uid = '$user_id'"; // Make sure $user_id is sanitized
         $result = mysqli_query($conn, $query);

         if (mysqli_num_rows($result) > 0) {
            while ($fetch_wishlist = mysqli_fetch_assoc($result)) {
               $grand_total += $fetch_wishlist['pprice'];
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                  <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['wid']; ?>">
                  <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
                  <input type="hidden" name="price" value="<?= $fetch_wishlist['pprice']; ?>">
                  <input type="hidden" name="image" value="<?= $fetch_wishlist['pimg']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" class="fas fa-eye"></a>
                  <img src="../admin<?= $fetch_wishlist['pimg']; ?>" alt="No img found">
                  <div class="name"><?= $fetch_wishlist['name']; ?></div>
                  <div class="flex">
                     <div class="price">Rs. <?= $fetch_wishlist['pprice']; ?>/-</div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                  </div>
                  <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                  <input type="submit" value="delete item" onclick="return confirm('delete this from wishlist?');" class="delete-btn" name="delete">
               </form>
         <?php
            }
         } else {
            echo '<p class="empty">your wishlist is empty</p>';
         }
         ?>
      </div>

      <div class="wishlist-total">
         <p>grand total : <span>RS. <?= $grand_total; ?>/-</span></p>
         <a href="shop.php" class="option-btn">continue shopping</a>
         <a href="wishlist.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">delete all item</a>
      </div>

   </section>













   <?php include '../include/ufooter.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>