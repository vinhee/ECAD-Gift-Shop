<?php
session_start();

// Include necessary files
include_once("paypal_payment.php"); // Include the file that contains PayPal settings
include_once("mysqlConn.php"); 

$shopperID = isset($_SESSION['shopperID']) ? $_SESSION['shopperID'] : 0;

// Mark the order as placed
// $updateOrderQuery = "UPDATE ShopCart SET OrderPlaced = 1 WHERE ShopperID = $shopperID AND OrderPlaced = 0";
// mysqli_query($conn, $updateOrderQuery);

if ($_POST) // Post Data received from the Shopping cart page.
{
    // To Do 6 (DIY): Check to ensure each product item saved in the associative
    //                array is not out of stock

    // End of To Do 6

    $paypal_data = '';
    // Get all items from the shopping cart, concatenate to the variable $paypal_data
    // $_SESSION['Items'] is an associative array
    foreach ($_SESSION['Items'] as $key => $item) {
        $paypal_data .= '&L_PAYMENTREQUEST_0_QTY' . $key . '=' . urlencode($item["quantity"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT' . $key . '=' . urlencode($item["price"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME' . $key . '=' . urlencode($item["name"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER' . $key . '=' . urlencode($item["productId"]);
    }

    // To Do 1A: Compute GST amount 7% for Singapore, round the figure to 2 decimal places
    $_SESSION["SubTotal"] = 0; // Initialize SubTotal to zero

    foreach ($_SESSION['Items'] as $key => $item) {
        $_SESSION["SubTotal"] += $item["quantity"] * $item["price"];
    }

    $_SESSION["Tax"] = round($_SESSION["SubTotal"] * 0.09, 2);

    // To Do 1B: Compute Shipping charge - S$2.00 per trip
    $deliveryMode = $_POST["DeliveryMode"];
    if ($deliveryMode == "Normal") {
        $_SESSION["ShipCharge"] = 5.00;
    } elseif ($deliveryMode == "Express") {
        $_SESSION["ShipCharge"] = 10.00;
    } else {
        $_SESSION["ShipCharge"] = 0.00;
    }

    // Data to be sent to PayPal
    $padata = '&CURRENCYCODE=' . urlencode($PayPalCurrencyCode) .
        '&PAYMENTACTION=Sale' .
        '&ALLOWNOTE=1' .
        '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode) .
        '&PAYMENTREQUEST_0_AMT=' . urlencode($_SESSION["SubTotal"] +
            $_SESSION["Tax"] +
            $_SESSION["ShipCharge"]) .
        '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($_SESSION["SubTotal"]) .
        '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($_SESSION["ShipCharge"]) .
        '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($_SESSION["Tax"]) .
        '&BRANDNAME=' . urlencode("Mamaya e-BookStore") .
        $paypal_data .
        '&RETURNURL=' . urlencode($PayPalReturnURL) .
        '&CANCELURL=' . urlencode($PayPalCancelURL);

    //We need to execute the "SetExpressCheckOut" method to obtain PayPal token
    $httpParsedResponseAr = PPHttpPost('SetExpressCheckout', $padata, $PayPalApiUsername,
        $PayPalApiPassword, $PayPalApiSignature, $PayPalMode);

    //Respond according to the message we receive from Paypal
    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) ||
        "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])
    ) {
        if ($PayPalMode == 'sandbox')
            $paypalmode = '.sandbox';

        else
            $paypalmode = '';

        //Redirect user to PayPal store with Token received.
        $paypalurl = 'https://www' . $paypalmode .
            '.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=' .
            $httpParsedResponseAr["TOKEN"] . '';
        header('Location: ' . $paypalurl);
    } else {
        //Show error message
        echo "<div style='color:red'><b>SetExpressCheckOut failed : </b>" .
            urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . "</div>";
        echo "<pre>" . print_r($httpParsedResponseAr) . "</pre>";
    }
}

// Paypal redirects back to this page using ReturnURL, We should receive TOKEN and Payer ID
if (isset($_GET["token"]) && isset($_GET["PayerID"])) {
    //we will be using these two variables to execute the "DoExpressCheckoutPayment"
    //Note: we haven't received any payment yet.
    $token = $_GET["token"];
    $payerid = $_GET["PayerID"];
    $paypal_data = '';
    $SubTotal = '';

    // Get all items from the shopping cart, concatenate to the variable $paypal_data
    // $_SESSION['Items'] is an associative array
    foreach ($_SESSION['Items'] as $key => $item) {
        $paypal_data .= '&L_PAYMENTREQUEST_0_QTY' . $key . '=' . urlencode($item["quantity"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_AMT' . $key . '=' . urlencode($item["price"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NAME' . $key . '=' . urlencode($item["name"]);
        $paypal_data .= '&L_PAYMENTREQUEST_0_NUMBER' . $key . '=' . urlencode($item["productId"]);
    }

    // Data to be sent to PayPal
    $padata = '&TOKEN=' . urlencode($token) .
        '&PAYERID=' . urlencode($payerid) .
        '&PAYMENTREQUEST_0_PAYMENTACTION=' . urlencode("SALE") .
        $paypal_data .
        '&PAYMENTREQUEST_0_ITEMAMT=' . urlencode($_SESSION["SubTotal"]) .
        '&PAYMENTREQUEST_0_TAXAMT=' . urlencode($_SESSION["Tax"]) .
        '&PAYMENTREQUEST_0_SHIPPINGAMT=' . urlencode($_SESSION["ShipCharge"]) .
        '&PAYMENTREQUEST_0_AMT=' . urlencode($_SESSION["SubTotal"] +
            $_SESSION["Tax"] +
            $_SESSION["ShipCharge"]) .
        '&PAYMENTREQUEST_0_CURRENCYCODE=' . urlencode($PayPalCurrencyCode);

    //We need to execute the "DoExpressCheckoutPayment" at this point 
    //to receive payment from the user.
    $httpParsedResponseAr = PPHttpPost('DoExpressCheckoutPayment', $padata,
        $PayPalApiUsername, $PayPalApiPassword,
        $PayPalApiSignature, $PayPalMode);

    //Check if everything went ok..
    if ("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) ||
        "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])
    ) {
        // Automatically remove items from the shopping cart after payment
        $deleteCartItemsQuery = "DELETE FROM ShopCartItem WHERE ShopCartID IN (SELECT ShopCartID FROM ShopCart WHERE ShopperID = $shopperID AND OrderPlaced = 0)";
        mysqli_query($conn, $deleteCartItemsQuery);
        error_log("Shopper ID: $shopperID");
        error_log("Delete Query: $deleteCartItemsQuery");


		header('Location: orderConfirmed.php');
        exit; 
        
        // ... rest of your code

    } else {
        echo "<div style='color:red'><b>DoExpressCheckoutPayment failed : </b>" .
            urldecode($httpParsedResponseAr["L_LONGMESSAGE0"]) . '</div>';
        echo "<pre>" . print_r($httpParsedResponseAr) . "</pre>";
    }
}
?>
