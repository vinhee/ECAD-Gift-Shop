<!--Done by Vin Hee-->
<?php
include("navbar.php")
?>

<div class="row justify-content-center" style="padding-top: 100px; padding-bottom: 75px;">
    <form class="form-inline my-2 my-lg-0" action="searchProducts.php">
        <div class="input-group" style="width: 400px;">
            <input class="form-control mr-sm-2" type="search" name="searchProduct" id="searchProduct" placeholder="What product would you like to search?" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit" style="background-color:#C7B7A3;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>
        </div>
    </form>
</div>

<?php
include("mysqlConn.php");
$keyword = $_GET["searchProduct"];
$qry = "SELECT * FROM product WHERE ProductTitle LIKE '%$keyword%' OR ProductDesc LIKE '%$keyword%'";
    $result = mysqli_query($conn,$qry);
    $queryresult = mysqli_num_rows($result);

    if($queryresult > 0){
        while($row = mysqli_fetch_assoc($result)){
        echo "<div class='card' style='width: 60rem; margin: 0 auto;'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>".$row['ProductTitle']."</h5>";
        $formattedPrice = number_format($row["Price"],2);
        echo "<p>"."Price: S$".$formattedPrice."</p>";
        echo "<a href='productDesc.php?pid=".$row['ProductID']."' class='btn btn-primary' style='background-color: #C7B7A3;'>View Product</a>";
        echo "</div>";
        echo "</div>";
        echo "<br>";
        echo "<br>";
        }
    }
    else{
        echo "There are no results matching your search";
    }
$conn->close();
include("footer.php");
?>

<?php
if (isset($_GET["keywords"]) && trim($_GET['keywords']) != "") {
    $keyword = $_GET["searchProduct"];
    $searchProduct = "searchProducts.php?keyword=$keyword";
}
?>


