<?php include('config/constants.php');

if (!isset($_SESSION['username'])) {
    header("Location: welcome.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Order System</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/css/lightgallery.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css1/style1.css">
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="header">

        <a href="#" class="logo"> <i class="fas fa-utensils"></i> food. </a>

        <nav class="navbar">
            <a href="<?php echo SITEURL; ?>">Home</a>
            <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
            <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
            <a href="#footer">Contact</a>
            
            <a href="<?php echo SITEURL; ?>view_order.php">Order</a>
            <a href="logout.php">Logout</a>
            <a <?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?></a>
        </nav>


        <div id="menu-btn" class="fas fa-bars"></div>

    </section>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="home" id="home">

        <div class="swiper home-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide slide" style="background: url(images1/home-slide-1.jpg) no-repeat;">
                    <div class="content">
                        <span>outstanding food</span>
                        <h3>SISTec Canteen</h3>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background: url(images1/home-slide-2.jpg) no-repeat;">
                    <div class="content">
                        <span>outstanding food</span>
                        <h3>morning moment</h3>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>

                <div class="swiper-slide slide" style="background: url(images1/home-slide-3.jpg) no-repeat;">
                    <div class="content">
                        <span>outstanding food</span>
                        <h3>authentic kitchen</h3>
                        <a href="#" class="btn">get started</a>
                    </div>
                </div>

            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>

        </div>

    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <section class="about" id="about">

        <div class="image">
            <img src="images1/about-img.png" alt="">
        </div>

        <div class="content">
            <h3 class="title">welcome to our canteen</h3>

            <div class="icons-container">
                <div class="icons">
                    <img src="images1/about-icon-1.png" alt="">
                    <h3>quality food</h3>
                </div>
                <div class="icons">
                    <img src="images1/about-icon-2.png" alt="">
                    <h3>food & drinks</h3>
                </div>
                <div class="icons">
                    <img src="images1/about-icon-3.png" alt="">
                    <h3>expert chefs</h3>
                </div>
            </div>
        </div>

    </section>

    <?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Various Food Categories</h2>

            <?php
            //Create SQL Query to Display CAtegories from Database
            $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ORDER BY id DESC LIMIT 3";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count rows to check whether the category is available or not
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                //CAtegories Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the Values like id, title, image_name
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
            ?>

                    <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //Check whether Image is available or not
                            if ($image_name == "") {
                                //Display MEssage
                                echo "<div class='error'>Image not Available</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                            }
                            ?>


                            <h3 class="float-text text-white"><mark style="background-color:white;"><?php echo $title; ?></mark></h3>
                        </div>
                    </a>

            <?php
                }
            } else {
                //Categories not Available
                echo "<div class='error'>Category not Added.</div>";
            }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Our Food Menu</h2>

            <?php

            //Getting Foods from Database that are active and featured
            //SQL Query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //Execute the Query
            $res2 = mysqli_query($conn, $sql2);

            //Count Rows
            $count2 = mysqli_num_rows($res2);

            //CHeck whether food available or not
            if ($count2 > 0) {
                //Food Available
                while ($row = mysqli_fetch_assoc($res2)) {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            //Check whether image available or not
                            if ($image_name == "") {
                                //Image not Available
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                            <?php
                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">Rs.<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

            <?php
                }
            } else {
                //Food Not Available 
                echo "<div class='error'>Food not available.</div>";
            }

            ?>





            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    

<!-- Footer Section -->

<section class="footer" id="footer">

<div class="icons-container">

   <div class="icons">
      <i class="fas fa-clock"></i>
      <h3>opening hours</h3>
      <p>9:45am to 5:00pm</p>
   </div>

   <div class="icons">
      <i class="fas fa-phone"></i>
      <h3>phone</h3>
      <p>1234567890</p>
      <p>6387694498</p>
   </div>

   <div class="icons">
      <i class="fas fa-envelope"></i>
      <h3>email</h3>
      <p>sisteccanteen@gmail.com</p>
      <p>group14@gmail.com</p>
   </div>

   <div class="icons">
      <i class="fas fa-map"></i>
      <h3>address</h3>
      <p>Bhopal, Madhya Pradesh, India - 462036</p>
   </div>

</div>


<div class="credit"> created by <span>Group_14</span></div>

</section>

<!-- Footer Section Ends -->

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <script>
        lightGallery(document.querySelector('.gallery .gallery-container'));
    </script>

</body>

</html>