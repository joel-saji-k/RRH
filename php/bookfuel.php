<?php
session_start();
$sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create the database connection
    $con = mysqli_connect($sname, $uid, $pwd, $db); // Include your database connection

if (isset($_POST['submit'])) {
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $fuel=$_POST['fuel'];
    $license=$_SESSION['licenseId'];
    $phone=$_POST['phone'];
    $lat=$_POST['lat'];
    $lon=$_POST['lon'];
    $quantity=$_POST['quantity'];
    $amount=$_POST['amount'];
    $current_time = date('Y-m-d H:i:s');
    $_SESSION['license']=$license;
    $_SESSION['email']=$email;
    $_SESSION['time']=$current_time;
    echo $name;
    echo $email;
    echo $fuel;
    echo $license;
    echo $quantity;
    echo $amount;
    $q="INSERT INTO fuelbook values('$name','$email','$fuel',$quantity,$amount,$license,'$current_time','$lat','$lon','$phone','pending')";
    $result=$con->query($q);
    if($result){
      header("Location: payment.html");
exit;
    }
    else{
      echo "Booking Failed";
      sleep(5);
      header("Location: fuel-form.php");
exit;
    }
}
?>
