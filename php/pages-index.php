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
<script>
        function storeType() {
    var type = document.getElementById("type").value; // Get the selected value
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_Vtype.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Handle the response from the server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Handle the response if needed
        }
    };
    xhr.send("type=" + encodeURIComponent(type));
    //callPHPFunction();
  }
  function saveFormData() {
        const formElements = document.querySelectorAll("input, select, textarea"); // Select all form fields
        formElements.forEach((element) => {
            if (element.type !== "button" && element.type !== "submit" && element.id !== "fuel" && element.id !== "brand") {
                localStorage.setItem(element.id, element.value); // Save each field value with its ID as the key
            }
                  });
    }
    function restoreFormData() {
        const formElements = document.querySelectorAll("input, select, textarea"); // Select all form fields
        formElements.forEach((element) => {
            if (localStorage.getItem(element.id)) {
                element.value = localStorage.getItem(element.id); // Set each field with the saved value
            }
        });
    }
    function callPHPFunction() {
    const brand = document.getElementById("brand").value;
    const fuel = document.getElementById("fuel").value;

    // Redirect to the PHP script with parameters
    window.location.href = `pages-index.php?brand=${encodeURIComponent(brand)}&fuel=${encodeURIComponent(fuel)}`;
    //calculateDistances();
}

    // Save form data when any input changes
    document.addEventListener("DOMContentLoaded", function () {
        restoreFormData(); // Restore form data when page loads
        const formElements = document.querySelectorAll("input, select, textarea");
        formElements.forEach((element) => {
            element.addEventListener("input", saveFormData); // Save data on each input change
        });
    });

    // Optional: Clear data on form submission
    document.querySelector("form").addEventListener("submit", function () {
        localStorage.clear(); // Clear localStorage data when the form is submitted
    });
        function haversineDistance(lat3,lon3) {
          const lat2=lat3;
          const lon2=lon3;
          var lat1 = document.getElementById("lat").value;
            var lon1 = parseFloat(document.getElementById("lon").value);
          //console.log("latitude of user: "+lat1)
          //console.log("logitude of user: "+lon1)
          //console.log("latitude of pump: "+lat2)
          //console.log("longitude of pump: "+lon2)
    const R = 6371; // Radius of the Earth in kilometers
    const toRadians = angle => angle * (Math.PI / 180);

    const dLat = toRadians(lat2 - lat1);
    const dLon = toRadians(lon2 - lon1);

    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(toRadians(lat1)) * Math.cos(toRadians(lat2)) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

    var dis= R * c; // Distance in kilometers
    return dis;
    //var x=0;
    //console.log(dis)
    //document.getElementById("dis").textContent = dis.toFixed(2);
}
 function calculateDistances() {
        const distanceCells = document.querySelectorAll('[id^="dis_"]'); // Select all <td> with id starting with "dis_"
         let latInput = document.getElementById("lat").value;
console.log("Raw latitude value: " + latInput);
        distanceCells.forEach(cell => {
            const lat = parseFloat(cell.getAttribute('data-lat')); // Get latitude from data attribute
            const lon = parseFloat(cell.getAttribute('data-lon')); // Get longitude from data attribute
            
            cell.textContent = haversineDistance(lat, lon); // Call function and set cell content
        });
    }
</script>
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

<?php
if(isset($_POST['fuelbook'])){

  $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";
$con=mysqli_connect("$sname","$uid","$pwd","$db");
if($con){
  $name=$_POST['name'];
  $e=$_POST['email'];
  $lat=$_POST['lat'];
  $lon=$_POST['lon'];
  $fuel=$_POST['fuel'];
  $amount=$_POST['amount'];
}
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
        <form class="row g-4" action="" method="POST">
            <div class="col-md-6">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter your name" title="Please enter your full name">
            </div>
            <div class="col-md-6">
                <label for="inputEmail1" class="form-label">Email</label>
                <input class="form-control" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" aria-label="Email" id="inputEmail1" readonly title="Email address">
            </div>
            <div class="col-4">
                <label for="lat" class="form-label">Latitude</label>
                <input type="text" name="lat" class="form-control" id="lat" placeholder="Latitude" title="Latitude coordinates">
            </div>
            <div class="col-4">
                <label for="lon" class="form-label">Longitude</label>
                <input type="text" name="lon" class="form-control" id="lon" placeholder="Longitude" title="Longitude coordinates">
            </div>
            <div class="col-md-2"><br>
                <button type="button" class="btn btn-primary" onclick="getLocation('lat','lon','dvMapFuel');" style="margin-top: 7px;">Get Location</button>
            </div>
            <div class="col-md-3">
                <label for="fuel" class="form-label">Fuel</label>
                <select id="fuel" name="fuel" class="form-select" title="Select fuel type">
                    <option selected>Choose...</option>
                    <option value="petrol">Petrol</option>
                    <option value="diesel">Diesel</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="brand" class="form-label">Brand</label>
                <select id="brand" name="brand" class="form-select" title="Select fuel type" onchange="fetchPrice()" required>
                    <option selected>Choose...</option>
                    <option value="Indian oil">Indian oil</option>
                    <option value="HP">HP</option>
                    <option value="BP">Bharat petroleum</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" name="search_pump" class="btn btn-primary" onclick="calculateDistances();">Search Pumps</button>
            </div>
            <div class="col-md-3">
                <button type="submit" name="fuelbook" class="btn btn-primary" >Payment</button>
            </div>
            <div class="col-md-2">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Liters" title="liters" oninput="calculateAmount()" required>
            </div>
            <div class="col-md-2">
                <label for="amount" class="form-label">Amount</label>
                <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter fuel amount" title="Amount in liters" oninput="calculateQuantity()">
            </div>
            <div id="dvMapFuel" style="width: 350px; height: 320px; position: relative"></div>
            
        </form>
        <div class="table-responsive" style="display: flex;">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">Brand</th>
<th scope="col">Place</th>
<th scope="col">Petrol Rate (1ltr)</th>
<th scope="col">Desel Rate (1ltr)</th>
<th scope="col">Distance</th>
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
 $q="select * from pump_reg";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['Brand']}</td><td>{$row['place']}</td><td>{$row['P_amount']}</td><td>{$row['D_amount']}</td><td id='dis_$x' data-lat='{$row['latitude']}' data-lon='{$row['longitude']}'></td></tr> ";
}}
?>
</tbody>
</table>
</div>
    </div>
</div>

    <!-- fuel booking form end  -->
    <!-- mechanic booking -->
<div class="col-lg-12 order-1 order-lg-2 container4" id="container4" style="display: none;">
    <div class="form-container sign-up-container">
      <br>   
      <h1><b><u>Mechanic Assistance</u></b></h1><br>
    <form class="row g-4" method="POST" action="mechanic-book.php">
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
    <select class="form-select" title="Select fuel type" id="type" onchange="storeType()" required>
      <option selected>Choose...</option>
      <option value="motorcycle">Motercycle</option>
      <option value="car">Car</option>
    </select>
  </div>
  <div class="col-md-4">
    <label for="Issue" class="form-label">Issue</label>
    <input type="text" class="form-control" id="Issue">
  </div>
  <div class="col-12">
    <button type="button" class="btn btn-primary" onclick="callPHPFunction()" onmouseleave="calculateDistances();">Show mechanics</button>
  </div>
  <div id="dvMapMechanic" style="width: 350px; height: 320px; position: relative; padding-top: 10px"></div>
  <div class="table-responsive" style="display: flex;">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">Name</th>
<th scope="col">Place</th>
<th scope="col">Distance</th>
<th scope="col">Select</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";
 $con=mysqli_connect("$sname","$uid","$pwd","$db");
 if($con){
 $q="select * from mechanic_reg where type='$type' OR type='ALL'";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['name']}</td><td>{$row['place']}</td><td id='dis_$x' data-lat='{$row['latitude']}' data-lon='{$row['longitude']}'></td><td><input type='hidden' name='license_id' id='license_id_$x' value='{$row['licence']}'><button type='button' class='btn btn-primary' onclick='toggleForm({$row['licence']})' name='button'>Select</button></td></tr> ";
}}}
?>
</tbody>
</table></div>
</form>
</div></div>
    <!-- mechanic booking end  -->

   <section id="featured-services" class="featured-services section">

      <div class="container2" id="container2" style="display: block;" >

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 c-container" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-fuel-pump-fill icon"></i></div>
              <h4><a href="fuel-form.php" id="showFormBtn1" class="stretched-link">Fuel Delevery</a></h4>
              <p>Fuel delivery services bring fuel directly to your location, eliminating the need to visit a fuel station</p>
            </div>
          </div>
          <div class="col-xl-3 col-md-6 c-container" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-tools icon"></i></div>
              <h4><a href="mechanic-form.php" id="showFormBtn5" class="stretched-link">Mobile Workshop</a></h4>
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