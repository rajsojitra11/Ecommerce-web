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
    <title>home</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

 </head>

 <body>

    <?php include '../include/user_header.php'; ?>

    <div class="home-bg">

       <section class="home">

          <div class="swiper home-slider">

             <div class="swiper-wrapper">

                <div class="swiper-slide slide">
                   <div class="image">
                      <img src="images/home-img-1.png" alt="">
                   </div>
                   <div class="content">
                      <span>upto 50% off</span>
                      <h3>latest smartphones</h3>
                      <a href="shop.php" class="btn">shop now</a>
                   </div>
                </div>

                <div class="swiper-slide slide">
                   <div class="image">
                      <img src="images/home-img-2.png" alt="">
                   </div>
                   <div class="content">
                      <span>upto 50% off</span>
                      <h3>latest watches</h3>
                      <a href="shop.php" class="btn">shop now</a>
                   </div>
                </div>

                <div class="swiper-slide slide">
                   <div class="image">
                      <img src="images/home-img-3.png" alt="">
                   </div>
                   <div class="content">
                      <span>upto 50% off</span>
                      <h3>latest headsets</h3>
                      <a href="shop.php" class="btn">shop now</a>
                   </div>
                </div>

             </div>

             <div class="swiper-pagination"></div>

          </div>

       </section>

    </div>


    <section class="category">

       <h1 class="heading">shop by category</h1>

       <div class="swiper category-slider">

          <div class="swiper-wrapper">

             <a href="category.php?category=laptop" class="swiper-slide slide">
                <img src="images/icon-1.png" alt="">
                <h3>laptop</h3>
             </a>

             <a href="category.php?category=tv" class="swiper-slide slide">
                <img src="images/icon-2.png" alt="">
                <h3>tv</h3>
             </a>

             <a href="category.php?category=camera" class="swiper-slide slide">
                <img src="images/icon-3.png" alt="">
                <h3>camera</h3>
             </a>

             <a href="category.php?category=mouse" class="swiper-slide slide">
                <img src="images/icon-4.png" alt="">
                <h3>mouse</h3>
             </a>

             <a href="category.php?category=fridge" class="swiper-slide slide">
                <img src="images/icon-5.png" alt="">
                <h3>fridge</h3>
             </a>

             <a href="category.php?category=washing" class="swiper-slide slide">
                <img src="images/icon-6.png" alt="">
                <h3>washing machine</h3>
             </a>

             <a href="category.php?category=smartphone" class="swiper-slide slide">
                <img src="images/icon-7.png" alt="">
                <h3>smartphone</h3>
             </a>

             <a href="category.php?category=watch" class="swiper-slide slide">
                <img src="images/icon-8.png" alt="">
                <h3>watch</h3>
             </a>

          </div>

          <div class="swiper-pagination"></div>

       </div>

    </section>

    <section class="home-products">

       <h1 class="heading">latest products</h1>

       <div class="swiper products-slider">

          <div class="swiper-wrapper">

             <?php

               $select_products = mysqli_query($conn, "SELECT * FROM `product` LIMIT 6");

               if (mysqli_num_rows($select_products) > 0) {
                  while ($fetch_product = mysqli_fetch_assoc($select_products)) {
               ?>
                   <form action="" method="post" class="swiper-slide slide">
                      <input type="hidden" name="pid" value="<?= $fetch_product['pid']; ?>">
                      <input type="hidden" name="name" value="<?= $fetch_product['productname']; ?>">
                      <input type="hidden" name="price" value="<?= $fetch_product['productprice']; ?>">
                      <input type="hidden" name="image" value="<?= $fetch_product['productimg']; ?>">
                      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
                      <a href="quick_view.php?pid=<?= $fetch_product['pid']; ?>" class="fas fa-eye"></a>
                      <img src="../admin<?= $fetch_product['productimg']; ?>" alt="No img found">

                      <div class="name"><?= htmlspecialchars($fetch_product['productname']); ?></div>

                      <div class="flex">
                         <div class="price"><span>Rs. </span><?= $fetch_product['productprice']; ?><span>/-</span></div>
                         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                      </div>
                      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                   </form>
             <?php
                  }
               } else {
                  echo '<p class="empty">no products added yet!</p>';
               }
               ?>

          </div>

          <div class="swiper-pagination"></div>

       </div>

    </section>









    <?php include '../include/ufooter.php'; ?>

    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

    <script src="js/script.js"></script>

    <script>
       var swiper = new Swiper(".home-slider", {
          loop: true,
          spaceBetween: 20,
          pagination: {
             el: ".swiper-pagination",
             clickable: true,
          },
          autoplay: {
             delay: 1500, // 1000ms = 2 seconds
             disableOnInteraction: false, // This ensures autoplay does not stop after user interaction
          },
       });

       var swiper = new Swiper(".category-slider", {
          loop: true,
          spaceBetween: 20,
          pagination: {
             el: ".swiper-pagination",
             clickable: true,
          },
          breakpoints: {
             0: {
                slidesPerView: 2,
             },
             650: {
                slidesPerView: 3,
             },
             768: {
                slidesPerView: 4,
             },
             1024: {
                slidesPerView: 5,
             },
          },
       });

       var swiper = new Swiper(".products-slider", {
          loop: true,
          spaceBetween: 20,
          pagination: {
             el: ".swiper-pagination",
             clickable: true,
          },
          breakpoints: {
             550: {
                slidesPerView: 2,
             },
             768: {
                slidesPerView: 2,
             },
             1024: {
                slidesPerView: 3,
             },
          },
          autoplay: {
             delay: 1000, // ms = 2 seconds
             disableOnInteraction: false, // This ensures autoplay does not stop after user interaction
          },
       });
    </script>



 </body>

 </html>