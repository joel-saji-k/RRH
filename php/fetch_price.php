<?php
session_start();
$sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create the database connection
    $con = mysqli_connect($sname, $uid, $pwd, $db); // Include your database connection

if (isset($_GET['brand'])) {
    $brand = $_GET['brand'];
    $fuel =$_GET['fuel'];
    $licenseId =$_GET['licenseId'];
    $_SESSION['licenseId']=$licenseId;
    if($fuel=='petrol'){
    // Prepare statement to prevent SQL injection
    $stmt = $con->prepare("SELECT P_amount FROM pump_reg WHERE licence = ?");
    $stmt->bind_param("s", $licenseId);
    $stmt->execute();
    $stmt->bind_result($price);
    }
    else{
        $stmt = $con->prepare("SELECT D_amount FROM pump_reg WHERE licence = ?");
    $stmt->bind_param("s", $licenseId);
    $stmt->execute();
    $stmt->bind_result($price);
    }
    if ($stmt->fetch()) {
        echo $price; // Return the price to the Ajax call
    } else {
        echo 0; // Return 0 if brand not found
    }

    $stmt->close();
}
?>
