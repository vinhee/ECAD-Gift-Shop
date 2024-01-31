<?php

$email = $_POST['userEmail'];
$password = $_POST['userPassword'];
$name = $_POST['userName'];
$address = $_POST['userAddress'];
$country = $_POST['country'];
$phoneNumber = $_POST['phoneNumber'];

$successReg = false;

include_once("mysqlConn.php");

$qry = "INSERT INTO Shopper (Name, Address, Country, Phone, Email, Password)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($qry);
$stmt->bind_param("ssssss", $name, $address, $country, $phoneNumber, $email, $password);

if($stmt->execute()) {
    $qry = "SELECT LAST_INSERT_ID() AS ShopperID";
    $result = $conn->query($qry);
    while ($row = $result->fetch_array()){
        $_SESSION["ShopperID"] = $row["ShopperID"];
    }

    $successReg = true;
    $_SESSION["ShopperName"] = $name;
}
else {
    $successReg = false;
    $Message = "<h3 style='color:red'>Error in inserting record</h3>";
}

$stmt->close();

$conn->close();

include("navbar.php");

if($successReg){
    echo "<h3 style='text-align: center; padding-top: 200px;'>Registered Succesfully!</h3>";
    echo "<h3 style='text-align: center; padding-bottom: 200px;'>Your Shopper ID is $_SESSION[ShopperID]</h3>";
}

else{
    echo "<h3 style='color:red; text-align: center; padding-bottom: 200px; padding-top: 200px;'>Error in registering, please try again.</h3>";
}

include("footer.php");

?>