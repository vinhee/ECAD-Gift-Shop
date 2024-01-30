<!--Done by Vin Hee-->
<?php
include("navbar.php");
?>

<!--Fix positioning-->
<div class="row justify-content-center" style="padding-top: 200px; padding-bottom: 200px;">  
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
if (isset($_GET["searchProduct"]) && trim($_GET['searchProduct']) != "") {
    $keyword = $_GET["searchProduct"];
    $searchProduct = "searchProducts.php?keyword=$keyword";
}
include("footer.php");
?>