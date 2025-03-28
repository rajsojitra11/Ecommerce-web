<?php
session_start();

include '../config/conn.php';

if (!isset($_SESSION['id'])) {
   echo "User not logged in!";
   exit;
} else {
   $user_id = $_SESSION['id'];
}

if (isset($_POST['delete'])) {
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE cid = ?");
   $delete_cart_item->execute([$cart_id]);
}

if (isset($_GET['delete_all'])) {
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE uid = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if (isset($_POST['update_qty'])) {
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quatity = ? WHERE cid = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="../userside/css/style.css">
</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="products shopping-cart">
      <h3 class="heading">shopping cart</h3>
      <div class="box-container">
         <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE uid = ?");
         $select_cart->bind_param("i", $user_id);
         $select_cart->execute();
         $result = $select_cart->get_result();

         if ($result && $result->num_rows > 0) {
            while ($fetch_cart = $result->fetch_assoc()) {
               // debug: check fetched cart data
               //var_dump($fetch_cart); // Comment this out later
         ?>
               <form action="" method="post" class="box">
                  <input type="hidden" name="cart_id" value="<?= $fetch_cart['cid']; ?>">
                  <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
                  <img src="../admin<?= $fetch_cart['pimg']; ?>" alt="">
                  <div class="name"><?= $fetch_cart['name']; ?></div>
                  <div class="flex">
                     <div class="price">Rs.<?= $fetch_cart['price']; ?>/-</div>
                     <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quatity']; ?>">
                     <button type="submit" class="fas fa-edit" name="update_qty"></button>
                  </div>
                  <div class="sub-total"> sub total : <span>Rs. <?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quatity']); ?>/-</span> </div>
                  <input type="submit" value="delete item" onclick="return confirm('delete this from cart?');" class="delete-btn" name="delete">
               </form>
         <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">your cart is empty</p>';
         }
         ?>
      </div>

      <div class="cart-total">
         <p>grand total : <span>Rs. <?= $grand_total; ?>/-</span></p>
         <a href="shop.php" class="option-btn">continue shopping</a>
         <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
         <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">proceed to checkout</a>
      </div>
   </section>

   <?php include '../include/ufooter.php'; ?>
   <script src="js/script.js"></script>
</body>

</html>