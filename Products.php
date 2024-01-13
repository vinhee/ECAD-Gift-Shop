<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS and JS files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Souvenir:Products</title>
</head>

<?php
include("navbar.php")
?>

<body>
<div class="container text-center" style="padding-top:50px;">
<h2>Gifts</h2>
</div>

<div class="container" style="padding-top:20px;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
            <img src="Images/Products/Blissful_Bundle.jpg" class="card-img-top" alt="blissfulbundle">
                <div class="card-body">
                    <h5 class="card-title">Blissful Bundle</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
            <img src="Images/Products/Deluxe_Diaper_Cake_Girl.jpg" class="card-img-top" alt="deluxediapercakegirl">
                <div class="card-body">
                    <h5 class="card-title">Deluxe Diaper Girl Cake</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
            <img src="Images/Products/Springtime_Bloom.jpg" class="card-img-top" alt="springtimebloom">
                <div class="card-body">
                    <h5 class="card-title">Springtime Bloom</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">View Product</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<?php
include("footer.php")
?>

</html>