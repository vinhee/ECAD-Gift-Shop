<head>
    <script src="https://kit.fontawesome.com/624113c1c9.js" crossorigin="anonymous"></script>
</head>

<?php
include("navbar.php");
?>

<div class="container text-center" style="margin:auto; padding-top: 100px;">
    <div class="row justify-content-center">
        <div class="col-md-5 mb-2">
            <a href="signin.php"><button class="btn btn-primary btn-block" style="background-color: white; color: black;">Sign In</button></a>
        </div>
        <div class="col-md-5 mb-2">
            <a href="register.php"><button class="btn btn-primary btn-block" style="background-color: #C7B7A3;">Register</button></a>
        </div>
    </div>
</div>

<form style="width: 925px; margin: auto; padding-top: 20px; padding-bottom: 100px;">
  <div class="form-group">
    <label for="exampleInputEmail1"><i class="fa-solid fa-envelope"></i>  Email address</label>
    <input type="email" class="form-control" id="userEmail" aria-describedby="emailHelp" placeholder="Enter email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"><i class="fa-solid fa-lock"></i>  Password</label>
    <input type="password" class="form-control" id="userPassword" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary" style="background-color: #C7B7A3; width:925px;">Sign In</button>
</form>

<?php
include("footer.php");
?>