<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/img/favicon.png" rel="icon">
  <link href="../assets/img/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/assets2/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/assets2/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/assets2/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/assets2/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/assets2/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/assets2/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/assets2/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  

  <!-- Template Main CSS File -->
  <link href="../assets/assets2/assets/css/style.css" rel="stylesheet">
  <link href="../assets/assets2/assets/css/page-main.css" rel="stylesheet">

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
      <a href="pages-index.php" class="logo d-flex align-items-center">
        <img src="../assets/img/img/logo.png" alt="">
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
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo htmlspecialchars($name); ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo htmlspecialchars($name); ?></h6>
              <span>User</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-contact.php">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
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
        <li><a class="nav-link " href="pages-index.php">
          <i class="bi bi-truck"></i>
          <span>Services</span>
        </a>
      </li><!-- End Dashboard Nav -->

      
      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-history.php">
          <i class="bi bi-question-circle"></i>
          <span>History</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="pages-index.php">Home</a></li>
          <li class="breadcrumb-item active">Services</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <!-- fuel booking form -->
  <div class="col-lg-12 order-1 order-lg-2 container3" id="container3" style="display: none;">
    <div class="form-container sign-up-container">
        <br>
        <h1><b><u>Fuel Booking</u></b></h1><br>
        <form class="row g-4">
            <div class="col-md-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName" placeholder="Enter your name" title="Please enter your full name">
            </div>
            <div class="col-md-6">
                <label for="inputEmail1" class="form-label">Email</label>
                <input class="form-control" type="email" value="<?php echo htmlspecialchars($email); ?>" aria-label="Email" id="inputEmail1" readonly title="Email address">
            </div>
            <div class="col-4">
                <label for="lat" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="lat" placeholder="Latitude" title="Latitude coordinates">
            </div>
            <div class="col-4">
                <label for="lon" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="lon" placeholder="Longitude" title="Longitude coordinates">
            </div>
            <div class="col-md-2"><br>
                <button type="button" class="btn btn-primary" onclick="getLocation('lat','lon','dvMapFuel');" style="margin-top: 7px;">Get Location</button>
            </div>
            <div class="col-md-4">
                <label for="fuel" class="form-label">Fuel</label>
                <select id="fuel" class="form-select" title="Select fuel type">
                    <option selected>Choose...</option>
                    <option>Petrol</option>
                    <option>Diesel</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="Amount" class="form-label">Amount</label>
                <input type="text" class="form-control" id="Amount" placeholder="Enter fuel amount" title="Amount in liters">
            </div><div>
                <button type="submit" class="btn btn-primary" >Payment</button>
            </div>
            <div id="dvMapFuel" style="width: 350px; height: 320px; position: relative"></div>
            
        </form>
    </div>
</div>

    <!-- fuel booking form end  -->
    <!-- mechanic booking -->
<div class="col-lg-12 order-1 order-lg-2 container4" id="container4" style="display: none;">
    <div class="form-container sign-up-container">
      <br>   
      <h1><b><u>Mechanic Assistance</u></b></h1><br>
    <form class="row g-4">
  <div class="col-md-6">
    <label for="inputName2" class="form-label">Name</label>
    <input type="text" class="form-control" id="inputName2">
  </div>
  <div class="col-md-6">
    <label for="inputEmail2" class="form-label">Email</label>
    <input class="form-control" type="email" value="<?php echo htmlspecialchars($email); ?>" aria-label="" id="inputEmail2" readonly>
  </div>
  <div class="col-4">
    <label for="lat2" class="form-label">Latitude</label>
    <input type="text" class="form-control" id="lat2">
  </div>
  <div class="col-4">
    <label for="lon2" class="form-label">Logitude</label>
    <input type="text" class="form-control" id="lon2">
  </div>
  <div class="col-md-2"><br>
    <button type="button" class="btn btn-primary" onclick="getLocation('lat2','lon2','dvMapMechanic');";" style="margin-top: 7px;">Get Location</button>
  </div>
  <div class="col-md-4">
    <label for="type" class="form-label">Type of vehicle</label>
    <select class="form-select" title="Select fuel type" id="type">
      <option selected>Choose...</option>
      <option>Motercycle</option>
      <option>Car</option>
    </select>
  </div>
  <div class="col-md-4">
    <label for="Issue" class="form-label">Issue</label>
    <input type="text" class="form-control" id="Issue">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Payment</button>
  </div>
  <div id="dvMapMechanic" style="width: 350px; height: 320px; position: relative; padding-top: 10px"></div>
</form>
</div></div>
    <!-- mechanic booking end  -->

   <section id="featured-services" class="featured-services section">

      <div class="container2" id="container2" style="display: block;" >

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 c-container" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-fuel-pump-fill icon"></i></div>
              <h4><a href="#" id="showFormBtn" class="stretched-link">Fuel Delevery</a></h4>
              <p>Fuel delivery services bring fuel directly to your location, eliminating the need to visit a fuel station</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 c-container" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-tools icon"></i></div>
              <h4><a href="" id="showFormBtn2" class="stretched-link">Mobile Workshop</a></h4>
              <p>Mobile workshop services provide on-site repair and maintenance solutions, bringing the workshop directly to the customer’s location</p>
            </div>
          </div>
          </div><!-- End Service Item -->
        </div>
    </section>




  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Rahul VR</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https">Rahul & Joel</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/assets2/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/assets2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/assets2/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/assets2/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/assets2/assets/vendor/quill/quill.js"></script>
  <script src="../assets/assets2/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/assets2/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/assets2/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3MPnSnyWwNmpnVEFkaddVvy_GWtxSejs"></script>
  <script src="../assets/assets2/assets/js/main.js"></script>
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
  </script>

</body>

</html>