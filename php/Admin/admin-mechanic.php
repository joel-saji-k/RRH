<?php
session_start(); 
?>
<?php
if(isset($_POST['approve']))
{
  $sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create the database connection
    $con = mysqli_connect($sname, $uid, $pwd, $db);
  $license_id=$_POST['license_id'];
  $q="SELECT * FROM mechanic_reg_request where license=$license_id";
  $result=$con->query($q);
  if($result->num_rows == 0){
    echo "<script>window.onload = function() { showPopup('Connection failed'); };</script>";
  }
  else{
  while ($row = $result->fetch_assoc()) {
    $l=$row['license'];
    $n=$row['name'];
    $e=$row['email'];
    $pass=$row['password'];
    $lat=$row['latitude'];
    $lon=$row['longitude'];
    $typ=$row['type'];
    $place=$row['place'];
  }
    $q2="SELECT email FROM mechanic_reg WHERE email='$e'";
    $result2=$con->query($q2);
    if($result2->num_rows > 0){
      echo "<script>window.onload = function() { showPopup('Already approved '); };</script>";
    }
    else{
    $q1="INSERT INTO mechanic_reg values($l,'$n','$e','$pass','$lat','$lon','$typ','active','$place')";
    $result=$con->query($q1);
    echo "<script>window.onload = function() { showPopup('Approved'); };</script>";
    $q2="DELETE FROM mechanic_reg_request WHERE license = $l";
    $result2=$con->query($q2);

  }
  }
  }

if(isset($_POST['reject']))
{
  $sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create the database connection
    $con = mysqli_connect($sname, $uid, $pwd, $db);
    $license_id=$_POST['license_id'];
  $q="SELECT * FROM mechanic_reg_request where license=$license_id";
  $result=$con->query($q);
  if($result->num_rows == 0){
    echo "<script>window.onload = function() { showPopup('Connection failed'); };</script>";
  }
  else{
  while ($row = $result->fetch_assoc()) {
    $l=$row['license'];
    $n=$row['name'];
    $e=$row['email'];
    $lat=$row['latitude'];
    $lon=$row['longitude'];
    $typ=$row['type'];
  }}
  $q1="INSERT INTO mechanic_reject values($l,'$n','$e','$lat','$lon','$typ')";
    $result2=$con->query($q1);
  $q="DELETE FROM mechanic_reg_request where license=$license_id";
  $result=$con->query($q);
    if($result){
      echo "<script>window.onload = function() { showPopup('Rejected'); };</script>";
    }
  else{
    echo "<script>window.onload = function() { showPopup('Rejection failed'); };</script>";
  }
  }
?>
<style>
        .popup {
            display: none;
            position: absolute;
            left: 55%;
            top: 15%;
            color: #ffff;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #0000FF;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            border-radius: 20px;
            z-index: 1000;
        }
        .popup.active {
            display: block;
        }
    </style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../assets/img/img/favicon.png" rel="icon">
  <link href="../../assets/img/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../assets/assets2/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="../../assets/assets2/assets/css/style.css" rel="stylesheet">
  <link href="../../assets/assets2/assets/css/page-main.css" rel="stylesheet">

<?php

if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];

    // Database connection details
    $sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create the database connection
    $con = mysqli_connect($sname, $uid, $pwd, $db);

    // Check the database connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // Query to fetch the name based on email and password
        $q = "SELECT name FROM usr_reg WHERE email='$email' AND password='$password'";
        $result = $con->query($q);

        // Check if the query returned a result
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $_SESSION["name"] = $name;

        }
    }

    // Close the database connection
    $con->close();
}
?>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="admin-index.php" class="logo d-flex align-items-center">
        <img src="../../assets/img/img/logo.png" alt="">
        <span class="d-none d-lg-block">Road Side Rescue &emsp;Hub</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <span class="d-none d-md-block dropdown-toggle ps-2">ADMIN</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>ADMIN</h6>
              <span>admin</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="admin-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <span>Dashboard</span></li>
        <li><a class="nav-link collapsed" href="admin-index.php">
          <i class="bi bi-truck"></i>
          <span>Fuel Service</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li><a class="nav-link " href="admin-mechanic.php">
          <i class="bi bi-truck"></i>
          <span>Mechanic Service</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="admin-history.php">
          <i class="bi bi-question-circle"></i>
          <span>History</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
          <li class="breadcrumb-item active">Mechanic service</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
          <div id="popup" class="popup"></div>
  <table class="table table-bordered table-dark">
  <thead>
    <tr>
      <th scope="col">Slno</th>
      <th scope="col">License</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Latitude</th>
      <th scope="col">Longitude</th>
      <th scope="col">Type of Vehicle</th>
      <th colspan="2" scope="col">Approve/Reject</th>
    </tr>
  </thead>
  <tbody>
    <?php
$sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";
 $con=mysqli_connect("$sname","$uid","$pwd","$db");
 if($con){
 $q="select * from mechanic_reg_request";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['license']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><td>{$row['type']}</td><td><form action='' method='POST'><input type='hidden' name='license_id' value='{$row['license']}'><button type='submit' class='btn btn-primary' name='approve'>Approve</button></td><td><button type='submit' class='btn btn-primary' name='reject'>Reject</button></form></td></tr> ";
}}
?>
  </tbody>
</table>





  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer" style="padding-top: 20%">
    <div class="copyright">
      &copy; Copyright <strong><span>Rahul VR</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https">Rahul & Joel</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../assets/assets2/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/assets2/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/quill/quill.js"></script>
  <script src="../../assets/assets2/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/assets2/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3MPnSnyWwNmpnVEFkaddVvy_GWtxSejs"></script>
  <script src="../../assets/assets2/assets/js/main.js"></script>
  <script type="text/javascript">
    document.getElementById('showFormBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevents the default action of the link
    const container = document.getElementById('container3');
    const container2 = document.getElementById('container2');
    if (container.style.display === 'none') {
        container.style.display = 'block';
    } 
    container2.style.display = 'none';
});
    document.getElementById('showFormBtn2').addEventListener('click', function(event) {
    event.preventDefault(); // Prevents the default action of the link
    const container = document.getElementById('container4');
    const container2 = document.getElementById('container2');
    if (container.style.display === 'none') {
        container.style.display = 'block';
    }
    container2.style.display = 'none';
});
function getLocation(latInputId, lonInputId, mapId) {
    // Default coordinates (in case geolocation is not available)
    var defaultLatLng = { lat: 9.9763482, lng: 76.286272 };

    // Initialize map with default coordinates
    var mapOptions = {
        center: new google.maps.LatLng(defaultLatLng.lat, defaultLatLng.lng),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var map = new google.maps.Map(document.getElementById(mapId), mapOptions);

    // Geolocation API: Try to get user's current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var userLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Update the latitude and longitude input fields
            document.getElementById(latInputId).value = userLatLng.lat;
            document.getElementById(lonInputId).value = userLatLng.lng;

        }, function () {
            alert("Geolocation is not supported by this browser, or the user denied access.");
        });
    }

    // Add click listener on the map to update latitude and longitude fields
    google.maps.event.addListener(map, 'click', function (e) {
        var clickedLatLng = e.latLng;
        document.getElementById(latInputId).value = e.latLng.lat();
        document.getElementById(lonInputId).value = e.latLng.lng();

        alert("Latitude: " + clickedLatLng.lat() + "\r\nLongitude: " + clickedLatLng.lng());
    });
}
        function showPopup(message) {
            console.log("showPopup called with message:", message); // Debugging line
            var popup = document.getElementById('popup');
            if (popup) {
                popup.innerText = message;
                popup.classList.add('active');
                setTimeout(closePopup, 2000); // Close popup after 2 seconds
            } else {
                console.error("Popup element not found");
            }
        }
        function closePopup() {
            var popup = document.getElementById('popup');
            if (popup) {
                popup.classList.remove('active');
            }
        }
  </script>

</body>

</html>