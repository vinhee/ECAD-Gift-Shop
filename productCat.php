<!--Done by: Vin Hee-->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
include("navbar.php")
?>

<div style="margin:auto;">
<div class='container text-center' style='padding-top:20px;'>
    <div class='col-md-12 justify-content-center'>
        <h2>Product Category</h2>
        <h4>Choose a category to check out the products offered!</h4>
    </div>
</div>

<?php
include("mysqlConn.php");
$qry = "SELECT * FROM Category ORDER BY CatName ASC";
$result = $conn->query($qry);

echo "<div class='container text-center' style='padding-top:100px; padding-bottom:100px;'>";
echo "<div class='row justify-content-center'>";
while($row = $result->fetch_array()) {
    echo"<div class='col-md-4'>";
    $img = "./Images/category/$row[CatImage]";
    $catname = urlencode($row["CatName"]);
    $catproduct = "products.php?cid=$row[CategoryID]&catName=$catname";
    echo "<a href=$catproduct style='text-decoration: none;'>";
    echo "<img src='$img' />";
    echo "<p class='catName'>$row[CatName]</p>";
    echo "</a>";
    echo "<div class='col-md-12 text-center'>";
    echo "$row[CatDesc]";
    echo "</div>";

    echo "</div>";
}
echo "</div>";
echo "</div>";

$conn->close();
include("footer.php");
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>