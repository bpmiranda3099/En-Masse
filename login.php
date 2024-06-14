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
    // User is already logged in, you can redirect them to a dashboard or another page.
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

  <title>en masse. - Login/Signup</title>
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

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Maxim
  * Template URL: https://bootstrapmade.com/maxim-free-onepage-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body style="overflow-x: hidden;">

	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex justify-content-between">

			<div class="logo">
				<h1><a href="index.php"><img src="assets/img/en-masse-logo.png" alt="Logo">en masse.</a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
			</div>

			<nav id="navbar" class="navbar">
				<ul>
					<li><a class="nav-link scrollto" href="index.php#hero">Home</a></li>
					<li><a class="nav-link scrollto" href="index.php#about">About</a></li>
					<li><a class="nav-link scrollto" href="index.php#team">Team</a></li>
					<li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->
	
	<br><br><br><br><br><br>
	
    <div class="card" id="login-container" style="opacity: 1; visibility: visible; height: auto; border: none; box-shadow: none; box shadow outline: none; max-width: 800px; margin: 0 auto;" data-aos="fade-right">
		<div class="row justify-content-center">
			<div class="col-md-6 col-sm-8"> <!-- Adjusted width of login form for different screen sizes -->
				<div class="card">
					<div class="card-header section-bg" style="font-size: 20px; color: white;"><strong>Login</strong></div>
					<div class="card-body">
						<form action="login_process.php" method="post">
							<br>
							<div class="form-group">
								<input type="text" class="form-control" id="login" name="login" placeholder="Username or Email" required>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
							</div>
							<br>
							<button type="submit" class="next-button">Login</button>
						</form>
						<br>
						<p>Don't have an account? <a href="#" id="show-register" style="color: grey;">Signup here</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card" id="register-container" style="opacity: 0; visibility: hidden; height: 0; border: none; box-shadow: none; box shadow outline: none;"  data-aos="fade-right">
		<div class="row justify-content-center">
			<div class="col-md-6 col-sm-8">
				<div class="card">
					<div class="card-header section-bg" style="font-size: 20px; color: white;"><strong>Signup</strong></div>
					<div class="card-body">
						<br>
						<form action="register_action.php" method="post">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
									</div>
									<div class="form-group">
										<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
									</div>
									<div class="form-group">
										<select class="form-control" id="user_type" name="user_type" required>
											<option value="student">Student</option>
											<option value="teacher">Teacher</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
									</div>
								</div>
							</div>
							<div class="form-check">
								<input type="checkbox" class="form-check-input" name="terms_conditions" required>
								<label class="form-check-label" for="terms_conditions">I agree to the <a href="terms_and_conditions.html" target="_blank"><strong>Terms of Service and the Privacy Policy</strong></a></label>
							</div>
							<br>
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="next-button">Signup</button>
								</div>
							</div>
						</form>
						<br>
						<p>Already have an account? <a href="#" id="show-login"><strong>Login here</strong></a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<br><br><br><br>
	
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
              <li><a href="index.php#hero">Home</a></li>
              <li><a href="index.php#about">About</a></li>
			  <li><a href="index.php#team">Team</a></li>
			  <li><a href="index.php#contact">Contact</a></li>
              <li><a href="index.php#">Terms of service</a></li>
              <li><a href="index.php#">Privacy policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Maxim</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/maxim-free-onepage-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/" style="color: white;">BootstrapMade</a>
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
  
  <script>
  
	document.addEventListener('DOMContentLoaded', function() {
		AOS.init({
			once: true
		});

		// Initial animation trigger for elements already in view
		setTimeout(function() {
			document.querySelectorAll('[data-aos]').forEach(function(element) {
				element.classList.add('aos-animate');
			});
		}, 100); 
	});

	document.getElementById('show-register').addEventListener('click', function() {
		document.getElementById('login-container').style.opacity = '0';
		document.getElementById('login-container').style.visibility = 'hidden';
		document.getElementById('login-container').style.height = '0';

		document.getElementById('footer').style.opacity = '0';

		setTimeout(function() {
			document.getElementById('register-container').style.opacity = '1';
			document.getElementById('register-container').style.visibility = 'visible';
			document.getElementById('register-container').style.height = 'auto';

			setTimeout(function() {
				document.getElementById('footer').style.opacity = '1';
				AOS.refresh();
			}, 300); // Adjust this delay to match the transition duration
		}, 100);
	});

	document.getElementById('show-login').addEventListener('click', function() {
		document.getElementById('register-container').style.opacity = '0';
		document.getElementById('register-container').style.visibility = 'hidden';
		document.getElementById('register-container').style.height = '0';

		document.getElementById('footer').style.opacity = '0';

		setTimeout(function() {
			document.getElementById('login-container').style.opacity = '1';
			document.getElementById('login-container').style.visibility = 'visible';
			document.getElementById('login-container').style.height = 'auto';

			setTimeout(function() {
				document.getElementById('footer').style.opacity = '1';
				AOS.refresh();
			}, 300); // Adjust this delay to match the transition duration
		}, 100);
	});
		
  </script>

</body>

</html>