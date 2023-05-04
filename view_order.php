<?php include('partials-front/menu.php'); ?>

<?php
if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}

if (isset($_POST['search'])) {
    $email = $_POST['email'];
    if (!empty($email)) {
        $sql = "SELECT o.*, u.email
                    FROM tbl_order o
                    INNER JOIN users u ON o.customer_email = u.email
                    WHERE u.email = '$email'";
        $res = mysqli_query($conn, $sql);
    }
}
?>

<section class="food-search text-center">
    <div class="container">
   <h1>Cooking In Progress...</h1>
    <div id="cooking">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div id="area">
            <div id="sides">
                <div id="pan"></div>
                <div id="handle"></div>
            </div>
            <div id="pancake">
                <div id="pastry"></div>
            </div>
        </div>
    </div>
        <form method="post">
            <input type="text" name="email" placeholder="Enter your email to see your food status" class="input-responsive" >
            <button type="submit" name="search" class="btn btn-primary">Search</button>
        </form>
    </div>
</section>
<div class="main-content">
    <div class="wrapper">
<?php
if (isset($res)) {
    $count = mysqli_num_rows($res);
    $sn = 1;

    if ($count > 0) {
        echo '<h2 class="text-center">Order Status</h2>';
        echo '<table class="table table-dark table-striped">';
        echo '<tr class="table-dark">';
        echo '<th>S.No.</th>';
        echo '<th>Food</th>';
        echo '<th>Price</th>';
        echo '<th>Quantity</th>';
        echo '<th>Total</th>';
        echo '<th>Order Date</th>';
        echo '<th>Status</th>';
        echo '</tr>';

        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $food = $row['food'];
            $price = $row['price'];
            $qty = $row['qty'];
            $total = $row['total'];
            $order_date = $row['order_date'];
            $status = $row['status'];

            echo '<tr>';
            echo '<td>' . $sn++ . '</td>';
            echo '<td>' . $food . '</td>';
            echo '<td>' . $price . '</td>';
            echo '<td>' . $qty . '</td>';
            echo '<td>' . $total . '</td>';
            echo '<td>' . $order_date . '</td>';
            echo '<td>';

            if ($status == "Ordered") {
                echo '<label>' . $status . '</label>';
            } elseif ($status == "On Delivery") {
                echo '<label style="color: orange;">' . $status . '</label>';
            } elseif ($status == "Delivered") {
                echo '<label style="color: green;">' . $status . '</label>';
            } elseif ($status == "Cancelled") {
                echo '<label style="color: red;">' . $status . '</label>';
            }

            echo '</td>';
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No orders found for ' . $email . '</p>';
    }
}
?>
  </div>
    
    </div>


