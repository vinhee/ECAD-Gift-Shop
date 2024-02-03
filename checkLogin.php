<?php
include("navbar.php");
?>
<?php
include_once("mysqlConn.php");
$userEmail = $_POST["userEmail"]; // Get user input
$userPassword = $_POST["userPassword"];

$stmt = $conn->prepare("SELECT * FROM Shopper WHERE Email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $validUser = false;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($userPassword == $row["Password"]) {
            $validUser = true;
            session_start();
            $_SESSION["Name"] = $row["Name"];
            $_SESSION["shopperID"] = $row["ShopperID"];
            header("Location: index.php");
            exit;
        }
    }

if(!$validUser){
    echo "<h4 class='noStock'>Invalid Email or Password!</h4>";
    echo "<h5>Please try again.</h5>";
    echo "<a href='signin.php'><button class='btn btn-primary' style='background-color: #C7B7A3;'>Try Again</button></a>";
}
$conn->close();
include("footer.php");
?>