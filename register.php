<head>
    <script src="https://kit.fontawesome.com/624113c1c9.js" crossorigin="anonymous"></script>
</head>

<?php
include("navbar.php");
?>

<div class="container text-center" style="margin:auto; padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-2">
            <a href="signin.php"><button class="btn btn-primary btn-block" style="background-color: #C7B7A3;">Sign In</button></a>
        </div>
        <div class="col-md-5 mb-2">
            <a href="register.php"><button class="btn btn-primary btn-block" style="background-color: white; color: black;">Register</button></a>
        </div>
    </div>
</div>

<form style="width: 925px; margin: auto; padding-top: 20px; padding-bottom: 100px;">
  <div class="form-group">
    <label for="email"><i class="fa-solid fa-envelope"></i>  Email address</label>
    <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="password"><i class="fa-solid fa-lock"></i>  Password</label>
    <input type="password" class="form-control" id="userPassword" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="repeatPassword"><i class="fa-solid fa-lock"></i>  Retype Password</label>
    <input type="password" class="form-control" id="userPassword2" placeholder="Retype Password">
  </div>
  <button type="submit" class="btn btn-primary" style="background-color: #C7B7A3; width:925px;">Register</button>
</form>

<?php
include("footer.php");
?>