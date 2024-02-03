<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <style>
        body {
            padding-top: 60px;
        }

        .container {
            text-align: center;
        }

        .navbar {
            background-color: #f8f9fa;
            padding: 15px 0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #f8f9fa;
            padding: 15px 0;
            box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.1);
        }

        .checkout-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .paypal-button {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>
        <form method="post" action="checkoutProcess.php" class="checkout-form">
            <div class="mb-3" style="text-align: right">
                <label for="DeliveryMode" class="form-label">Delivery Mode</label>
                <select name="DeliveryMode" id="DeliveryMode" class="form-select">
                    <option value="Normal">Normal Delivery</option>
                    <option value="Express">Express Delivery</option>
                </select>
            </div>
            <div class="paypal-button">
                <input type='image' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' alt='PayPal'>
            </div>
        </form>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>
