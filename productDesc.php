<!--Done by Vin Hee-->
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<?php
include("navbar.php");
?>

<?php
$pid = $_GET["pid"];

include("mysqlConn.php");
$qry = "SELECT * from product where ProductID=?";
$stmt = $conn->prepare($qry);
$stmt->bind_param("i", $pid); 	// "i" - integer 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

while ($row = $result->fetch_array()){
    $img = "$row[ProductImage]"; // Getting Product Image Name
    $imgPathname = "Images/Products/$img";

    $qry ="SELECT s.SpecName, ps.SpecVal FROM productspec ps
           INNER JOIN specification s ON ps.SpecID=s.SpecID
           WHERE ps.ProductID=?
           ORDER BY ps.priority";
    $stmt = $conn->prepare($qry);
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result2 = $stmt->get_result();
    $stmt->close();



    echo "<div class='container' text-center' style='padding-top:100px; padding-bottom:50px;'>";
    echo "<div class='row'>"; // Container split into 2 columns

    echo "<div class='col-md-6 addCartBtn'>";    // content for left column
    echo "<img src='$imgPathname'>";
    echo "</div>";

    echo "<div class='col-md-6 justify-content-center'>";     // content for right column (split into 4 rows)
    echo "<div class='row-mb-3 prodCard'>";
    echo "<h2>" . $row['ProductTitle'] . "</h2>";
    echo "</div>";

    if($row["Offered"] == 1){
        echo "<div class='col-md-6 justify-content-center'>";     // content for right column (split into 4 rows)
        echo "<div class='row-mb-3' style='padding-bottom: 10px;' >";
        echo "<p class='onSale text-center'>On Sale!</p>";
        echo "</div>";

        $formattedPrice = number_format($row["Price"], 2);
        $offeredPrice = number_format($row["OfferedPrice"],2);
        echo "<div class='row-mb-3 prodCard'>";
        echo "<h4>". "<s>". "Price:" . "S$" . $formattedPrice ."</s>"."</h4>";
        echo "<h4 class='salePrice'>". "Offered Price: S$" . $offeredPrice ."</h4>";
        echo "</div>";
    }
    else {
        $formattedPrice = number_format($row["Price"], 2);
        echo "<div class='row-mb-3 prodCard'>";
        echo "<h4>". "Price: S$" . $formattedPrice . "</h4>";
        echo "</div>";
    }

    echo "<h5>Product Description:</h5>";
    echo "<div class='row-mb-3 prodCard'>"; // Product Description
    echo $row['ProductDesc'];
    echo "</div>";

    echo "<h5>Product Specifications:</h5>";
    echo "<div class='row-mb-3 prodCard'>"; // Product Specifications
    while ($row2 = $result2->fetch_array()){
        echo $row2["SpecName"].": ".$row2["SpecVal"]."<br />";
    }
    echo "</div>";

    echo "<div class='row-mb-3 addCartBtn'>"; // Add to Cart button
    if($row["Quantity"] < 1){
        echo "<a href='#' class='btn btn-primary justify-content-center disabled viewProduct'>Add to Cart</a>";
        echo "<p class='noStock'> Product is currently out of stock!</p>";
    }
    else{
        echo "<a href='#' class='btn btn-primary justify-content-center viewProduct'>Add to Cart</a>";
    }
    echo "</div>";

    echo "</div>";

    echo "</div>";
    echo "</div>";
}
$conn->close();
include("footer.php");
?>