<?php
session_start();

if (isset($_GET['registration']) && $_GET['registration'] == 'success') {
    echo "<script>alert('Registration successful!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* CSS for menu bar */
        .menu {
            background-color: #f2f2f2;
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

        /* CSS for centering login form */
        .login-container {
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
            <li class="right-links"><a href="register.php">Signup</a></li>
            <li class="right-links"><a href="login.php">Login</a></li>
            <li class="right-links"><a href="about.php">About Us</a></li>
            <li class="right-links"><a href="contact_us.php">Contact Us</a></li>
        </ul>
    </div>
    
    <div class="login-container">
        <h2>Login</h2>
        <form action="login_process.php" method="post">
            <label for="login">Username or Email:</label>
            <input type="text" id="login" name="login" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</body>
</html>
