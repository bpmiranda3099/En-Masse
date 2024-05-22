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
        .register-container {
            text-align: center;
            margin-top: 100px;
        }
        /* Style for floating dialog */
        .dialog-container {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            width: 300px; /* Example original width */
            height: 460px; /* Example original height */
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
	
    <div class="register-container">
        <h2>Register</h2>
        <form id="registerForm" action="register_action.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required><br><br>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required><br><br>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br><br>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" required><br><br>
            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type" required>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
            </select><br><br>
            <button onclick="showDialog(event); return false;">Sign Up</button>
        </form>
    </div>

    <!-- Floating dialog -->
    <div id="dialog" class="dialog-container">
		<br>
		<br>
		<br>
        <h3>Terms of Agreement and Privacy Policy</h3>
		<br>
        <p>By registering, you agree to the following terms and conditions:</p>
        <ol>
            <li>You will provide accurate and complete information during registration.</li>
            <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
            <li>Your personal information may be collected and used according to our <a href="privacy_policy.html">Privacy Policy</a>.</li>
            <li>You will not engage in any unlawful or prohibited activities on this platform.</li>
            <li>We reserve the right to suspend or terminate your account if you violate these terms.</li>
        </ol>
        <p>Please read our <a href="terms_of_service.html">Terms of Service</a> and <a href="privacy_policy.html">Privacy Policy</a> for more details.</p>
		<br>
        <button onclick="hideDialog()">Decline</button>
        <button onclick="submitForm()">Accept</button>
    </div>

    <script>
        function showDialog(event) {
            var form = document.getElementById('registerForm');
            if (form.checkValidity()) {
                var dialog = document.getElementById('dialog');
                dialog.style.display = 'block';
            } else {
                alert('Please fill in all required fields.');
            }
        }

        function hideDialog() {
            var dialog = document.getElementById('dialog');
            dialog.style.display = 'none';
        }

        function submitForm() {
            var form = document.getElementById('registerForm');
            form.submit();
        }
    </script>
</body>
</html>
