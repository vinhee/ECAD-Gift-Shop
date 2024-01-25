<!--Done by: Vin Hee-->
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
    echo "<a href=$catproduct>";
    echo "<img src='$img' />";
    echo "<p>$row[CatName]</p>";
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