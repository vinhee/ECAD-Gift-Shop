<!--Done by Vin Hee-->
<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
include("navbar.php");
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
                <div class="col d-flex justify-content-end priceRange">
                    <div class="form-floating mb-3" style="width: 250px;">
                        <input class="form-control" id="minPrice" placeholder="0" name="minPrice">
                        <label for="minPrice">Min:</label>
                    </div>
                </div>
                <div class="col priceRange">
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
if (isset($_GET["searchProduct"]) && trim($_GET['searchProduct']) != "") {
    $keyword = $_GET["searchProduct"];
    $searchProduct = "searchProducts.php?keyword=$keyword";
}
include("footer.php");
?>