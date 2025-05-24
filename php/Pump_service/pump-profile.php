<?php
session_start(); 
?>
<?php
if (isset($_POST['savechange'])){
    $email = $_SESSION['email'];
    $password = $_SESSION['password'];
    $Name = $_POST['Name'];
    $Pertol=$_POST['pertol'];
    $Diesel=$_POST['diesel'];
    $Email = $_POST['Email'];
    $Place = $_POST['place'];
    $Status = $_POST['status'];
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
        $q = "UPDATE pump_reg SET name='$Name',email='$Email',place='$Place',status='$Status',D_amount=$Diesel,P_amount=$Pertol WHERE email='$email' AND password='$password'";
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
        $q = "SELECT password FROM pump_reg WHERE email='$email' AND password='$password'";
         $result = $con->query($q);
        $row = $result->fetch_assoc();
        $pascheck = $row['password'];
       
        if($pascheck==$Pass){
        $q = "UPDATE pump_reg SET password='$newPass' WHERE email='$email' AND password='$password'";
        $_SESSION['password'] = $newPass;
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

  <title>Users / Profile</title>
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
  <link href="../../assets/assets2/assets/css/main.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../assets/assets2/assets/css/style.css" rel="stylesheet">
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
        $q = "SELECT name FROM pump_reg WHERE email='$email' AND password='$password'";
        $result = $con->query($q);

        // Check if the query returned a result
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $_SESSION["name"] = $name;

        }
        $q = "SELECT licence FROM pump_reg WHERE email='$email' AND password='$password'";
        $result = $con->query($q);

        // Check if the query returned a result
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $license = $row['licence'];
            $_SESSION["license"] = $license;

        }
        $q = "SELECT * FROM pump_reg WHERE email='$email' AND password='$password'";
        $result = $con->query($q);

        // Check if the query returned a result
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $place = $row['place'];
            $_SESSION['name']=$place;
            $status = $row['status'];
            $petrol=$row['P_amount'];
            $diesel=$row['D_amount'];
        }
    }

    // Close the database connection
    $con->close();
}
?>
?>

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
        <li><a class="nav-link collapsed " href="pump-index.php">
          <i class="bi bi-truck"></i>
          <span>Request</span>
        </a>
      </li><!-- End Dashboard Nav -->

      
      <li class="nav-item">
        <a class="nav-link" href="">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pump-history.php">
          <i class="bi bi-question-circle"></i>
          <span>History</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

            <li class="nav-item">
        <a class="nav-link collapsed" href="pump-feedback.php">
          <i class="bi bi-question-circle"></i>
          <span>Feedback</span>
        </a>
      </li>
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="pump-index.php">Home</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($_SESSION['name']); ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($email); ?></div>
                  </div>

                  <div class="row">   <div class="col-lg-3 col-md-4
                  label">License</div>   <div class="col-lg-9 col-md-8"><?php
                  echo htmlspecialchars($_SESSION['license']); ?></div> </div>
                  <div class="row">   <div class="col-lg-3 col-md-4
                  label">Place</div>   <div class="col-lg-9 col-md-8"><?php
                  echo htmlspecialchars($place); ?></div> </div>   <div
                  class="row">   <div class="col-lg-3 col-md-4 label">Pertol
                  Rs.</div>   <div class="col-lg-9 col-md-8"><?php echo
                  htmlspecialchars($petrol); ?></div> </div> <div class="row">
                  <div class="col-lg-3 col-md-4 label">Diesel Rs.</div>   <div
                  class="col-lg-9 col-md-8"><?php echo
                  htmlspecialchars($diesel); ?></div> </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Status</div>
                    <div class="col-lg-9 col-md-8"><?php echo htmlspecialchars($status);?></div>
                  </div>
                  

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="">
                    

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Name" type="text" class="form-control" id="fullName" value="<?php echo htmlspecialchars($name); ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Email" type="text" class="form-control" id="company" value="<?php echo htmlspecialchars($email); ?>">
                      </div>
                    </div>
                                        <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Place</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="place" type="text" class="form-control" id="company" value="<?php echo htmlspecialchars($place); ?>">
                      </div>
                    </div>
                      <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Petrol Rs.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="pertol" type="text" class="form-control" id="company" value="<?php echo htmlspecialchars($petrol); ?>
">
                      </div>
                    </div>
                      <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Diesel Rs.</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="diesel" type="text" class="form-control" id="company" value="<?php echo htmlspecialchars($diesel); ?>">
                      </div>
                    </div>

                    
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Status</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="status" type="text" class="form-control" id="Phone" value="<?php echo htmlspecialchars($status); ?>">
                      </div>
                    </div>

                   

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="savechange">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="changepass">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

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