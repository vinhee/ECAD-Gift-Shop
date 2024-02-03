<?php
/*include_once("mysqlConn.php");

// Function to check if the quantity is available in stock
function checkQuantity($productID, $quantity) {
    global $conn;

    if ($quantity >= 0 || $productID <= 0) {
        return "Invalid quantity or product ID.";
    }

    // Query to get the current stock quantity for the product
    $stockQuery = "SELECT Quantity FROM Product WHERE ProductID = $productID";
    $stockResult = mysqli_query($conn, $stockQuery);

    if ($stockResult) {
        $stockRow = mysqli_fetch_assoc($stockResult);
        $stockQuantity = $stockRow["Quantity"];

        if ($quantity > $stockQuantity) {
            return "Error: Not enough stock available for this product. Please update your quantity.";
        } else {
            return "Success: Quantity is within the available stock. You can proceed.";
        }
    } else {
        return "Error retrieving stock information for this product.";
    }
}

// Check quantity if POST data is received
if ($_POST) {
    $productID = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    $result = checkQuantity($productID, $quantity);
    echo $result;
} else {
    // Redirect if accessed directly without POST data
    header("Location: index.php"); // Change to the appropriate page
    exit;
}
?>*/

