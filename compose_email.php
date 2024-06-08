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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Example</title>
	<link rel="stylesheet" href="styles.css">
	<style>
        body {
			font-family: Arial, sans-serif;
			background-color: #f4f4f4;
			margin: 0;
			padding: 0;
		}

		.container {
			background-color: #fff;
			padding: 20px;
			border-radius: 8px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 900px;
			margin: 0 auto; /* Center the container horizontally */
			margin-bottom: 20px; /* Add some space between containers */
		}

        .container h2 {
            margin-top: 0;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
		.form-group textarea {
			width: calc(100% - 10px); /* Adjusted width to accommodate padding and border */
			padding: 17px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box; /* Include padding and border in the width calculation */
		}
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="file"] {
            padding: 3px;
        }
		
    </style>
</head>
<body>
	<?php include 'menu.html'; ?>
	<?php if (!empty($table_names)): ?>
		<div class="dropdown">
			<select id="tableSelect" class="get-started-button">
				<option>Modify Data</option>
				<?php foreach ($table_names as $table_name): ?>
					<option value="<?php echo $table_name; ?>"><?php echo $table_name; ?></option>
				<?php endforeach; ?>
			</select>
			<a href="upload_page.php" class="next-button">New File</a>
		</div>
	<?php else: ?>
		<br>
		<div class="centered-button">
			<a href="upload_page.php" class="next-button">Get Started</a>
		</div>
	<?php endif; ?>
	
	<br><br>
	
	<div class="container">
		<h2>Compose Email</h2>
		<form action="/send-email" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="tableSelect-recipient">Recipient:</label>
				<select id="tableSelect-recipient" class="get-started-button">
					<option>Select Data</option>
					<?php foreach ($table_names as $table_name): ?>
						<option value="<?php echo $table_name; ?>"><?php echo $table_name; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="subject">Subject:</label>
				<input type="text" id="subject" name="subject" required>
			</div>
			<div class="form-group">
				<label for="message">Message:</label>
				<textarea id="message" name="message" rows="6" required></textarea>
			</div>
			<div class="form-group">
				<label for="attachments">Attachments:</label>
				<input type="file" id="attachments" name="attachments[]" multiple>
			</div>
			<div class="centered-button">
				<button id="next-button" type="submit">Next</button>
			</div>
		</form>
	</div>

	<div id="lightbox" style="display: none;">
		<div id="lightbox-overlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5);"></div>
		<div id="lightbox-content" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; width: 80%; max-width: 1000px; height: 80%; max-height: 550px; overflow-y: auto;">
			<div style="position: sticky; top: 0; background-color: rgba(255, 255, 255, 0); padding: 10px; z-index: 1;">
				<button id="close-lightbox">Close</button>
				<button id="save-lightbox">Save</button>
				<button id="export-lightbox">Export</button>
				<button id="delete-lightbox">Delete</button>
			</div>
			<table border="1" id="lightbox-table" style="width: 100%;">
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
			<button id="close-smtp-lightbox">Close</button>
			<h2>Enter Email Credentials</h2>
			<form id="email-credentials-form">
				<div class="form-group">
					<label for="smtp-email">Email:</label>
					<input type="email" id="smtp-email" name="email" required>
				</div>
				<div class="form-group">
					<label for="smtp-password">Password:</label>
					<input type="password" id="smtp-password" name="password" required>
				</div>
				<div class="form-group">
					<button type="submit" id="send-email-lightbox">Send Email</button>
				</div>
			</form>
		</div>
	</div>


<script>
	
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
	let recipients = [];

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
					// Store the fetched email data in the recipients variable
					recipients = data.table_data;
					console.log("Recipients:", recipients); // Log recipients here

					// Extract email addresses from recipients and clear the array
					const emailAddresses = recipients.map(recipient => recipient.email);
					recipients = [];
					emailAddresses.forEach(email => {
						recipients.push({ email: email });
					});

					console.log("Modified Recipients:", recipients); // Log modified recipients
					// Transform recipients array to contain only email addresses
					const emailArray = recipients.map(recipient => recipient.email);

					// Now recipients array only contains email addresses
					console.log("Email Array:", emailArray);
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
		const subject = document.getElementById("subject").value;
		const message = document.getElementById("message").value;
		const attachmentsInput = document.getElementById("attachments");
		let attachments = [];

		// Check if there are attachments
		if (attachmentsInput.files.length > 0) {
			// Loop through each selected file
			for (let i = 0; i < attachmentsInput.files.length; i++) {
				attachments.push(attachmentsInput.files[i]);
			}
		}

		// Perform any necessary validation here

		// Extract email addresses from recipients
		const recipientEmails = recipients.map(recipient => recipient.email);

		// Log recipientEmails
		console.log("Subject:", subject);
		console.log("Message:", message);
		console.log("Recipient Emails:", recipientEmails);
		console.log("Attachments:", attachments);

		// Show SMTP lightbox
		showSMTPLightbox(subject, message, recipientEmails, attachmentsInput);
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

	/// Function to collect SMTP credentials
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
		const subject = document.getElementById("subject").value;
		const message = document.getElementById("message").value;
		const attachmentsInput = document.getElementById("attachments");
		let attachments = [];

		// Check if there are attachments
		if (attachmentsInput.files.length > 0) {
			// Loop through each selected file
			for (let i = 0; i < attachmentsInput.files.length; i++) {
				attachments.push(attachmentsInput.files[i]);
			}
		}

		// Perform any necessary validation here

		// Extract email addresses from recipients
		const recipientEmails = recipients.map(recipient => recipient.email);

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
			} else {
				alert("Failed to send emails: " + data.error); // Change this line
			}
		})
		.catch(error => {
			console.error('Error:', error);
			alert("Failed to send emails: " + error.message);
		});
	}
</script>
<script src="main.js"></script>
</body>
</html>