<!--Done by: Vin Hee-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS and JS files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>

<?php
include("navbar.php");
?>
<div style="margin:auto;">
<div class='container text-center' style='padding-top:20px;'>
    <div class='col-md-12 justify-content-center'>
        <h2><?php echo "$_GET[catName]"; ?></h2>
    </div>
</div>

<?php
include("mysqlConn.php");
$cid=$_GET["cid"]; // Get category ID to get products

$qry = "SELECT p.ProductID, p.ProductTitle, p.ProductImage, p.Price, p.Quantity
        FROM CatProduct cp INNER JOIN product p ON cp.ProductID=p.ProductID
		WHERE cp.CategoryID=?" ;
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $cid);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

echo "<div class='container' mx-auto style='padding-top:20px; padding-bottom:100px;'>";
echo "<div class='row justify-content-center'>";
while($row = $result->fetch_array()) {
    $product = "productDesc.php?pid=$row[ProductID]"; // Getting Product ID
	$formattedPrice = number_format($row["Price"],2); // Getting Product Price
    $img = "$row[ProductImage]"; // Getting Product Image Name
    $imgPathname = "Images/Products/$img";
    
    echo "<div class='col-md-4'>";
    echo "<div class='card' style='width: 18rem;'>";
    echo "<img src='$imgPathname' class='card-img-top'>";
    echo "<div class='card-body text-center'>";
    echo "<h5 class='card-title'>'$row[ProductTitle]'</h5>";
    echo "<a href='$product' class='btn btn-primary justify-content-center'>View Product</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";
echo "</div>";
?>

<?php
include("footer.php");
?>

</html>