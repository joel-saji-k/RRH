<?php
session_start(); 
// Assuming the license value is stored in session
$license = $_SESSION['license'];
$time =$_SESSION['time'];
$uemail=$_SESSION['email'];
if(isset($_POST['submit'])){
    // Get the rating and feedback from POST data
    $rating = $_POST['rating'];  // Use 'rating' to get the radio button value
    $feedback = $_POST['feedback'];  // Use 'feedback' for additional comments

    // Database connection
    $sname = "localhost";
    $uid = "root";
    $pwd = "";
    $db = "rrh";

    // Create connection
    $con = mysqli_connect($sname, $uid, $pwd, $db);
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert feedback into the database
    $sql = "INSERT INTO feedback VALUES('$time','$license','$uemail', '$rating', '$feedback')";
    if (mysqli_query($con, $sql)) {
        echo "Feedback submitted successfully!";
        sleep(2); 
    // Redirect to the home page
    header("Location: pages-index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback</title>
  <link href="../assets/img/img/favicon.png" rel="icon">
  <link href="/RRH/assets/assets2/assets/css/style.css" rel="stylesheet">
  <link href="/RRH/assets/assets2/assets/css/page-main.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

<div class="modal-header">
  <h3 class="scrolling-text">Give your valuable feedback after delivery of the service.....</h3>
</div>

<!-- Modal Launch Button -->
<button type="button" class="btn btn-info btn-lg openmodal" data-toggle="modal" data-target="#myModal">Feedback</button>

<!-- Modal Division -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" style="max-width: 50%;">
    <!-- Modal Content -->
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Feedback</h3>
        <button type="button" class="close" data-dismiss="modal" style="color: white;">&times;</button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body text-center">
        <i class="far fa-file-alt fa-4x mb-3 animated rotateIn icon1"></i>
        <h3>Your opinion matters</h3>
        <h5>Help us improve our services? <strong>Give us your feedback.</strong></h5>
        <hr>
        <h6>Your Rating</h6>

        <!-- Feedback Form -->
        <form method="POST" action="">
          <!-- Radio Buttons for Rating -->
          <div class="form-check-group">
            <table class="table">
              <thead>
                <tr>
                  <td>
                    <div class="form-check mb-3">
                      <input type="radio" name="rating" value="Very good" id="very-good">
                    </div>
                  </td>
                  <td>
                    <label for="very-good" class="ml-3">Very good</label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-check mb-3">
                      <input type="radio" name="rating" value="Good" id="good">
                    </div>
                  </td>
                  <td>
                    <label for="good" class="ml-3">Good</label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-check mb-3">
                      <input type="radio" name="rating" value="Mediocre" id="mediocre">
                    </div>
                  </td>
                  <td>
                    <label for="mediocre" class="ml-3">Mediocre</label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-check mb-3">
                      <input type="radio" name="rating" value="Bad" id="bad">
                    </div>
                  </td>
                  <td>
                    <label for="bad" class="ml-3">Bad</label>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="form-check mb-3">
                      <input type="radio" name="rating" value="Very Bad" id="very-bad">
                    </div>
                  </td>
                  <td>
                    <label for="very-bad" class="ml-3">Very Bad</label>
                  </td>
                </tr>
              </thead>
            </table>
          </div>

          <!-- Text Area for Additional Feedback -->
          <div class="text-center">
            <h4>What could we improve?</h4>
          </div>
          <textarea class="form-control" placeholder="Your Message" rows="3" name="feedback"></textarea>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="submit" name="submit" class="btn btn-primary">
              Send <i class="fa fa-paper-plane"></i>
            </button>
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<div style="padding-top: 5%;padding-right: 50%">
  <footer id="footer" class="footer" style="width: 100%; text-align: center;">
    <div class="copyright">
      &copy; Copyright <strong><span>Rahul VR</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="https">Rahul & Joel</a>
    </div>
  </footer>
</div>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

<!-- Inline CSS -->
<style type="text/css">
  .modal-header {
    color: white;
    background-color: #007bff;
  }
  .icon1 {
    color: #007bff;
  }
  .openmodal {
    margin-left: 35%;
    width: 25%;
    margin-top: 25%;
  }
  textarea {
    border: none;
    box-shadow: none !important;
    outline: 0px !important;
  }
  .scrolling-text {
    display: inline-block;
    white-space: nowrap;
    overflow: hidden;
    animation: scroll 10s linear infinite;
  }

  /* Pause the animation on hover */
  .scrolling-text:hover {
    animation-play-state: paused;
  }

  @keyframes scroll {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
  }
  .form-check-group {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }
  .form-check {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .form-check input[type="radio"] {
    margin: auto;
  }
  .form-check label {
    font-weight: normal;
  }
</style>

</body>
</html>
