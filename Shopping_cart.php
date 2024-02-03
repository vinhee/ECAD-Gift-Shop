<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include database connection
include_once('mysqlConn.php');
include_once('cartFunctions.php');
include("navbar.php");

// Get shopper ID from the session
$shopperID = isset($_SESSION['shopperID']) ? $_SESSION['shopperID'] : 0;

// Fetch shopping cart items for the logged-in shopper
$query = "SELECT SCI.ShopCartID, SCI.ProductID, P.ProductTitle, P.Quantity AS StockQuantity, SCI.Price, SCI.Quantity
          FROM ShopCartItem SCI
          INNER JOIN Product P ON SCI.ProductID = P.ProductID
          WHERE SCI.ShopCartID IN (SELECT ShopCartID FROM ShopCart WHERE ShopperID = $shopperID AND OrderPlaced = 0)";

$result = mysqli_query($conn, $query);

// Check for errors in the query
if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Calculate total amount and tax
$totalAmount = 0;
$gstRate = 9.00; // You need to fetch the current GST rate from the database, update this value accordingly

mysqli_data_seek($result, 0); // Reset result set to the beginning
while ($row = mysqli_fetch_assoc($result)) {
    $totalAmount += $row['Price'] * $row['Quantity'];

    // Check if order quantity exceeds stock quantity
    if ($row['Quantity'] > $row['StockQuantity']) {
        // Display an error message if needed
    }
}

// Calculate tax based on the GST rate
$tax = $totalAmount * ($gstRate / 100);

// Calculate total amount including tax
$totalAmountIncludingTax = $totalAmount + $tax;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <!-- Add your custom CSS styles here -->
    <style>
        body {
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dee2e6;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 10px;
        }

        .checkout-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1.2em;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Shopping Cart</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                mysqli_data_seek($result, 0); // Reset result set to the beginning
                while ($row = mysqli_fetch_assoc($result)) {
                    $total = $row['Price'] * $row['Quantity'];
                    echo "<tr>";
                    echo "<td>{$row['ProductTitle']}</td>";
                    echo "<td>{$row['Price']}</td>";
                    echo "<td>";
                    echo "<form method='post' action='cartFunctions.php'>";
                    echo "<input type='number' name='quantity' value='{$row['Quantity']}' min='1'>";
                    echo "<input type='hidden' name='action' value='update'>";
                    echo "<input type='hidden' name='product_id' value='{$row['ProductID']}'>";
                    echo "<input type='submit' name='update_cart' value='Update'>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td>$total</td>";
                    echo "<td>";
                    echo "<form method='post' action='cartFunctions.php'>";
                    echo "<input type='hidden' name='action' value='delete'>";
                    echo "<input type='hidden' name='product_id' value='{$row['ProductID']}'>";
                    echo "<input type='submit' name='delete_cart' value='Remove'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <?php if ($totalAmount > 0): ?>
            <p class="total">Total Amount (Excluding Tax): $<?php echo $totalAmount; ?></p>
            <?php if (isset($tax)): ?>
                <p class="total">GST (<?php echo $gstRate; ?>%): $<?php echo $tax; ?></p>
            <?php endif; ?>
            <?php if (isset($totalAmountIncludingTax)): ?>
                <p class="total">Total Amount (Including Tax): $<?php echo $totalAmountIncludingTax; ?></p>
            <?php endif; ?>

            <?php
            // Validate order quantity against stock quantity before allowing checkout
            $allowCheckout = true;

            mysqli_data_seek($result, 0); // Reset result set to the beginning
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if order quantity exceeds stock quantity
                if ($row['Quantity'] > $row['StockQuantity']) {
                    $allowCheckout = false;
                    echo "<div class='alert alert-danger' role='alert'>";
                    echo "Error: The quantity for {$row['ProductTitle']} exceeds the available stock. Please update the quantity.";
                    echo "</div>";
                }
            }
            ?>

            <?php if ($allowCheckout): ?>
                <a href="checkout.php" class="btn btn-success checkout-btn">Checkout</a>
            <?php endif; ?>

        <?php else: ?>
            <p class="total">Your shopping cart is empty.</p>
        <?php endif; ?>

        <br /><br />
    </div>

    <!-- Bootstrap JS and other scripts go here -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-En1XJoxhJhBKUEzPBv7n8WpgwR2YzcV9It3zU0dR9fojWAtWwQC2wJ6gFk1Awgw5"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

    <?php include("footer.php"); ?>
</body>

</html>
