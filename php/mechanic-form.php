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
        
        function haversineDistance(lat3,lon3) {

          const lat2=lat3;
          const lon2=lon3;
          var lat1 = document.getElementById("lat2").value;
            var lon1 = parseFloat(document.getElementById("lon2").value);
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
    const type = document.getElementById("type").value;
    // Redirect to the PHP script with parameters
    window.location.href = `mechanic-form.php?type=${encodeURIComponent(type)}`;
    //calculateDistances();
}
function saveFormData() {
    const formElements = document.querySelectorAll("input, select, textarea"); // Select all form fields
    const excludedIds = ["fuel", "brand", "license_id","inputEmail2"]; // Array of excluded field IDs

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
  <div class="col-lg-12 order-1 order-lg-2 container4" id="container4" style="display: flex;">
    <div class="form-container sign-up-container">
      <br>   
      <h1><b><u>Mechanic Assistance</u></b></h1><br>
    <form class="row g-4" method="POST" action="mechanic-book.php">
  <div class="col-md-4">
    <label for="inputName2" class="form-label">Name</label>
    <input type="text" name="name" class="form-control" id="inputName2">
  </div>
  <div class="col-md-4">
    <label for="inputEmail2" class="form-label">Email</label>
    <input class="form-control" name ="email" type="email" value="<?php echo htmlspecialchars($email); ?>" aria-label="" id="inputEmail2" readonly>
  </div>
  <div class="col-md-4">
    <label for="phone" class="form-label">Phone </label>
    <input class="form-control" name ="phone" type="text" placeholder="phone No." aria-label="" id="phone" required>
  </div>
  <div class="col-4">
    <label for="lat2" class="form-label">Latitude</label>
    <input type="text" class="form-control" name="lat" id="lat2">
  </div>
  <div class="col-4">
    <label for="lon2" class="form-label">Logitude</label>
    <input type="text" class="form-control" name="lon" id="lon2">
  </div>
  <div class="col-md-2"><br>
    <button type="button" class="btn btn-primary" onclick="getLocation('lat2','lon2','dvMapMechanic');";" style="margin-top: 7px;">Get Location</button>
  </div>
  <div class="col-md-4">
    <label for="type" class="form-label">Type of vehicle</label>
    <select class="form-select" title="Select fuel type" name="type" id="type" onchange="storeType()" required>
      <option selected>Choose...</option>
      <option value="twowheeler">Two wheeler</option>
      <option value="fourwheeler">Four wheeler</option>
    </select>
  </div>
  <div class="col-md-4">
    <label for="Issue" class="form-label">Issue</label>
    <input type="text" name="issue" class="form-control" id="Issue">
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
if (isset($_SESSION['type'])) {
    $type = $_SESSION['type'];
    $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";
 $con=mysqli_connect("$sname","$uid","$pwd","$db");
 if($con){
 $q="select * from mechanic_reg where type='$type' OR type='ALL'";
 $result=$con->query($q);
 $x=0;
 while ($row2 = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row2['name']}</td><td>{$row2['place']}</td><td id='dis_$x' data-lat='{$row2['latitude']}' data-lon='{$row2['longitude']}'></td><td><input type='hidden' name='license_id_$x' id='license_id' value='{$row2['licence']}'><button type='submit' class='btn btn-primary' onclick='toggleForm({$row2['licence']})' name='button_$x'>Request</button></td></tr> ";
}
$_SESSION['x']=$x;
}}
?>
</tbody>
</table></div>
</form>
</div></div>


    




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