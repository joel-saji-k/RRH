<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link href="../../assets/css/main.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
        body {
            background-color: #0b3e93; /* Light background */
                    }
        .wrapper {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 30px;

            border-radius: 5px;
            box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
            margin-top: 100px; /* Space from top */
        }
        .container {
    display: flex;
    justify-content: space-between;
    gap: 20px; /* Optional: space between columns */
    padding: 20px;
}
.map-container {
    flex: 0.5;
    padding-top: 10%;
}

.hero {
    position: relative;
}

#dvMapMechanic {
    position: absolute;
    top: 50px; /* Adjust this value to position the map vertically */
    left: 10px; /* Adjust this value to position the map horizontally */
    width: 400px; /* Adjust the width of the map */
    height: 500px; /* Adjust the height of the map */
    z-index: 2; /* Ensure the map appears on top */
}
        .nav-tabs .nav-link.active {
            background-color: #007bff; /* Active tab color */
            color: white;
        }
        .nav-tabs .nav-link {
            color: #007bff; /* Tab color */
        }
        .text-center h2 {
            margin-bottom: 20px; /* Space below heading */
        }
         .popup {
            display: none;
            position: absolute;
            left: 40%;
            top: 10%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #47b2e4;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid red;
            border-radius: 20px;
            z-index: 1000;
        }
        .popup.active {
            display: block;
        }
    </style>
</head>

<body>
<div class="container">
    <div id="popup" class="popup"></div>
    <div class="wrapper">
        <h2 class="text-center">Fuel Delivery Provider</h2>
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signup" role="tab">Signup</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="login" role="tabpanel">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="loginEmail">Email address</label>
                        <input type="email" class="form-control" id="loginEmail" placeholder="Enter email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                    <div class="text-center">
                        <a href="#">Forgot password?</a>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="signup" role="tabpanel">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="signupEmail">Email address</label>
                        <input type="email" class="form-control" name="signupEmail" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="license">License no</label>
                        <input type="text" class="form-control" name="license" placeholder="License no" required>
                    </div>
                    <div class="form-group">
                        <label for="place">Place</label>
                        <input type="text" class="form-control" name="place" placeholder="place" required>
                    </div>

                    <div class="form-group">
                        <label for="latitude">Latitude</label>
                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Longitude" readonly required>
                    </div>
                    <button type="button" class="btn btn-info btn-block" onclick="getLocation('latitude','longitude','dvMapMechanic');";>Get Location</button>
                    <div class="form-group">
                        <label for="brand">Brand</label>
                        <select id="brand" name="brand" class="form-select" title="Select fuel type" required>
                    <option selected>Choose...</option>
                    <option value="Indian oil">Indian oil</option>
                    <option value="HP">HP</option>
                    <option value="BP">Bharat petroleum</option>
                </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="signupPassword">Password</label>
                        <input type="password" class="form-control" name="signupPassword" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm password</label>
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password" required>
                    </div>
                    <button type="submit" name="Signup" class="btn btn-primary btn-block">Signup</button>
                </form>
            </div>
        </div>
    </div>
<div class="map-container">
    <div class="hero" style="position: relative;">
        <div style="height: 1000px">
        <img src="../../assets/img/Designer.png" class="img-fluid animated" alt="" style="width: 100%;"></div>
        <!-- Map positioned over the image -->
        <div id="dvMapMechanic"></div>
    </div>
</div>
    </div>
    </body><div style="position: relative; margin-left: -25%">
<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Rahul VR</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https">Rahul & Joel</a>
    </div>
 

  </footer></div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validatePassword() {
            const password = document.getElementById("signupPassword").value;
            const confirmPassword = document.getElementById("confirmPassword").value;
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }

    </script>
    <!-- Include Google Maps JavaScript API -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3MPnSnyWwNmpnVEFkaddVvy_GWtxSejs"></script>
<script>
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
<?php
 if(isset($_POST['Signup']))
{
 $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";

 $name=$_POST['name'];
 $email=$_POST['signupEmail'];
 $lat=$_POST['latitude'];
 $lon=$_POST['longitude'];
 $place=$_POST['place'];
 $brand=$_POST['brand'];
 $license=$_POST['license'];
 $pass=$_POST['signupPassword'];
 $pass2=$_POST['confirmPassword'];
 $con=mysqli_connect("$sname","$uid","$pwd","$db");
 if ($pass !== $pass2) {
        echo "<script>window.onload = function() { showPopup('Passwords do not match!'); };</script>";
        exit();
    }
 if($con){
 $q="select email from fuel_reg_request where email='$email'";
 $q2="select email from pump_reg where email='$email'";
 $result=$con->query($q);
 $result2=$con->query($q2);
  if($result->num_rows > 0 OR $result2->num_rows > 0){
   echo "<script>window.onload = function() { showPopup('Provider already exist'); };</script>"; 

   exit();
   }
 $q="insert into fuel_reg_request values($license,'$name','$email','$pass','$lat','$lon','$brand','$place')";
 if($con->query($q)){
 echo "<script>
        window.onload = function() { 
            showPopup('Registration request successfully sent!'); 
            setTimeout(function() { 
                window.location.href = 'fuellogin.php'; 
            }, 3000); // Redirect after 3 seconds
        };
      </script>";
}
 else
echo "<script>window.onload = function() { showPopup('Registration Failed!'); };</script>";
}
$con->close();
}

if(isset($_POST['login'])){

     $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";

  $con=mysqli_connect("$sname","$uid","$pwd","$db");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
  $email=$_POST['email'];
  $password=$_POST['password'];
  $q1="SELECT * FROM pump_reg WHERE email='$email' AND password='$password'";
  $r=$con->query($q1);
  if($r->num_rows > 0)
  {
    session_unset();
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    echo "<script>window.location.href = 'pump-index.php';</script>";
    exit();
  }
  
   else{
     echo "<script>window.onload = function() { showPopup('Incorrect user name or password!'); };</script>";
     }
   $con->close();
}


?>

    
</html>
