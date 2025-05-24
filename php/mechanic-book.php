<?php
session_start();
$sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create the database connection
    $con = mysqli_connect($sname, $uid, $pwd, $db); // Include your database connection
    $x=$_SESSION['x'];
for ($i = 1; $i <= $x; $i++) {
if (isset($_POST["button_$i"]))  {
        $license_id = $_POST["license_id_$i"];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $lat = $_POST['lat'];
  $lon = $_POST['lon'];
  $type = $_POST['type'];
  $issue = $_POST['issue'];
  $phone = $_POST['phone'];
      $_SESSION['license']=$license_id;
    $_SESSION['email']=$email;
    $current_time = date('Y-m-d H:i:s');
    $_SESSION['time']=$current_time;
  $q="INSERT INTO mechanicbook values('$current_time','$name','$email','$lat','$lon','$type','$issue',$license_id,$phone,'pending')";
  $result1 = $con->query($q);
  if($result1){
    echo "Booked sucessfull";
    header("Location: booking_success.html");
  }
  else
    echo "Booking failed";
}
}
?>
