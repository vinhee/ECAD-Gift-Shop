<!--Done by Vin Hee-->
<head>
    <script src="https://kit.fontawesome.com/624113c1c9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  </head>

<?php
include("navbar.php");
?>

<div class="container text-center" style="margin:auto; padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-2">
            <a href="login.php"><button class="btn btn-primary btn-block" style="background-color: white; color: black; width: calc(50% - 10px);">Login</button></a>
        </div>
        <div class="col-md-5 mb-2">
            <a href="register.php"><button class="btn btn-primary btn-block" style= "background-color: #C7B7A3; width: calc(50% - 10px);">Register</button></a>
        </div>
    </div>
</div>



<form style="width: 925px; margin: auto; padding-top: 20px; padding-bottom: 100px;" action="checkLogin.php" method="post">
  <div class="form-group loginPage">
    <label for="userEmail"><i class="fa-solid fa-envelope"></i>  Email address</label>
    <input type="email" class="form-control" name="userEmail" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group loginPage">
    <label for="userPassword"><i class="fa-solid fa-lock"></i>  Password</label>
    <input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary" style="background-color: #C7B7A3; width:925px;">Sign In</button>
</form>


<?php
include("footer.php");
?>

