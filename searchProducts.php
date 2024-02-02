<!--Done by Vin Hee-->
<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
include("navbar.php")
?>

<div class="container">
    <div class="row mx-auto searchBar">
        <!-- Search bar -->
        <form class="form-inline my-2 my-lg-0" action="searchProducts.php">
            <div class="input-group">
                <input class="form-control mr-sm-2" type="search" name="searchProduct" id="searchProduct" placeholder="What product would you like to search?" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" style="background-color:#C7B7A3; height:50px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end priceRange2">
                    <div class="form-floating mb-3" style="width: 250px;">
                        <input class="form-control" id="minPrice" placeholder="0" name="minPrice">
                        <label for="minPrice">Min:</label>
                    </div>
                </div>
                <div class="col priceRange2">
                    <div class="form-floating mb-3" style="width: 250px;">
                        <input class="form-control" id="maxPrice" placeholder="200" name="maxPrice">
                        <label for="maxPrice">Max:</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("mysqlConn.php");

if(isset($_GET["searchProduct"]) && isset($_GET["minPrice"]) && isset($_GET["maxPrice"])) { 
    $currDate = date('Y-m-d');
    $whereClause = '';

    $searchProduct = $_GET["searchProduct"];
    $minPrice = $_GET["minPrice"];
    $maxPrice = $_GET["maxPrice"];

    $whereClause .= "(ProductTitle LIKE '%$searchProduct%' OR productDesc LIKE '%$searchProduct%' OR SpecVal LIKE '%$searchProduct%') ";
    $whereClause .= "AND (Price BETWEEN $minPrice AND $maxPrice) OR ((OfferedPrice BETWEEN $minPrice AND $maxPrice) AND ($currDate BETWEEN OfferStartDate AND OfferEndDate))";

    $qry = "SELECT DISTINCT p.ProductTitle, p.Price, p.ProductID FROM product p
        INNER JOIN catproduct cp ON p.ProductID = cp.ProductID
        INNER JOIN category c ON cp.CategoryID = c.CategoryID
        INNER JOIN productspec ps ON p.ProductID = ps.ProductID
        WHERE $whereClause ORDER BY ProductTitle";
    $result = mysqli_query($conn, $qry);
    $queryresult = mysqli_num_rows($result);

    if($queryresult > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='card' style='width: 60rem; margin: 0 auto;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>".$row['ProductTitle']."</h5>";
            $formattedPrice = number_format($row["Price"],2);
            echo "<p>"."Price: S$".$formattedPrice."</p>";
            echo "<a href='productDesc.php?pid=".$row['ProductID']."' class='btn btn-primary' style='background-color: #352F44; color:white;'>View Product</a>";
            echo "</div>";
            echo "</div>";
            echo "<br>";
            echo "<br>";
        }
    }
    else {
        echo "<h3 style='color:black; text-align: center; padding-top: 50px;'>No results matching your search.</h3>";
    }
}
else {
    echo "<h3 style='color:black; text-align: center; padding-top: 50px;'>Please fill up both price range and search.</h3>";
}

$conn->close();
include("footer.php");
?>

