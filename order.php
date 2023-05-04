
<?php include('partials-front/menu.php'); ?>

    <?php 
        //CHeck whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //Get the Food id and details of the selected food
            $food_id = $_GET['food_id'];

            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Food not Availabe
                //REdirect to Home Page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search2">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Rs.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter Your Name" class="input-responsive" pattern="[a-z A-Z]+" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" id="phone" name="contact" placeholder="Enter Your Number" class="input-responsive" pattern="^(?!0|1|2|3|4|5)[0-9]{10}" required>

                    <!-- <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required oninvalid="setCustomValidity('Email must contain at least one character or string.')" oninput="setCustomValidity('')">required> -->
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter Your Email" class="input-responsive" pattern="^[a-zA-Z0-9._%+-]*[a-zA-Z][a-zA-Z0-9._%+-]*@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required oninvalid="setCustomValidity('Email must contain at least one letter or character.')" oninput="setCustomValidity('')">
                    
                    <div class="order-label">when you want</div>
                        <input type="datetime-local" class="input-responsive" name="time">
                    
                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                //CHeck whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    // Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total = price x qty 

                    date_default_timezone_set('Asia/Kolkata');
                    $order_date = date("Y-m-d h:i:sa"); //Order Date in India Time Zone
                    
                    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled

                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $recieving_time = $_POST['time'];


                    //Save the Order in Databaase
                    //Create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                        food = '$food',
                        price = $price,
                        qty = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        recieving_time = '$recieving_time'
                    ";

                    //echo $sql2; die();

                    //Execute the Query
                    $res2 = mysqli_query($conn, $sql2);

                    //Check whether query executed successfully or not
                    // if($res2==true)
                    // {
                    //     //Query Executed and Order Saved
                    //     $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully.</div>";
                    //     //header('location:'.SITEURL);
                    // }
                    // else
                    // {
                    //     //Failed to Save Order
                    //     $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
                    //     header('location:'.SITEURL);
                    // }
                    if ($res2 == true) {
                        //Query Executed and Order Saved
                        echo "<script>alert('Food Ordered Successfully.')</script>";
                      } else {
                        //Failed to Save Order
                        echo "<script>alert('Failed to Order Food.')</script>";
                      }

                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>