<?php include('config/constants.php'); ?>

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
    <link rel="stylesheet" href="style3.css">
    
</head>

<body>
  
    <section class="header">

        <a href="#" class="logo"> <i class="fas fa-utensils"></i> food. </a>

        <nav class="navbar">
            <a href="<?php echo SITEURL; ?>">Home</a>
            <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
            <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
            
            
            <a href="<?php echo SITEURL; ?>view_order.php">Order</a>
            
            <a href="logout.php">Logout</a>
        </nav>

        <div id="menu-btn" class="fas fa-bars"></div>

    </section>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

    <script>
        lightGallery(document.querySelector('.gallery .gallery-container'));
    </script>

    <!-- Navbar Section Ends Here -->