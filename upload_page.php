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
<html>
<head>
    <title>Welcome and Upload Excel File</title>
    <style>

        /* CSS for centering upload form */
        .upload-container {
            text-align: center;
            margin-top: 100px;
        }

        /* CSS for drag and drop */
		.drag-drop {
			border: 2px dashed #ccc;
			padding: 20px;
			text-align: center;
			cursor: pointer;
			display: block; /* Ensure block-level display */
			width: 400px; /* Adjust width as needed */
			margin: auto; /* Center horizontally */
		}

		.drag-drop:hover {
			background-color: #f0f0f0;
		}

		/* CSS for cancel button */
		#cancelButton {
			margin-top: 10px;
			display: none; /* Initially hide cancel button */
			margin-left: auto; /* Center horizontally */
			margin-right: auto; /* Center horizontally */
		}
    </style>
</head>
<body>
    <?php include 'menu_in_session.html'; ?>
    <br><br><br><br>
    <div class="upload-container">
        <h2>Upload Excel File</h2>
        <!-- Adjusted form action -->
        <form id="uploadForm" action="<?php echo $upload_page; ?>" method="post" enctype="multipart/form-data">
            <!-- Hidden input field to include the username from the session -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <label for="file" class="drag-drop" id="dropArea">Drag and drop your file here or click to select<input type="file" name="file" id="file" accept=".xlsx" style="display: none;"></label>
            <br>
			<input type="submit" value="Upload" id="uploadButton">
            <button type="button" id="cancelButton">Cancel</button>
        </form>
        <p id="fileName"></p>
    </div>

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
            cancelButton.style.display = 'inline-block'; // Show cancel button
        }

        function showDropArea() {
            dropArea.style.display = 'block';
            cancelButton.style.display = 'none'; // Hide cancel button
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