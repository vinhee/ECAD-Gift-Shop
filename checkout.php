<?php
//session_start();

// Include necessary files
include_once('mysqlConn.php');  // Include your database connection file
/*
if ($_POST)
{
    

    // Check if the user is logged in
    
    if (!isset($_SESSION['shopperID'])) {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit;
    }

    // Fetch the shopper's shopping cart items
    $shopperID = $_SESSION['shopperID'];
    $query = "SELECT * FROM ShopCart WHERE ShopperID = $shopperID AND OrderPlaced = 0";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $cartData = mysqli_fetch_assoc($result);
        $cartID = $cartData['ShopCartID'];
        $subtotal = $cartData['SubTotal'];
        $taxRate = 0.0;  // Fetch current GST rate from the database based on the effective date

        // Calculate delivery charge based on the delivery mode
        //$deliveryMode = $cartData['DeliveryMode'];
        //$deliveryCharge = ($deliveryMode == 'Normal') ? 5.00 : 10.00;
        $deliveryMode = $_POST["DeliveryMode"];
        if ($deliveryMode = "Normal Delivery")
        {
            $deliveryCharge = 5.00;
        }
        else if ($deliveryMode = "Express Delivery")
        {
            $deliveryCharge = 10.00;
        }
        else
        {
            $deliveryCharge = 0.00;
        }
        // Calculate tax based on the GST rate
        $tax = ($subtotal + $deliveryCharge) * ($taxRate / 100);

        // Calculate total amount payable
        $totalAmount = $subtotal + $deliveryCharge + $tax;

        // Update ShopCart table with delivery charge and tax
        $updateQuery = "UPDATE ShopCart SET Tax = $tax, ShipCharge = $deliveryCharge, Total = $totalAmount WHERE ShopCartID = $cartID";
        mysqli_query($conn, $updateQuery);
    } else {
        // No items in the cart
        echo "Your shopping cart is empty.";
        exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data
    // You can access form data using $_POST array

    // Redirect to PayPal payment page
    header("Location: paypal_payment.php?cartID=$cartID");
    header("Location: checkoutProcess.php");
    exit;
}
}
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
        <!-- <h1>Checkout</h1> -->
        <form method="post" action="checkoutProcess.php">
            <!-- Add your checkout form fields here -->
            <!--
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            -->
            <!-- Add more fields as needed -->
            <div class="mb-3" style="text-align: right">
                <label for="DeliveryMode" class="form-label">Delivery Mode</label>
                <!--
                <input type="text" class="form-control" id="DeliveryMode" name="DeliveryMode" 
                       value ="Normal Delivery" required>
                -->
                <select name="DeliveryMode" id="DeliveryMode">
                    <option value="Normal">Normal Delivery</option>
                    <option value="Express">Express Delivery</option>
                </select>
            </div>
            <input type='image' style='float:right;' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif'>
        </form>
    <!-- PayPal Checkout Button -->
<!--
<div class="mb-3">
    <form method='post' action='https://www.sandbox.paypal.com/cgi-bin/webscr'>
        Add your PayPal business account email for the sandbox 
        <input type='hidden' name='business' value='sb-wqsmg29246340@business.example.com'>
        Set the currency code to SGD for the sandbox
        <input type='hidden' name='currency_code' value='SGD'>
        Set the return and cancel URLs for the sandbox
        <input type='hidden' name='return' value='http://yourdomain.com/checkoutSuccess.php'>
        <input type='hidden' name='cancel_return' value='http://yourdomain.com/checkoutCancel.php'>
        Add other necessary PayPal parameters
        


        <input type='image' style='float:right;' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif'>
    </form>
</div>
-->


</div>
</body>
</html>
