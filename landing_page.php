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
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>
    <p>This is the landing page. You are logged in.</p>
    <p><a href="logout.php">Logout</a></p>

    <hr>

    <h2>Upload Excel File</h2>
    <!-- Adjusted form action -->
    <form action="<?php echo $upload_page; ?>" method="post" enctype="multipart/form-data">
        <label for="file">Upload Excel File:</label>
        <input type="file" name="file" id="file" accept=".xlsx">
        <!-- Hidden input field to include the username from the session -->
        <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
        <input type="submit" value="Upload">
    </form>
</body>
</html>
