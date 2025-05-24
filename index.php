<?php
session_start(); // This must be the first line
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL)
?>
<html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Roadside Rescue Hub: Fuel & Fix</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/img/favicon.png" rel="icon">
  <link href="/assets/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/signin_up.css">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
        .popup {
            display: none;
            position: absolute;
            left: 50%;
            top: 20%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #47b2e4;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #ccc;
            border-radius: 20px;
            z-index: 1000;
        }
        .popup.active {
            display: block;
        }
    </style>
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
          <a href="index.php" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/img/apple-touch-icon.png" alt="">
        <h1 class="sitename">Roadside Rescue Hub</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>Join with as</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li class="dropdown"><a href="php/Pump_service/fuellogin.php">Fuel Delevery Provider</a>
              </li>
              <li class="dropdown"><a href="php/mechanic_service/mechlogin.php">Mobile Workshop Technician</a>
              </li>
            </ul>
          </li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="#" id="btn">Get Started</a>

    </div>
 </header>
    

 

  <main class="main">
    
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div id="popup" class="popup"></div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Drive with Confidence: Instant Fuel and Repair Solutions on Demand</h1>
            <p>24/7 Roadside Relief</p>
            <div class="d-flex">
              <a class="btn-get-started" href="#" id="btn2">Get Started</a>
              <a href="assets/video/about.mp4" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/Designer.png" class="img-fluid animated" alt="">

            <!-- temp -->

    <div class="col-lg-6 order-1 order-lg-2 container2 panel-active" id="container2">
        <div class="form-container sign-up-container">
            <form action="" method="POST">
                <h1 id="hd">Create Account</h1>
                <input type="text" name="name" placeholder="Name" />
                <input type="email" name="email" placeholder="Email" />
                <input type="text" name="phone" placeholder="phone" />
                <input type="password" name="password" placeholder="Password" />
                <button type="submit" name="submit1">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="POST">
                <h1 id="hd" style="text-align: center;">Sign in</h1>
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <button type="submit" name="submit2">Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>



<!-- temp close -->



          </div>
        </div>
      </div>

    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">

      <div class="container" data-aos="zoom-in">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 120
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/Indian-Oil-Logo.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/yamaha.jpeg" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/bharat.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/royal.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/hp.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/Honda.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/Reliance.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/tvs.png" class="img-fluid" alt=""></div>
          </div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About Us</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p>
              Our website serves as an essential lifeline for motorists facing unexpected roadside emergencies by offering two critical services: emergency fuel delivery and on-demand mechanic assistance. We understand that being stranded due to an empty fuel tank or a sudden vehicle breakdown can be stressful and inconvenient. That's why our platform, designed with user-friendliness, makes it easy for drivers to receive fast and reliable help no matter where they are.</p>

<p>Using advanced geolocation technology, our platform quickly pinpoints the user’s exact location and connects them to the nearest available resources. For fuel emergencies, users can order petrol or diesel from the closest fuel stations, which are carefully selected based on proximity and availability. This service is especially valuable for drivers who may find themselves in remote areas without easy access to fuel stations.</p>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <p id="short-content">In the event of a vehicle breakdown, our on-demand mechanic assistance service steps in. Users can easily request roadside help through the platform, which identifies and connects them to nearby repair shops or certified mobile mechanics.</p> <p id="full-content" style="display: none;">
            Whether it's a flat tire, engine trouble, or any other mechanical issue, our platform ensures that skilled professionals are dispatched quickly to provide on-site repairs. This eliminates the need for long wait times and expensive towing services, offering a more immediate and cost-effective solution.

Our dual-service platform is designed to alleviate the stress and uncertainty that often accompany automotive emergencies, providing motorists with peace of mind. Our mission is to ensure that every driver has access to fast, reliable roadside assistance, empowering them to get back on the road safely and confidently. </p>
            <a href="#" class="read-more" id="toggle-content"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

        </div>

      </div>

    </section><!-- /About Section -->

   

    <!-- Services Section -->
    <section id="services" class="services section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Fueling your journey and fixing your ride, all in one stop</p>
        <p>Your trusted partner for seamless fuel delivery and mobile repairs.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-xl-3 col-md-6 d-flex service-box service-box-1" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-fuel-pump-fill icon"></i></div>
              <h4><a href="#" class="stretched-link btn-get-started" id="btn3">Fuel Delevery</a></h4>
              <p>Fuel delivery services bring fuel directly to your location, eliminating the need to visit a fuel station.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-3 col-md-6 d-flex service-box service-box-2" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item position-relative">
              <div class="icon"><i class="bi bi-tools icon"></i></div>
              <h4><a href="#" class="stretched-link btn-get-started" id="btn4">Mobile Workshop</a></h4>
              <p>Mobile workshop services provide on-site repair and maintenance solutions, bringing the workshop directly to the customer’s location</p>
            </div>
          </div><!-- End Service Item -->

          

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

      <img src="assets/img/cta-bg.jpg" alt="">

      <div class="container">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3>Call To Action</h3>
            <p>keeping you moving, anytime, anywhere</p>
            <p>From fuel to fix, we bring the service to you</p>
          </div>
          <div class="col-xl-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#" id="btn">Call To Action</a>
          </div>
        </div>

      </div>

    </section><!-- /Call To Action Section -->

    <!-- Portfolio Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>We are dedicated to providing swift, reliable roadside assistance to ensure every journey is safe and worry-free. Our team combines innovation with a commitment to serving those in need, creating impactful solutions for motorists facing unexpected challenges on the road</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/rahul.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Rahul V R</h4>
                <span>Co-Founder</span>
                <p>Commitment to creating impactful solutions that enhance everyday life. I strive to push the boundaries of what’s possible
</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="assets/img/team/joel.jpg" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>Joel Saji</h4>
                <span>Co-Founder</span>
                <p>Passionate about enhancing roadside assistance, I am dedicated to making RRH a reliable, easy-to-use platform for every motorist. My goal is to drive innovation in emergency services, providing solutions that address real needs with efficiency and care.</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          

        </div>

      </div>

    </section><!-- /Team Section -->

    

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Your satisfaction is our priority. Contact us with any queries or concerns</p>
      </div><!-- End Section Title -->

      <div class="container " data-aos="fade-up" data-aos-delay="100">
        <div class="d-flex justify-content-center">

        <div class="row gy-4">

          <div class="col-lg-15">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>Union Christian College Aluva</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+91 86067 44829</p>
                  <p>+91 94961 80540</p>

                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>rahulrajeevan33@.com</p>
                  <p>joelsajioffical@.com</p>

                </div>
              </div><!-- End Info Item -->

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d981.9245975254531!2d76.33482699708958!3d10.123755508990572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3b080fdde2ec1815%3A0xdfa91f539876ab85!2sMCA%20Block%2C%20UC%20College!5e0!3m2!1sen!2sin!4v1724345188761!5m2!1sen!2sin" width="400" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          

        </div>
      </div>

      </div>

    </section><!-- /Contact Section -->

  </main>


<footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-5">
            <div class="col-lg-3 col-md-6 footer-about">
                <a href="index.php" class="d-flex align-items-center">
                    <span class="sitename">Rahul VR</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Varapuzha</p>
                    <p>Kerala, India</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+91 8606744829</span></p>
                    <p><strong>Email:</strong> <span>rahulrajeevan33@.com</span></p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 footer-about">
                <a href="index.php" class="d-flex align-items-center">
                    <span class="sitename">Joel Saji</span>
                </a>
                <div class="footer-contact pt-3">
                    <p>Aluva</p>
                    <p>Kerala, India</p>
                    <p class="mt-3"><strong>Phone:</strong> <span>+91 94961 80540</span></p>
                    <p><strong>Email:</strong> <span>joelsajioffical@.com</span></p>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Useful Links</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#team">Team</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-3 footer-links">
                <h4>Our Services</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Fuel Delevery</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Mobile Workshop</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-12">
                <h4>Follow Us</h4>
                <p>Keep touch with us</p>
                <div class="social-links d-flex">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
 
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Rahul VR</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">Rahul & Joel</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/assets/js/main.js"></script>
  <script src="assets/js/login.js" defer></script>
  <!-- Php validation -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 $sname="localhost";
 $uid="root";
 $pwd="";
 $db="rrh";
 if(isset($_POST['submit1'])){
 $name=$_POST['name'];
 $email=$_POST['email'];
 $password=$_POST['password'];
 $phone=$_POST['phone'];
 $con=mysqli_connect("$sname","$uid","$pwd","$db");
 if($con){
 $q="select email from usr_reg where email='$email'";
 $result=$con->query($q);
  if($result->num_rows > 0){
   echo "<script>window.onload = function() { showPopup('User already exist'); };</script>"; 

   exit();
   }
 $q="insert into usr_reg(name,email,phone,password)values('$name','$email',$phone,'$password')";
 if($con->query($q)){
 echo "<script>window.onload = function() { showPopup('Sucessfully Registered!'); };</script>";
}
 else
echo "<script>window.onload = function() { showPopup('Registration Failed!'); };</script>";
}
$con->close();
}

if(isset($_POST['submit2'])){
  $con=mysqli_connect("$sname","$uid","$pwd","$db");
  if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
  $email=$_POST['email'];
  $password=$_POST['password'];
  $q1="SELECT * FROM admin WHERE name='$email' AND password='$password'";
  $r=$con->query($q1);
  if($r->num_rows > 0)
  {
    $_SESSION["email"] = $email;
    $_SESSION["password"] = $password;
    echo "<script>window.location.href = 'php/Admin/admin-index.php';</script>";
    exit();
  }
  $q="SELECT * FROM usr_reg WHERE email='$email' AND password='$password'";
$result=$con->query($q);
 if($result->num_rows > 0){
  $_SESSION["email"] = $email;
  $_SESSION["password"] = $password;
  echo "<script>window.location.href = 'php/pages-index.php';</script>";
 exit();
}
   else{
     echo "<script>window.onload = function() { showPopup('Incorrect user name or password!'); };</script>";
     }
   $con->close();
}
$con->close();
}
?>
<script>
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