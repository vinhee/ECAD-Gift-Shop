<?php 
session_start();
include("navbar.php");
include_once("mysqlConn.php");

function generateOrderID() {
    $randomNumber = mt_rand(1, 99);
    $orderID = 'ORD ' . $randomNumber; // Added space between 'ORD' and random number
    return $orderID;
}

$_SESSION['OrderID'] = generateOrderID();

// Check if OrderID is set in the session
if (isset($_SESSION['OrderID'])) {
    $orderID = $_SESSION['OrderID'];
    echo "<div style='text-align: center; padding: 20px;'>";
    echo "<h2>Checkout successful</h2>";
    echo "<p>Your order number is <strong>$orderID</strong></p>";
    echo "<p>Thank you for your purchase!</p>";
    $shopperID = isset($_SESSION['shopperID']) ? $_SESSION['shopperID'] : 0;

    echo "<p><a href='index.php' style='text-decoration: none; color: #007bff;'>Continue Shopping</a></p>";
    $deleteCartItemsQuery = "DELETE FROM ShopCartItem WHERE ShopCartID IN (SELECT ShopCartID FROM ShopCart WHERE ShopperID = $shopperID AND OrderPlaced = 0)";
    mysqli_query($conn, $deleteCartItemsQuery);
   
    echo "</div>";
    // Additional code related to the successful checkout
} else {
    echo "<div style='text-align: center; padding: 20px;'>";
    echo "<h2>Error</h2>";
    echo "<p>Order ID not set in the session.</p>";
    echo "</div>";
}

include("footer.php");
?>
