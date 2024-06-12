<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

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

// Fetch table names tied to the current user
$username = $_SESSION['username'];
$tables_query = "SELECT table_name FROM user_uploaded_tables WHERE user_id = (SELECT user_id FROM login WHERE username = '$username')";
$tables_result = $conn->query($tables_query);

$table_names = array();
if ($tables_result->num_rows > 0) {
    while ($row = $tables_result->fetch_assoc()) {
        $table_names[] = $row['table_name'];
    }
}

$conn->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Maxim Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
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
					<h1><a href="index.php">en masse.</a></h1>
					<!-- Uncomment below if you prefer to use an image logo -->
					<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
				</div>

				<nav id="navbar" class="navbar">
					<ul>
						<li><a class="nav-link scrollto" href="index.php">Home</a></li>
						<li><a class="nav-link scrollto" href="index.php#about">About</a></li>
						<li><a class="nav-link scrollto" href="index.php#team">Team</a></li>
						<li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
						<li><a class="nav-link scrollto" href="user_profile.php">Profile</a></li>
						<li><a href="logout.php" class="btn">Logout</a>
					</ul>
					<i class="bi bi-list mobile-nav-toggle"></i>
				</nav><!-- .navbar -->

			</div>
		</header><!-- End Header -->

  <main>
	<br><br><br>
		<div class="container">
			<div class="row" data-aos="fade-left">
				<?php if (!empty($table_names)): ?>
					<div class="dropdown">
						<select id="tableSelect" class="get-started-button">
							<option>Modify Data</option>
							<?php foreach ($table_names as $table_name): ?>
								<option value="<?php echo $table_name; ?>"><?php echo $table_name; ?></option>
							<?php endforeach; ?>
						</select>
						<a href="upload_page.php" class="next-button" id="new-file">New File</a>
					</div>
				<?php else: ?>
					<br>
					<div class="centered-button">
						<a href="upload_page.php" class="next-button">Get Started</a>
					</div>
				<?php endif; ?>
			</div>
			<br><br>
			<div class="section-bg" style="background-color: white; color: black; text-align: center;"  data-aos="fade-left">
			  <h2>Compose Email</h2>
			</div>
			
			<div class="row mt-5 justify-content-center" data-aos="fade-right">
				  <div class="col-lg-10">
					<form action="forms/contact.php" method="post" role="form" class="php-email-form">
					
					  <div class="row">
						  <div class="col-md-6 form-group">
							<input type="email" name="email" class="form-control" id="email" placeholder="Recipient's Email" required>
						  </div>
						  <div class="col-md-6 form-group">
							<label for="tableSelect-recipient" class="sr-only">Recipient:</label>
							<select id="tableSelect-recipient" class="form-control">
							  <option>Select Data</option>
							  <?php foreach ($table_names as $table_name): ?>
								<option value="<?php echo $table_name; ?>"><?php echo $table_name; ?></option>
							  <?php endforeach; ?>
							</select>
						  </div>
					  </div>
					  
					  <div class="form-group mt-3">
						<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
					  </div>
					  
					  <div class="form-group mt-3">
						<textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
					  </div>
					  
						<div class="form-group mt-3">
							<label for="attachments" style="color: grey;">Attachments:</label>
							<br>
							<input type="file" id="attachments" name="attachments[]" multiple class="attachment-button">
						</div>
						
						<br>
						
						<div class="text-center" data-aos="fade-up">
							<button type="submit" class="next-button" id="next-button">Send Email</button>
						</div>
					  
					</form>
				  </div>
			</div>
		</div>
	<br>
	<br>
	<br>
	
	<div id="lightbox" style="display: none;">
		<div id="lightbox-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
		<div id="lightbox-content" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; width: 80%; max-width: 1000px; height: 80%; max-height: 550px; overflow-y: auto;">
			<div style="position: sticky; top: 0; background-color: rgba(255, 255, 255, 0); padding: 10px; z-index: 1;">
				<button class="next-button" id="close-lightbox">Close</button>
				<button class="next-button" id="save-lightbox">Save</button>
				<button class="next-button" id="export-lightbox">Export</button>
				<button class="next-button" id="delete-lightbox">Delete</button>
			</div>
			<table class="styled-table" id="lightbox-table" style="width: 100%;">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
					</tr>
				</thead>
				<tbody id="tableBody">
					<!-- Your content here -->
				</tbody>
			</table>
		</div>
	</div>
	
	<div id="smtp-lightbox" style="display: none;">
		<div id="lightbox-content">
			<h2>Enter Email Credentials</h2>
			<form id="email-credentials-form">
				<div class="form-group">
					<input type="email" id="smtp-email" class="form-control" name="email" required placeholder="Email" value="postmaster@mg.enmasse.me" required>
				</div>
				<div class="form-group">
					<input type="password" id="smtp-password" class="form-control" name="password" required placeholder="Password" value="enmasse4ever" required>
				</div>
				<div class="form-group">
					<button id="close-smtp-lightbox" class="lightbox-button">Close</button>
					<button type="submit" id="send-email-lightbox" class="lightbox-button">Send Email</button
				</div>
			</form>
		</div>
	</div>
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
              <li><a href="index.php">Home</a></li>
              <li><a href="index.php#about">About</a></li>
			  <li><a href="index.php#team">Team</a></li>
			  <li><a href="index.php##contact">Contact</a></li>
              <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center" style="color: white;"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- Sliding Gallery JS -->
  <script>
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
		
		function showLightbox() {
			document.getElementById("lightbox").style.display = "block";
			document.getElementById("attachments").style.display = "none";
			document.getElementById("tableSelect").style.display = "none";
			document.getElementById("new-file").style.display = "none";

		}

		function hideLightbox() {
			document.getElementById("lightbox").style.display = "none";
			document.getElementById("attachments").style.display = "block";
			document.getElementById("tableSelect").style.display = "block";
			document.getElementById("new-file").style.display = "block";

			// Remove the event listener when hiding the lightbox
			window.removeEventListener("click", windowClickHandler);
		}

		document.getElementById("tableSelect").addEventListener("change", function() {
			if (this.value !== "Select Table") {
				fetchTableData(this.value); // Call function to fetch table data
			} else {
				hideLightbox();
			}
		});

		function fetchTableData(tableName) {
			fetch('http://127.0.0.1:5000/fetch_table_data', { 
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					table_name: tableName
				})
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Network response was not ok');
				}
				return response.json();
			})
			.then(data => {
				if (data.table_data) {
					updateTable(data.table_data);
					showLightbox(); // Call showLightbox() here
				} else {
					console.error('Failed to fetch table data');
				}
			})
			.catch(error => {
				console.error('Error fetching table data:', error);
			});
		}

		function updateTable(tableData) {
			const tableBody = document.getElementById("tableBody");
			tableBody.innerHTML = ""; // Clear existing table data

			tableData.forEach(rowData => {
				const row = document.createElement("tr");
				const nameCell = document.createElement("td");
				const emailCell = document.createElement("td");

				const nameInput = document.createElement("input");
				nameInput.type = "text";
				nameInput.value = rowData.name; // Assuming 'name' is the key for the name data
				nameInput.className = "form-control";
				
				const emailInput = document.createElement("input");
				emailInput.type = "text";
				emailInput.value = rowData.email; // Assuming 'email' is the key for the email data
				emailInput.className = "form-control";

				nameCell.appendChild(nameInput);
				emailCell.appendChild(emailInput);

				row.appendChild(nameCell);
				row.appendChild(emailCell);

				tableBody.appendChild(row);
			});
		}

		document.getElementById("close-lightbox").addEventListener("click", function() {
			hideLightbox();
		});

		function validateSelection() {
		var selectBox = document.getElementById("tableSelect");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
		if (selectedValue === "Select Table") {
			alert("Please select data.");
			return false;
		}
		return true;
		}

		document.getElementById("export-lightbox").addEventListener("click", function() {
			var selectBox = document.getElementById("tableSelect");
			var selectedValue = selectBox.options[selectBox.selectedIndex].value;
			if (selectedValue === "Select Table") {
				alert("Please select data.");
			} else {
				window.location.href = `http://127.0.0.1:5000/export_table?table_name=${selectedValue}`;
			}
		});
		
		document.getElementById("delete-lightbox").addEventListener("click", function() {
		var selectBox = document.getElementById("tableSelect");
		var selectedValue = selectBox.options[selectBox.selectedIndex].value;

		if (selectedValue === "Select Table") {
			alert("Please select a table.");
			return;
		}

		if (confirm("Are you sure you want to delete this table? This action cannot be undone.")) {
			fetch('http://127.0.0.1:5000/delete_table', { // Change the URL to match your Flask server's URL
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					table_name: selectedValue,
					username: "<?php echo $_SESSION['username']; ?>" // Pass the username from the session
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.message === "Table and entry deleted successfully") {
					alert("Table deleted successfully.");
					window.location.reload(); // Refresh the page
				} else {
					alert("Failed to delete table: " + data.message);
				}
			})
			.catch(error => {
				console.error('Error deleting table:', error);
			});
		}
		});

		document.getElementById("save-lightbox").addEventListener("click", function() {
			var selectBox = document.getElementById("tableSelect");
			var selectedValue = selectBox.options[selectBox.selectedIndex].value;

			if (selectedValue === "Select Table") {
				alert("Please select a table.");
				return;
			}

			var tableBody = document.getElementById("tableBody");
			var rows = tableBody.getElementsByTagName("tr");
			var tableData = [];

			for (var i = 0; i < rows.length; i++) {
				var cells = rows[i].getElementsByTagName("td");
				var name = cells[0].getElementsByTagName("input")[0].value;
				var email = cells[1].getElementsByTagName("input")[0].value;
				tableData.push({ name: name, email: email });
			}

			fetch('http://127.0.0.1:5000/save_table', { // Change the URL to match your Flask server's URL
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					table_name: selectedValue,
					table_data: tableData,
					username: "<?php echo $_SESSION['username']; ?>" // Pass the username from the session
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.message === "Table data saved successfully") {
					alert("Table data saved successfully.");
					window.location.reload(); // Refresh the page
				} else {
					alert("Failed to save table data: " + data.message);
				}
			})
			.catch(error => {
				console.error('Error saving table data:', error);
			});
		});
		
		// Declare recipients variable outside of event listeners
		let recipients = []; // Only email addresses will be stored here
		let recipients_names = []; // Only names will be stored here

		document.getElementById("tableSelect-recipient").addEventListener("change", function() {
			// Get the selected table name
			const selectedTableName = this.value;

			// Check if a valid table name is selected
			if (selectedTableName !== "Select Data") {
				// Fetch email data for the selected table
				fetch('http://127.0.0.1:5000/fetch_table_data', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						table_name: selectedTableName
					})
				})
				.then(response => response.json())
				.then(data => {
					// Check if table data was successfully fetched
					if (data.table_data) {
						// Clear the arrays before populating them
						recipients = [];
						recipients_names = [];

						// Store the fetched email data
						data.table_data.forEach(recipient => {
							recipients.push(recipient.email);
							recipients_names.push(recipient.name);
						});

						const emailInput = document.getElementById("email");
						emailInput.value = ""; // Clear the email input before appending the emails

						recipients.forEach((email, index) => {
							if (index !== 0) {
								emailInput.value += ", "; // Add comma separator if not the first email
							}
							emailInput.value += email; // Append email address
						});

						console.log("Recipients Name\s:", recipients_names); // Log recipients' names
						console.log("Recipients Email\s:", recipients); // Log modified recipients
					} else {
						console.error("Failed to fetch email data:", data.message);
					}
				})
				.catch(error => {
					console.error('Error fetching email data:', error);
				});
			}
		});
		
		document.getElementById("next-button").addEventListener("click", function(event) {
			event.preventDefault(); // Prevent default form submission

			// Get values from form inputs
			const emailInput = document.getElementById("email").value;
			const subject = document.getElementById("subject").value;
			const message = document.querySelector("textarea[name='message']").value;
			const attachmentsInput = document.getElementById("attachments");
			let attachments = [];

			// Check if there are attachments
			if (attachmentsInput.files.length > 0) {
				// Loop through each selected file
				for (let i = 0; i < attachmentsInput.files.length; i++) {
					attachments.push(attachmentsInput.files[i]);
				}
			}

			// Determine recipients based on the email input
			let recipientEmails;
			if (emailInput.includes(',')) {
				// Split email input into an array if it contains commas
				recipientEmails = emailInput.split(',').map(email => email.trim());
			} else {
				// Use email input directly if no commas
				recipientEmails = [emailInput];
			}

			// Log recipientEmails
			console.log("Subject:", subject);
			console.log("Message:", message);
			console.log("Recipient Emails:", recipientEmails);
			console.log("Attachments:", attachments);

			// Show SMTP lightbox
			showSMTPLightbox(subject, message, recipientEmails, attachments);
		});
		
		function showSMTPLightbox() {
			document.getElementById("smtp-lightbox").style.display = "block";
		}
		
		document.getElementById("close-smtp-lightbox").addEventListener("click", function() {
			hideSMTPLightbox();
		});
		
		// Hide lightbox
		function hideSMTPLightbox() {
			document.getElementById("smtp-lightbox").style.display = "none";
		}

		// Function to collect SMTP credentials
		function collectSMTPCredentials() {
			const email = document.getElementById("smtp-email").value;
			const password = document.getElementById("smtp-password").value;
			console.log("SMTP Email:", email); // Log SMTP email
			console.log("SMTP Password:", password); // Log SMTP password
			return { email, password };
		}

		document.getElementById("send-email-lightbox").addEventListener("click", function(event) {
			event.preventDefault(); // Prevent default form submission

			// Collect SMTP credentials
			const { email, password } = collectSMTPCredentials();

			// Get values from form inputs
			const emailInput = document.getElementById("email").value;
			const subject = document.getElementById("subject").value;
			const message = document.querySelector("textarea[name='message']").value;
			const attachmentsInput = document.getElementById("attachments");
			let attachments = [];

			// Check if there are attachments
			if (attachmentsInput.files.length > 0) {
				const oversizedFiles = []; // Array to store the names of files that are too large
				attachments = []; // Array to store the valid files

				// Loop through each selected file
				for (let i = 0; i < attachmentsInput.files.length; i++) {
					const file = attachmentsInput.files[i];
					// Check file size (size is in bytes, 25MB = 25 * 1024 * 1024)
					if (file.size > 25 * 1024 * 1024) {
						oversizedFiles.push(file.name); // Add file name to the array
					} else {
						attachments.push(file);
					}
				}

				// If there are any oversized files, alert the user
				if (oversizedFiles.length > 0) {
					hideSMTPLightbox();
					alert(`The following file(s) exceed the 25MB size limit:\n- ${oversizedFiles.join('\n- ')}`);
					attachmentsInput.value = ''; // Clear the file input
					return; // Stop processing if any file is too large
				}
			}

			// Determine recipients based on the email input
			let recipientEmails;
			if (emailInput.includes(',')) {
				// Split email input into an array if it contains commas
				recipientEmails = emailInput.split(',').map(email => email.trim());
			} else {
				// Use email input directly if no commas
				recipientEmails = [emailInput];
			}

			// Log recipientEmails
			console.log("Subject:", subject);
			console.log("Message:", message);
			console.log("Recipient Emails:", recipientEmails);
			console.log("Attachments:", attachments);

			// Send email via AJAX
			sendEmail(recipientEmails, subject, message, attachments, email, password);
		});

		function sendEmail(recipients, subject, message, attachments, email, password) {
			const formData = new FormData();
			recipients.forEach(recipient => formData.append('recipientsEmail[]', recipient));
			formData.append('subject', subject);
			formData.append('message', message);
			for (let i = 0; i < attachments.length; i++) {
				formData.append('attachmentsInput[]', attachments[i]);
			}
			formData.append('email', email);
			formData.append('password', password);

			fetch('http://127.0.0.1:5000/send-email', {
				method: 'POST',
				body: formData
			})
			.then(response => {
				if (response.ok) {
					return response.json();
				}
				throw new Error('Failed to send email');
			})
			.then(data => {
				console.log("Response:", data);
				if (data.message === "Emails sent successfully") {
					alert("Emails sent successfully");
					location.reload();
				} else {
					alert("Failed to send emails: " + data.error);
				}
			})
			.catch(error => {
				console.error('Error:', error);
				alert("Failed to send emails: " + error.message);
			});
		}
    </script>
</body>

</html>