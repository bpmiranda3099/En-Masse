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
        /* CSS for menu bar */
        .menu {
            overflow: hidden;
            position: relative;
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .menu li {
            float: left;
        }

        .menu li.logo {
            float: left; /* Keep the logo to the left */
        }

        .menu li a {
            display: block;
            color: #333;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu li a:hover {
            background-color: #ddd;
            color: black;
        }

        .menu .right-links {
            float: right; /* Align right */
            margin-left: 10px; /* Add a small margin between links */
        }

        /* CSS for centering upload form */
        .upload-container {
            text-align: center;
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <!-- Menu Bar -->
    <div class="menu">
        <ul>
            <li class="logo"><a href="landing_page.php">Logo</a></li>
            <li class="right-links"><a href="logout.php">Logout</a></li>
            <li class="right-links"><a href="user_profile.php">Profile</a></li>
            <li class="right-links"><a href="about.php">About Us</a></li>
            <li class="right-links"><a href="contact_us.php">Contact Us</a></li>
        </ul>
    </div>
    <br><br><br><br>
    <div class="upload-container">
        <h2>Upload Excel File</h2>
        <!-- Adjusted form action -->
        <form action="<?php echo $upload_page; ?>" method="post" enctype="multipart/form-data">
            <label for="file">Upload Excel File:</label>
            <input type="file" name="file" id="file" accept=".xlsx">
            <!-- Hidden input field to include the username from the session -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="submit" value="Upload">
        </form>
    </div>
</body>
</html>
