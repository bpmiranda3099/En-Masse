<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Adjusted file name
$upload_page = "http://127.0.0.1:5000/upload"; // Change to the appropriate endpoint in Flask app

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>en masse. - Upload</title>
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
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

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

<body>

	<header id="header" class="fixed-top d-flex align-items-center">
		<div class="container d-flex justify-content-between">

			<div class="logo">
				<h1><a href="index_in_session.php"><img src="assets/img/en-masse-logo.png" alt="Logo">en masse.</a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
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
			</nav><!-- .navbar -->

		</div>
	</header><!-- End Header -->
	
    <br><br><br><br><br>
	
    <div class="container" style="max-width: 500px;">
		<div class="upload-container" data-aos="fade-right">
			<div class="card">
				<div class="card-header section-bg" style="font-size: 20px; color: white;"><strong>Upload Excel File</strong></div>
				<div class="card-body">
					<p class="instruction-text">Please upload an <strong>Excel file (.xlsx)</strong> containing two columns: <strong>Name</strong> and <strong>Email</strong>. The file should only contain data in these two columns; no additional content is allowed.</p>
					
					<p><a href="assets/sample/sample.xlsx" download><strong>Click here to download a sample Excel file</strong></a></p>
					
					<form id="uploadForm" action="<?php echo $upload_page; ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
						
						<div class="form-group">
							<label for="file" class="drag-drop" id="dropArea" style="color: black; font-size: 15px;"><strong>Drag and drop</strong> your file here or <strong>click to select</strong></label>
							<input type="file" class="form-control-file" name="file" id="file" accept=".xlsx" style="display: none;">
							<p id="fileName"></p>
						</div>
						<div class="form-group">
							<input type="submit" class="next-button" value="Upload" id="uploadButton" style="display: none;">
							<button type="button" class="next-button" id="cancelButton" style="display: none;">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    
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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
        // JavaScript for drag and drop functionality
        const dropArea = document.getElementById('dropArea');
        const fileInput = document.getElementById('file');
        const fileNameDisplay = document.getElementById('fileName');
        const cancelButton = document.getElementById('cancelButton');

        dropArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropArea.classList.add('highlight');
        });

        dropArea.addEventListener('dragleave', function() {
            dropArea.classList.remove('highlight');
        });

        dropArea.addEventListener('drop', function(e) {
            e.preventDefault();
            const files = e.dataTransfer.files;
            fileInput.files = files;
            dropArea.classList.remove('highlight');
            updateFileName(files[0].name);
            hideDropArea();
        });

        fileInput.addEventListener('change', function() {
            if (fileInput.files.length > 0) {
                updateFileName(fileInput.files[0].name);
                hideDropArea();
            }
        });

        cancelButton.addEventListener('click', function() {
            clearFileInput();
            showDropArea();
            fileNameDisplay.textContent = ''; // Clear file name display
        });

        function updateFileName(name) {
            fileNameDisplay.textContent = 'Selected file: ' + name;
        }

        function hideDropArea() {
            dropArea.style.display = 'none';
			uploadButton.style.display = 'inline-block';
            cancelButton.style.display = 'inline-block'; 
        }

        function showDropArea() {
            dropArea.style.display = 'block';
			uploadButton.style.display = 'none';
            cancelButton.style.display = 'none'; 
        }

        function clearFileInput() {
            fileInput.value = ''; // Clear file input
        }
		
		// Handle form submission with AJAX
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(uploadForm);
            fetch('<?php echo $upload_page; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === "File uploaded and processed successfully") {
                    window.location.href = 'compose_email.php';
                } else {
                    alert('Failed to upload file: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error uploading file:', error);
                alert('An error occurred while uploading the file.');
            });
        });
    </script>

</body>

</html>

