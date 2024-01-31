<!--Done by Vin Hee-->
<head>
    <script src="https://kit.fontawesome.com/624113c1c9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<?php
include("navbar.php");

?>
<script type="text/javascript">
function validateInfo(){
  if (document.register.userPassword.value != document.register.password2.value) {
    alert("Passwords do not match!");
    return false; // Password won't be submitted
  }
  if (document.register.phone.value != "") {
        var str = document.register.phone.value;
        if(str.length != 8) {
            alert("Please enter a 8-digit phone number.");
            return false;
        }
        else if (str.substr(0,1) != "6" &&
                 str.substr(0,1) != "8" &&
                 str.substr(0,1) != "9") {
                    alert("Phone number in Singapore should start with 6, 8 or 9.");
                    return false;
                 }
            }
            return true;
}
</script>

<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-6 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
          <div class="card-img-left d-none d-md-flex">
          </div>
          <div class="card-body p-4 p-sm-5">
            <h3 class="login-heading mb-4 text-center">Register</h3>
            <form name="register" action="addMember.php" method="post" 
      onsubmit="return validateForm()">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="userName" placeholder="Name" name="userName" required autofocus>
                <label for="Name">Name</label>
              </div>

              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="userEmail" placeholder="name@example.com" name="userEmail" required >
                <label for="userName">Email address</label>
              </div>
              
              <div class="form-floating mb-3">
                <input type="Address" class="form-control" id="userAddress" placeholder="Address" name="userAddress">
                <label for="userAddress">Address</label>
              </div>

              <div class="form-floating mb-3">
                <input type="country" class="form-control" id="country" placeholder="Country" name="country">
                <label for="country">Country</label>
              </div>

              <div class="form-floating mb-3">
                <input type="phoneNumber" class="form-control" id="phoneNumber" placeholder="Phone Number" name="phoneNumber">
                <label for="phoneNumber">Phone Number</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="userPassword" placeholder="Password" name="userPassword" required> 
                <label for="password">Password</label>
              </div>

              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password2" placeholder="Confirm Password" required>
                <label for="password2">Confirm Password</label>
              </div>

              <div class="d-grid mb-2">
                <button class="btn btn-lg btn-primary btn-login fw-bold login-btn" style="background-color: #352F44; color: white;" type="submit">REGISTER</button>
              </div>

              <a class="d-block text-center mt-2 small" href="login.php">Have an account? Log in here!</a>

              <hr class="my-4">

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

<?php
include("footer.php");
?>