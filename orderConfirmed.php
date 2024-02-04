<?php 
session_start();
include("navbar.php");
include_once("mysqlConn.php");

function generateOrderID() {
    $randomNumber = mt_rand(1, 99);
    $orderID = 'ORD ' . $randomNumber; // Added space between 'ORD' and random number
    return $orderID;
}
$shopperID = isset($_SESSION['shopperID']) ? $_SESSION['shopperID'] : 0;
$cartItemsQuery = "SELECT SCI.ProductID, SCI.Quantity
                   FROM shopcartitem SCI
                   INNER JOIN ShopCart SC ON SCI.ShopCartID = SC.ShopCartID
                   WHERE SC.ShopperID = $shopperID AND SC.OrderPlaced = 0";
$cartItemsResult = mysqli_query($conn, $cartItemsQuery);

if (!$cartItemsResult) {
    die("Error: " . mysqli_error($conn));
}

// Iterate through each product item in the shopping cart
while ($cartItem = mysqli_fetch_assoc($cartItemsResult)) {
    $productID = $cartItem['ProductID'];
    $quantityPurchased = $cartItem['Quantity'];

    // To Do 5: Execute SQL statement to reduce the stock quantity in the product table
    $updateQuantityQuery = "UPDATE Product SET Quantity = Quantity - $quantityPurchased WHERE ProductID = $productID";
    
    // Execute the update query
    mysqli_query($conn, $updateQuantityQuery);

    // Check for errors in the update query
    if (mysqli_errno($conn)) {
        die("Error updating stock quantity: " . mysqli_error($conn));
    }
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

