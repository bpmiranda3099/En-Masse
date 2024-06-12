<?php
session_start();

if (isset($_GET['registration']) && $_GET['registration'] == 'success') {
    echo "<script>alert('Registration successful!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        .register-container {
            text-align: center;
            margin-top: 50px;
        }
        .register-container .card {
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Adding a subtle drop shadow */
        }
        .register-container .card-header {
            background-color: #fff;
            border: none;
            font-size: 24px;
            font-weight: bold;
            padding: 20px 0;
        }
        .register-container .card-body {
            background-color: #fff;
            padding: 20px;
        }
        .register-container .form-control {
            border: 1px solid #ddd;
            border-radius: 0;
            margin-bottom: 20px;
        }
        .register-container .btn-primary {
            background-color: #000;
            border: none;
            border-radius: 0;
            font-weight: bold;
            padding: 10px 20px;
        }
        .register-container .btn-primary:hover {
            background-color: #333;
        }
        .register-container p {
            margin-top: 20px;
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
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            z-index: 1000;
            width: 600px; /* Example original width */
            height: 800px; /* Example original height */
        }
		.dialog-container .btn-primary {
            background-color: #000;
            border: none;
            border-radius: 0;
            font-weight: bold;
            padding: 10px 20px;
        }
        .dialog-container .btn-primary:hover {
            background-color: #333;
        }
    </style>
</head>
<body>
	<!-- Menu Bar -->
    <?php include 'menu.html'; ?>
	
    <div class="container register-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-8"> <!-- Adjusted width of register form for different screen sizes -->
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form id="registerForm" action="register_action.php" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
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
                            <button type="submit" class="btn btn-primary btn-block" onclick="showDialog(event); return false;">Sign Up</button>
                        </form>
                        <p>Already have an account? <a href="login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
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
        <button onclick="hideDialog()" class="btn btn-primary btn-block">Decline</button>
        <button onclick="submitForm()" class="btn btn-primary btn-block">Accept</button>
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
