<?php

include '../config/conn.php';
session_start();

// Check if user is logged in
if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];
} else {
   // Redirect to login if the user is not logged in
   header('Location: login.php');
   exit;
}

if (isset($_POST['order'])) {
   // Sanitize and validate input data
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
   $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);

   // Construct the address from form fields
   $address = 'flat no. ' . filter_var($_POST['flat'], FILTER_SANITIZE_STRING) . ', ' .
      filter_var($_POST['street'], FILTER_SANITIZE_STRING) . ', ' .
      filter_var($_POST['city'], FILTER_SANITIZE_STRING) . ', ' .
      filter_var($_POST['state'], FILTER_SANITIZE_STRING) . ', ' .
      filter_var($_POST['country'], FILTER_SANITIZE_STRING) . ' - ' .
      filter_var($_POST['pin_code'], FILTER_SANITIZE_STRING);

   // Get total products and price from the form
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   // Check if cart has items for the user
   $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE uid = ?");
   $check_cart->execute([$user_id]);

   // Use num_rows to check if any rows are returned for this SELECT query
   if ($check_cart->get_result()->num_rows > 0) {
      // Insert the order into the orders table
      $insert_order = $conn->prepare("INSERT INTO `orders` (uid, name, number, email, method, address, total_product, total_price) 
                                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

      // Check if the insert was successful using affected_rows
      if ($conn->affected_rows > 0) {
         // Clear the cart after order is placed
         $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE uid = ?");
         $delete_cart->execute([$user_id]);

         $message[] = 'Order placed successfully!';
      } else {
         $message[] = 'Failed to place the order, please try again.';
      }
   } else {
      $message[] = 'Your cart is empty!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include '../include/user_header.php'; ?>

   <section class="checkout-orders">

      <form action="" method="POST">

         <h3>Your Orders</h3>

         <div class="display-orders">
            <?php
            $grand_total = 0;
            $cart_items = [];

            // Check the cart items for the logged-in user
            $query = "SELECT * FROM `cart` WHERE uid = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id); // "i" means the parameter is an integer
            $stmt->execute();
            $result = $stmt->get_result();

            // Display cart items
            if ($result->num_rows > 0) {
               while ($fetch_cart = $result->fetch_assoc()) {
                  $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quatity'] . ') - ';
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quatity']);
            ?>
                  <p> <?= $fetch_cart['name']; ?> <span>(<?= 'Rs. ' . $fetch_cart['price'] . '/- x ' . $fetch_cart['quatity']; ?>)</span> </p>
            <?php
               }
            } else {
               echo '<p class="empty">Your cart is empty!</p>';
            }
            ?>
            <input type="hidden" name="total_products" value="<?= $total_products; ?>">
            <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
            <div class="grand-total">Grand total: <span>Rs. <?= $grand_total; ?>/-</span></div>
         </div>

         <h3>Place Your Order</h3>

         <div class="flex">
            <div class="inputBox">
               <span>Your name:</span>
               <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="20" required>
            </div>
            <div class="inputBox">
               <span>Your number:</span>
               <input type="number" name="number" placeholder="Enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
            </div>
            <div class="inputBox">
               <span>Your email:</span>
               <input type="email" name="email" placeholder="Enter your email" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Payment method:</span>
               <select name="method" class="box" required>
                  <option value="cash on delivery">Cash on delivery</option>
                  <option value="credit card">Credit card</option>
                  <option value="paytm">Paytm</option>
                  <option value="paypal">Paypal</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Address line 01:</span>
               <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Address line 02:</span>
               <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>City:</span>
               <input type="text" name="city" placeholder="e.g. Mumbai" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>State:</span>
               <input type="text" name="state" placeholder="e.g. Maharashtra" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Country:</span>
               <input type="text" name="country" placeholder="e.g. India" class="box" maxlength="50" required>
            </div>
            <div class="inputBox">
               <span>Pin code:</span>
               <input type="number" min="0" name="pin_code" placeholder="e.g. 123456" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
            </div>
         </div>

         <input type="submit" name="order" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Place Order">

      </form>

   </section>

   <?php include '../include/ufooter.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>