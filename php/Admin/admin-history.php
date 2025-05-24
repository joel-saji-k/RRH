<?php
session_start(); 
?>
<?php
if (isset($_POST['savechange'])){
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $Email = $_POST['Email'];
    $_SESSION['email'] = $Email;

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
        $q = "UPDATE admin SET name='$Email'";
        $result = $con->query($q);
        if ($result) {
            // Refresh the page after a successful update
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    mysqli_close($con);
      }
    }
    ob_end_flush();

  if (isset($_POST['changepass'])){
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $Pass = $_POST['Password'];
    $newPass = $_POST['newpassword'];
    $rePass = $_POST['renewpassword'];
    if($newPass!=$rePass){
      echo "<script>alert('Re-entered password is incorrect ');</script>";
    }
    else{
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
        $q = "SELECT password FROM admin WHERE name='$email' AND password='$password'";
         $result = $con->query($q);
        $row = $result->fetch_assoc();
        $pascheck = $row['password'];
       
        if($pascheck==$Pass){
        $q = "UPDATE admin SET password='$newpassword' WHERE name='$email' AND password='$password'";
        $result = $con->query($q);
        if ($result) {
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    mysqli_close($con);
      }
      else{
        echo "<script>alert('Oop password incorrect!.. ');</script>";
      }
    }
  }
}
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

</head>

<body>
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
        $q = "SELECT * FROM admin WHERE name='$email' AND password='$password'";
        $result = $con->query($q);

        // Check if the query returned a result
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['name'];
            $pass = $row['password'];
        }
    }

    // Close the database connection
    $con->close();
}
?>

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
      <li><a class="nav-link collapsed" href="admin-mechanic.php">
          <i class="bi bi-truck"></i>
          <span>Mechanic Service</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed " href="admin-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link " href="admin-history.php">
          <i class="bi bi-question-circle"></i>
          <span>History</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->
    </ul>

  </aside><!-- End Sidebar-->

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin-index.php">Home</a></li>
          <li class="breadcrumb-item active">History</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        

        <div class="col-xl-8">

          <div class="card" style="width: 60rem;">
            <div class="card-body pt-3 ">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending_list">Pending</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#approved_list">Approved</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#reject_list">Rejected</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#services">Services</button>
                </li>
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="pending_list">
                  
                  <h5 class="card-title">Fuel</h5>

                  <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">License</th>
<th scope="col">Brand</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Latitude</th>
<th scope="col">Longitude</th>
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
 $q="select * from fuel_reg_request";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['license']}</td><td>{$row['brand']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td></tr> ";
}}
?>
</tbody>
</table>
</div>
<h5 class="card-title">Mechanic</h5>
 <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">License</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Latitude</th>
<th scope="col">Longitude</th>
<th scope="col">Type</th>
</tr>
</thead>
<tbody>
<?php
 $q="select * from mechanic_reg_request";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['license']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><td>{$row['type']}</td></tr> ";
}
?>
</tbody>
</table>
</div>             

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="approved_list">

                  <h5 class="card-title">Fuel</h5>

                  <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">License</th>
<th scope="col">Brand</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Latitude</th>
<th scope="col">Longitude</th>
<th scope="col">Pertol Rate</th>
<th scope="col">Desel Rate</th>
<th scope="col">Status</th>
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
    echo "<tr><th scope='row'>$x</th><td>{$row['licence']}</td><td>{$row['Brand']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><td>{$row['P_amount']}</td><td>{$row['D_amount']}</td><td>{$row['status']}</td></tr> ";
}}
?>
</tbody>
</table>
</div>
<h5 class="card-title">Mechanic</h5>
 <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">License</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Latitude</th>
<th scope="col">Longitude</th>
<th scope="col">Type</th>
<th scope="col">Status</th>
</tr>
</thead>
<tbody>
<?php
 $q="select * from mechanic_reg";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['licence']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><td>{$row['type']}</td><td>{$row['status']}</td></tr> ";
}
?>
</tbody>
</table>
</div>             


                </div>

                <div class="tab-pane fade pt-3" id="reject_list">
                  <!-- Change Password Form -->
                  <h5 class="card-title">Fuel</h5>

                  <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">License</th>
<th scope="col">Brand</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Latitude</th>
<th scope="col">Longitude</th>
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
 $q="select * from pump_reject";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['license']}</td><td>{$row['brand']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td></tr> ";
}}
?>
</tbody>
</table>
</div>
<h5 class="card-title">Mechanic</h5>
 <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">License</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Latitude</th>
<th scope="col">Longitude</th>
<th scope="col">Type</th>
</tr>
</thead>
<tbody>
<?php
 $q="select * from mechanic_reject";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['license']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['latitude']}</td><td>{$row['longitude']}</td><td>{$row['type']}</td></tr> ";
}
?>
</tbody>
</table>
</div>             

                </div>
                <div class="tab-pane fade pt-3" id="services">
                
                  <h5 class="card-title">Fuel Booked</h5>

                  <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">Date & Time</th>
<th scope="col">Name</th>
<th scope="col">Email</th>
<th scope="col">Fuel Type</th>
<th scope="col">Quantity</th>
<th scope="col">Amount</th>
<th scope="col">Service Provider id</th>
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
 $q="select * from fuelbook";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['time']}</td><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['fuel']}</td><td>{$row['quantity']}</td><td>{$row['amount']}</td><td>{$row['license']}</td></tr> ";
}}
?>
</tbody>
</table>
</div>              
<h5 class="card-title">Mechanic Booked</h5>
 <div class="table-responsive">
<table class="table">
<thead>
<tr>
<th scope="col">Slno</th>
<th scope="col">Date & Time</th>
<th scope="col">Name</th>
<th scope="col">Type of vehicle</th>
<th scope="col">Issue</th>
<th scope="col">Service Provider id</th>
</tr>
</thead>
<tbody>
<?php
 $q="select * from mechanicbook";
 $result=$con->query($q);
 $x=0;
 while ($row = $result->fetch_assoc()) {
    $x=$x+1;
    echo "<tr><th scope='row'>$x</th><td>{$row['time']}</td><td>{$row['name']}</td><td>{$row['type']}</td><td>{$row['issue']}</td><td>{$row['license']}</td></tr> ";
}
?>
</tbody>
</table>
</div>             
</div>

                
        </div>
      </div>
      </div>
    </section>
<br><br><br><br><br>
  </main>


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
  <script src="../../assets/assets2/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../assets/assets2/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/quill/quill.js"></script>
  <script src="../../assets/assets2/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/assets2/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/assets2/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/assets2/assets/js/main.js"></script>

</body>


</html>





