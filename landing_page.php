<?php
session_start();

// Database configuration
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "enmasse";

// Connect to the database
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is already logged in
if(isset($_SESSION['user'])){
    exit;
}

// If the login form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username and password are valid
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Perform your authentication logic here, e.g., querying the database
    
    // Assuming authentication is successful, set session variables
    $_SESSION['user'] = $username;
    
    // Redirect the user to a logged-in page
    header("Location: index.php");
    exit;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>en masse. - Landing</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/en-masse-icon.ico" rel="icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="..." crossorigin="anonymous">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
  <!-- Header -->
    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container d-flex justify-content-between">
            <div class="logo">
                <h1><a href="index_in_session.php"><img src="assets/img/en-masse-logo.png" alt="Logo">en masse.</a></h1>
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto" href="index_in_session.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="index_in_session.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index_in_session.php#team">Team</a></li>
                    <li><a class="nav-link scrollto" href="index_in_session.php#contact">Contact</a></li>
                    <li><a class="nav-link scrollto" href="user_profile.php">Profile</a></li>
					<li><a href="logout.php" class="btn">Logout</a>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>
        </div>
    </header>
    <!-- End Header -->

  <main>
	<br><br><br><br><br><br>
	<div id="gallery" class="gallery" onclick="moveSlide(1)" data-aos="fade-right">
        <div class="slides">
            <div class="slide">
                <img src="assets/img/instructions.png" alt="Image 1">
                <div class="text">Text for Image 1</div>
            </div>
            <div class="slide">
                <img src="assets/img/instructions.png" alt="Image 2">
                <div class="text">Text for Image 2</div>
            </div>
            <div class="slide">
                <img src="assets/img/instructions.png" alt="Image 3">
                <div class="text">Text for Image 3</div>
            </div>
            <div class="slide">
                <img src="assets/img/instructions.png" alt="Image 3">
                <div class="text">Text for Image 3</div>
            </div>
        </div>
		<div id="gallery-arrows" class="gallery-arrows">
			<button class="nav-button left" onclick="moveSlide(-1); event.stopPropagation();">&#10094;</button>
			<button class="nav-button right" onclick="moveSlide(1); event.stopPropagation();">&#10095;</button>
		</div>
    </div>
	<div class="row mt-5 justify-content-center" data-aos="fade-up">
		<div class="centered-button">
			<a href="compose_email.php" class="next-button">Compose Email</a>
			<a href="upload_page.php" class="next-button">Upload Data</a>
		</div>
	</div>
	<br>
	<br>
	<br>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>en masse.</h3>
              <p>
                LPU - C, Governor's Dr<br>
                General Trias, Cavite, PH<br><br>
                <strong>Phone:</strong> <br>
				+639602056529<br><br>
                <strong>Email:</strong> postmaster@.mg.enmasse.me<br>
              </p>
			  <br>
              <div>
				<a href="mailto:postmaster@mg.enmasse.me"><i class="fas fa-envelope" style="color: white; font-size: 24px;"></i></a>
				<a href="https://github.com/bpmiranda3099/en-masse"><i class="bi bi-github" style="color: white; font-size: 24px;"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
			<br>
			<br>
            <h4>Useful Links</h4>
			<br>
            <ul>
              <li><a href="index_in_session.php">Home</a></li>
              <li><a href="index_in_session.php#about">About</a></li>
			  <li><a href="index_in_session.php#team">Team</a></li>
			  <li><a href="index_in_session.php#contact">Contact</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
	
  </footer><!-- End Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- Sliding Gallery JS -->
  <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelector('.slides');
            const slideCount = slides.children.length;
            let index = 0;

            function nextSlide() {
                index = (index + 1) % slideCount;
                slides.style.transform = `translateX(-${index * 100}%)`;
            }

            let interval = setInterval(nextSlide, 2000);

            document.querySelector('.gallery').addEventListener('mouseover', () => {
                clearInterval(interval);
            });

            document.querySelector('.gallery').addEventListener('mouseout', () => {
                interval = setInterval(nextSlide, 3000);
            });

            window.moveSlide = (direction) => {
                index = (index + direction + slideCount) % slideCount;
                slides.style.transform = `translateX(-${index * 100}%)`;
            };
        });
		
		document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true 
            });
            
            setTimeout(function() {
                document.querySelectorAll('[data-aos]').forEach(function(element) {
                    element.classList.add('aos-animate');
                });
            }, 100); 
        });
    </script>
</body>

</html>