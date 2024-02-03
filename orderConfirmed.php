<?php 
session_start();
include("header.php");

echo "<p>Thank you for your purchase.&nbsp;&nbsp;";  
 echo '<a href="index.php">Continue shopping</a></p>'; 


// this order ID part still not working properly
if(isset($_SESSION["OrderID"])) {	
    echo "<p>Checkout successful. Your order number is $_SESSION[OrderID]</p>";
    echo "<p>Thank you for your purchase.&nbsp;&nbsp;";
    echo '<a href="index.php">Continue shopping</a></p>';
} else {
   // echo "<p>Order ID not found. There might be an issue with your order.</p>";
}

//include("footer.php");
?>
