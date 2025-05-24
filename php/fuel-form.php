<?php
session_start(); 
unset($_SESSION['brand']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="assets/img/img/favicon.png" rel="icon">
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
        function fetchPrice(licenseId) {
            var brand = document.getElementById("brand").value;
            var fuel = document.getElementById('fuel').value;
            console.log("licence is : "+licenseId);
            if (brand) {
                var xhr = new XMLHttpRequest();
                var url = "fetch_price.php?brand=" + encodeURIComponent(brand) + "&fuel=" + encodeURIComponent(fuel) + "&licenseId=" + encodeURIComponent(licenseId);
    xhr.open("GET", url, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var price = parseFloat(xhr.responseText);
                        document.getElementById("amount").dataset.price = price; // Store price in a data attribute
                        calculateAmount(); // Recalculate amount if quantity is already filled
                    }
                };
                xhr.send();
            }
            //haversineDistance();
        }

        function calculateAmount() {
            var price = parseFloat(document.getElementById("amount").dataset.price) || 0; // Get price
            var quantity = parseFloat(document.getElementById("quantity").value) || 0; // Get quantity
            var amount = price * quantity; // Calculate amount
            document.getElementById("amount").value = amount.toFixed(2); // Set amount in the input field
        }

        function calculateQuantity() {
            var price = parseFloat(document.getElementById("amount").dataset.price) || 0; // Get price
            var amount = parseFloat(document.getElementById("amount").value) || 0; // Get amount
            var quantity = amount / price; // Calculate quantity
            document.getElementById("quantity").value = quantity.toFixed(2); // Set quantity in the input field
            //setTimeout(callPHPFunction, 2000);
        }
        function haversineDistance(lat3,lon3) {

          const lat2=lat3;
          const lon2=lon3;
          var lat1 = document.getElementById("lat").value;
            var lon1 = parseFloat(document.getElementById("lon").value);
          console.log("latitude of user: "+lat1)
          console.log("logitude of user: "+lon1)
          console.log("latitude of pump: "+lat2)
          console.log("longitude of pump: "+lon2)
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
         
        distanceCells.forEach(cell => {
            const lat = parseFloat(cell.getAttribute('data-lat')); // Get latitude from data attribute
            const lon = parseFloat(cell.getAttribute('data-lon')); // Get longitude from data attribute
            
            cell.textContent = haversineDistance(lat, lon); // Call function and set cell content
        });
    }
    function storeFuel() {
    var fuel = document.getElementById("fuel").value; // Get the selected value
    var brand = document.getElementById("brand").value;
    // Create an XMLHttpRequest to send the selected value to the server
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_type.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Handle the response from the server
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Handle the response if needed
        }
    };
    xhr.send("fuel=" + encodeURIComponent(fuel) + "&brand=" + encodeURIComponent(brand));
    //callPHPFunction();
  }
  function callPHPFunction() {
    const brand = document.getElementById("brand").value;
    const fuel = document.getElementById("fuel").value;

    // Redirect to the PHP script with parameters
    window.location.href = `fuel-form.php?brand=${encodeURIComponent(brand)}&fuel=${encodeURIComponent(fuel)}`;
    //calculateDistances();
}
function saveFormData() {
        const formElements = document.querySelectorAll("input, select, textarea"); // Select all form fields
    const excludedIds = ["fuel", "brand", "license_id","inputEmail"]; // Array of excluded field IDs

    formElements.forEach((element) => {
        // Check if the element's type is not button/submit and its ID is not in the excludedIds array
        if (element.type !== "button" && element.type !== "submit" && !excludedIds.includes(element.id)) {
            localStorage.setItem(element.id, element.value); // Save each field value with its ID as the key
        }
                  });
    }

    // Function to restore form data from localStorage
    function restoreFormData() {
        const formElements = document.querySelectorAll("input, select, textarea"); // Select all form fields
        formElements.forEach((element) => {
            if (localStorage.getItem(element.id)) {
                element.value = localStorage.getItem(element.id); // Set each field with the saved value
            }
        });
        localStorage.clear();
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
  <div class="col-lg-12 order-1 order-lg-2 container3" id="container" style="display: block;">
    <div class="form-container sign-up-container">
        <br>
        <h1><b><u>Fuel Booking</u></b></h1><br>
        <form class="row g-4" action="bookfuel.php" method="POST">
            <div class="col-md-4">
                <label for="inputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="inputName" name="name" placeholder="Enter your name" title="Please enter your full name">
            </div>
            <div class="col-md-4">
                <label for="inputEmail1" class="form-label">Email</label>
                <input class="form-control" name="email" type="email" value="<?php echo htmlspecialchars($email); ?>" aria-label="Email" id="inputEmail1" readonly title="Email address">
            </div>
                        <div class="col-md-4">
                <label for="inputPhone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="phone" title="phone">
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
                <select id="fuel" name="fuel" class="form-select" title="Select fuel type" onchange="storeFuel()" required>
                    <option selected>Choose...</option>
                    <option value="petrol">Petrol</option>
                    <option value="diesel">Diesel</option>
                </select>
            </div>
                        <div class="col-md-3">
                <label for="brand" class="form-label">Brand</label>
                <select id="brand" name="brand" class="form-select" title="Select fuel type" required>
                    <option selected>Choose...</option>
                    <option value="Indian oil">Indian oil</option>
                    <option value="HP">HP</option>
                    <option value="BP">Bharat petroleum</option>
                </select>
            </div>
            <div class="col-md-3" style="position: relative;padding-top: 30px;">
                <button type="button" name="search_pump" class="btn btn-primary" onclick="callPHPFunction()" onmouseleave="calculateDistances();">Search Pumps</button>
            </div><div id="dvMapFuel" style="width: 350px; height: 320px; position: relative"></div>
            <div id="formContainer" style="display: none; justify-content: center; align-items: center; position: fixed; top: 20%; left: 45%; height: 100vh; width: 100vw;">
<div  style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 400px; height: 300px; border: 1px solid #ccc; padding: 20px; background-color: white; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
  <h3><u>INPUT YOUR QUANTITY</u></h3><br>
<div class="row mb-3">
    <div class="col-md-4" style="position : relative;padding-top: 2%">
                <label for="quantity" class="form-label">Quantity :</label></div>
    <div class="col-md-6">
                <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Liters" title="liters" oninput="calculateAmount()" required>
            </div></div>
            <div class="row mb-3" >
            <div class="col-md-4" style="position : relative;padding-top: 2%">
                <label for="amount" class="form-label">Amount :</label></div><div class="col-md-6">

                <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter fuel amount" title="Amount in liters" oninput="calculateQuantity()" >
            </div></div><div class="row mb-3"><input type="submit" name="submit" class="btn btn-primary" id="submit" value="Pay" >
              </div>
            </div></div>

            

            
        
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
<th scope="col">Select</th>
</tr>
</thead>
<tbody>
<?php
if (isset($_GET['brand']) && isset($_GET['fuel'])) {
    $brand = $_GET['brand'];
    $fuel = $_GET['fuel'];
    $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";
 $con=mysqli_connect("$sname","$uid","$pwd","$db");
 if($con){
  //$brand=$_SESSION['brand'];
 $q="select * from pump_reg where Brand='$brand'";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['Brand']}</td><td>{$row['place']}</td><td>{$row['P_amount']}</td><td>{$row['D_amount']}</td><td id='dis_$x' data-lat='{$row['latitude']}' data-lon='{$row['longitude']}'></td><td><input type='hidden' name='license_id' id='license_id_$x' value='{$row['licence']}'><button type='button' class='btn btn-primary' onclick='toggleForm({$row['licence']})' name='button'>Select</button></td></tr> ";
}}}
?>
</form>
</tbody>
</table>
</div>
    </div>
</div>


    




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
   // Toggle container3 visibility
document.addEventListener("DOMContentLoaded", function() {
    // Toggle container3 visibility
    document.getElementById('showFormBtn').addEventListener('click', function(event) {
        event.preventDefault();
        const container3 = document.getElementById('container3');
        const container2 = document.getElementById('container2');

        // Toggle visibility for container3 and hide container2
        if (container3.style.display === 'none' || !container3.style.display) {
            container3.style.display = 'block';
            container2.style.display = 'none';
        } else {
            container3.style.display = 'none';
        }
    });

    // Toggle container4 visibility
    document.getElementById('showFormBtn2').addEventListener('click', function(event) {
        event.preventDefault();
        const container4 = document.getElementById('container4');
        const container2 = document.getElementById('container2');

        // Toggle visibility for container4 and hide container2
        if (container4.style.display === 'none' || !container4.style.display) {
            container4.style.display = 'block';
            container2.style.display = 'none';
        } else {
            container4.style.display = 'none';
        }
    });

    // Ensure buttons inside container3 and container4 do not close the container
    document.querySelectorAll('#container3 button, #container4 button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent click event from affecting container visibility
        });
    });
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
function toggleForm(licenseId) {
    const formContainer = document.getElementById("formContainer");
    // Toggle the display style between 'none' and 'block'
    if (formContainer.style.display === "none" || formContainer.style.display === "") {
        formContainer.style.display = "block";
    } else {
        formContainer.style.display = "none";
    }
    fetchPrice(licenseId);
}



  </script>

</body>

</html>