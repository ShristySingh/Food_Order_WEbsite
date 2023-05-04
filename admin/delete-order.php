<?php
include('../config/constants.php');

// Check whether the order ID is set or not
if(isset($_GET['id']))
{
    // Get the ID of the order to be deleted
    $id = $_GET['id'];

    // Delete the order from database
    $sql = "DELETE FROM tbl_order WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    // Check whether the query was successful or not
    if($res==true)
    {
        // Order deleted successfully
        $_SESSION['delete'] = "<div class='success'>Order deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        // Failed to delete order
        $_SESSION['delete'] = "<div class='error'>Failed to delete order. Please try again later.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
}
else
{
    // Redirect to manage order page
    header('location:'.SITEURL.'admin/manage-order.php');
}
?>
