<!--Done by: Vin Hee-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include Bootstrap CSS and JS files -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/624113c1c9.js" crossorigin="anonymous"></script>
    <title>GiftMaven</title>
</head>

<?php
session_start();
$Content = "<div class='d-flex align-items-center px-3' style='font-size: 20px;'>
<p style='margin-bottom: 0px;'><b>Guest</b></p>
</div>
<div id='sign-up' class='d-flex align-items-center px-3' style='font-size: 22px;'>
<a class='nav-link active' href='login.php' style='color:black;'><i class='fa-solid fa-user'></i></a>
</div>";
if(isset($_SESSION["Name"])){
  $Content = "<div class='d-flex align-items-center px-3' style='font-size: 20px;'>
  <p style='margin-bottom: 0px;'><b>$_SESSION[Name]</b></p>
  </div>
  <div class='d-flex align-items-center px-3' style='font-size: 22px;'>
  <a class='nav-link active' href='#' style='color:black;'><i class='fa-solid fa-cart-shopping'></i></a>
  </div>
  <div class='d-flex align-items-center px-3' style='font-size: 20px;'>
  <a class='nav-link active' href='logout.php'><p style='margin-bottom: 0px;'><b>Logout</b></p></a>
  </div>";
}
?>

<nav class="navbar navbar-expand navbar-light" style="background-color: #C7B7A3">
  <a class="navbar-brand" href="index.php"><img src="Images/GiftMaven. logo.png" height="100px";></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php" style="font-size: 18px;">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="productCat.php" style="font-size: 18px;">Categories<span class="sr-only"></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="Search.php" style="font-size: 18px;">Search<span class="sr-only"></span></a>
      </li>
    </ul>
  </div>

  <?php
  echo $Content;
  ?>
  
</nav>