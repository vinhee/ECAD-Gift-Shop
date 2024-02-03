<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once('mysqlConn.php');
include_once('cartFunctions.php');
include("navbar.php");

$shopperID = isset($_SESSION['shopperID']) ? $_SESSION['shopperID'] : 0;

$query = "SELECT SCI.ShopCartID, SCI.ProductID, P.ProductTitle, SCI.Price, SCI.Quantity
          FROM ShopCartItem SCI
          INNER JOIN Product P ON SCI.ProductID = P.ProductID
          WHERE SCI.ShopCartID IN (SELECT ShopCartID FROM ShopCart WHERE ShopperID = $shopperID AND OrderPlaced = 0)";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error: " . mysqli_error($conn));
}

// Initialize the total number of items
$totalItems = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css"
        integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
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

        th, td {
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
                while ($row = mysqli_fetch_assoc($result)) {
                    $total = $row['Price'] * $row['Quantity'];
                    // Update the total number of items
                    $totalItems += $row['Quantity'];
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

        <?php
        // Calculate total amount
        $totalAmount = 0;
        mysqli_data_seek($result, 0);

        while ($row = mysqli_fetch_assoc($result)) {
            $totalAmount += $row['Price'] * $row['Quantity'];
        }

        // Check if the subtotal is more than S$200
        $shippingCharge = ($totalAmount > 200) ? 0 : 10; // Assuming regular charge is S$10
        ?>

        <p class="total">Total Amount: $<?php echo $totalAmount; ?></p>
        <p class="total">Shipping Charge: S$<?php echo $shippingCharge; ?></p>
        <p class="total">Total Items in Cart: <?php echo $totalItems; ?></p>

        <?php
        // Include checkout.php only if the total amount is more than 0 (items in the cart)
        if ($totalAmount > 0) {
            include("checkout.php");
        }
        ?>
        <br /><br />
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-En1XJoxhJhBKUEzPBv7n8WpgwR2YzcV9It3zU0dR9fojWAtWwQC2wJ6gFk1Awgw5"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
        integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>

<?php include("footer.php"); ?>
</body>
</html>
