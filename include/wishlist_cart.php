<?php
// Make sure the session is started
if (isset($_SESSION['id'])) {
   $user_id = $_SESSION['id'];
} else {
   $user_id = '';
};

if (isset($_POST['add_to_wishlist'])) {
   $pid = filter_var($_POST['pid'], FILTER_SANITIZE_NUMBER_INT);
   $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
   $image = filter_var($_POST['image'], FILTER_SANITIZE_STRING);

   // Check if the product is already in the wishlist
   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE uid = ? AND pid = ?");
   $check_wishlist_numbers->bind_param("ii", $user_id, $pid);
   $check_wishlist_numbers->execute();
   $check_wishlist_numbers->store_result();

   // Check if the product is already in the cart
   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE uid = ? AND pid = ?");
   $check_cart_numbers->bind_param("ii", $user_id, $pid);
   $check_cart_numbers->execute();
   $check_cart_numbers->store_result();

   if ($check_wishlist_numbers->num_rows > 0) {
      $message[] = 'already added to wishlist!';
   } elseif ($check_cart_numbers->num_rows > 0) {
      $message[] = 'already added to cart!';
   } else {
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(uid, pid, name, pprice, pimg) VALUES(?,?,?,?,?)");
      $insert_wishlist->bind_param("iisss", $user_id, $pid, $name, $price, $image);

      if ($insert_wishlist->execute()) {
         $message[] = 'added to wishlist!';
      } else {
         $message[] = 'Error: ' . $insert_wishlist->error;
      }
   }
}


if (isset($_POST['add_to_cart'])) {

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $image = $_POST['image'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);

   // Check if item is already in the cart
   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND uid = ?");
   $check_cart_numbers->execute([$name, $user_id]);

   // Check the number of rows returned by the query using num_rows
   $result_cart = $check_cart_numbers->get_result();
   if ($result_cart->num_rows > 0) {
      $message[] = 'already added to cart!';
   } else {

      // Check if item is in the wishlist
      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND uid = ?");
      $check_wishlist_numbers->execute([$name, $user_id]);

      // Check the number of rows returned by the query using num_rows
      $result_wishlist = $check_wishlist_numbers->get_result();
      if ($result_wishlist->num_rows > 0) {
         // Delete from wishlist if exists
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND uid = ?");
         $delete_wishlist->execute([$name, $user_id]);
      }

      // Insert item into the cart
      $insert_cart = $conn->prepare("INSERT INTO `cart`(uid, pid, name, price, quatity, pimg) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $name, $price, $qty, $image]);
      $message[] = 'added to cart!';
   }
}
