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
include_once("mysqlConn.php");
$cid=$_GET["cid"]; // Get category ID to get products

$qry = "SELECT p.ProductID, p.ProductTitle, p.ProductImage, p.Price, p.Quantity, p.Offered, p.OfferedPrice, p.OfferEndDate, p.OfferStartDate
        FROM CatProduct cp INNER JOIN product p ON cp.ProductID=p.ProductID
		WHERE cp.CategoryID=? ORDER BY ProductTitle ASC" ;
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $cid);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

echo "<div class='container' mx-auto style='padding-top:20px; padding-bottom:100px; padding-left:60px;'>";
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
    
    // Checking if certain products has offer
    $currdate = date('Y-m-d');
    if ($row["Offered"] == 1 && $currdate >= $row["OfferStartDate"] && $currdate <= $row["OfferEndDate"]){
        $offeredPrice = number_format($row["OfferedPrice"],2);
        echo "<h5 class='card-title'>'$row[ProductTitle]'</h5>";
        echo "<p class='onSale'>On Sale!</p>";
        echo "<p>"."<s>"."Price: S$".$formattedPrice."</s>"."</p>";
        echo "<p class='noStock' style='font-size:15px;'>"."Offer Price: S$".$offeredPrice."</p>";
    }
    else{
        echo "<h5 class='card-title'>'$row[ProductTitle]'</h5>";
        echo "<p>"."Price: S$".$formattedPrice."</p>";
    }
    echo "<a href='$product' class='btn btn-primary justify-content-center viewProduct'>View Product</a>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}
echo "</div>";
echo "</div>";
$conn->close();
?>

<?php
include("footer.php");
?>

</html>