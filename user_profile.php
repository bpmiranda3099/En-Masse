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
    // User is already logged in, redirect them to a dashboard or another page.
    header("Location: dashboard.php"); // Redirect to dashboard or appropriate page
    exit;
}

// If the login form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // Sanitize input to prevent SQL injection
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    
    // Perform authentication logic
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    
    if ($hashed_password && password_verify($password, $hashed_password)) {
        // Authentication successful, set session variables
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user_id;
        
        // Redirect the user to a logged-in page
        header("Location: index.php");
        exit;
    } else {
        // Invalid username or password
        $error = "Invalid username or password.";
    }
    
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>en masse. - Profile</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
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
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css'>
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
	
	<br><br><br><br><br>
	
	<div class="container">
    <div class="main-body">
   
	<br><br><br>
	
          <!-- Profile Details-->
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card" data-aos="fade-right">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
						<img src="assets/img/profile-img.png" alt="Admin" class="rounded-circle" width="150">
						<div class="mt-3">
							<h4 id="profileName">Name</h4>
						</div>
					</div>
                </div>
              </div>
              <!-- /Profile Details-->
			  <br>
              <!-- Connections &  Links -->
              <div class="card mt-3" data-aos="fade-right">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="bi bi-github" style="margin: 8px;"></i>Github</h6>
                    <span class="text-secondary">Set Github</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="bi bi-instagram" style="margin: 8px;"></i>Instagram</h6>
                    <span class="text-secondary">Set Instagram</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0"><i class="bi bi-facebook" style="margin: 8px;"></i>Facebook</h6>
                    <span class="text-secondary">Set Facebook</span>
                  </li>
                </ul>
              </div>
            </div>
               <!-- /Connections &  Links -->
               <!-- User Details -->
				<div class="col-md-8" data-aos="fade-left">
					<div class="card mb-3">
						<div class="card-body" id="userDetailsContainer">
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>Username</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="username"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>Email</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="email"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>First Name</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="first_name"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>Last Name</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="last_name"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>Date of Birth</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="date_of_birth"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>Address</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="address"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>Phone Number</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="phone_number"></div>
							</div>
							<hr>
							<div class="row">
								<div class="col-sm-3">
									<h6 class="mb-0"><strong>User Type</strong></h6>
								</div>
								<div class="col-sm-9 text-secondary" id="user_type"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- /User Details -->
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
              <li><a href="#hero">Home</a></li>
              <li><a href="#about">About</a></li>
			  <li><a href="#team">Team</a></li>
			  <li><a href="#contact">Contact</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
	
  </footer><!-- End Footer -->
  
  <a href="landing_page.php" class="back-to-top d-flex align-items-center justify-content-center" style="color: white;" data-aos="fade-left"><i class="bi bi-arrow-left-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js'></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
		function fetchUserDetails() {
		fetch('http://localhost:5000/fetch_user_details', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			// Optionally, pass data if required by your backend
		})
		.then(response => response.json())
		.then(data => {
			if (data.user_details) {
				// Update profile elements with fetched data
				document.getElementById('username').textContent = data.user_details.username;
				document.getElementById('email').textContent = data.user_details.email;
				document.getElementById('first_name').textContent = data.user_details.first_name;
				document.getElementById('last_name').textContent = data.user_details.last_name;
				document.getElementById('date_of_birth').textContent = data.user_details.date_of_birth;
				document.getElementById('address').textContent = data.user_details.address;
				document.getElementById('phone_number').textContent = data.user_details.phone_number;
				document.getElementById('user_type').textContent = data.user_details.user_type;

				// Update the profile name
				document.getElementById('profileName').textContent = data.user_details.first_name + ' ' + data.user_details.last_name;
			} else {
				console.error('No user details found');
			}
		})
		.catch(error => {
			console.error('Error fetching user details:', error);
		});
	}

// Call fetchUserDetails when the page loads
window.onload = fetchUserDetails;

	// Call fetchUserDetails when the page loads
	window.onload = fetchUserDetails;
	
	</script>
</body>

</html>