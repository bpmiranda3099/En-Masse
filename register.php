<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
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
        }
    </style>
</head>
<body>
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

    <!-- Floating dialog -->
    <div id="dialog" class="dialog-container">
        <h3>Terms of Agreement and Privacy Policy</h3>
        <p>By registering, you agree to the following terms and conditions:</p>
        <ol>
            <li>You will provide accurate and complete information during registration.</li>
            <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
            <li>Your personal information may be collected and used according to our <a href="privacy_policy.html">Privacy Policy</a>.</li>
            <li>You will not engage in any unlawful or prohibited activities on this platform.</li>
            <li>We reserve the right to suspend or terminate your account if you violate these terms.</li>
        </ol>
        <p>Please read our <a href="terms_of_service.html">Terms of Service</a> and <a href="privacy_policy.html">Privacy Policy</a> for more details.</p>
        <button onclick="hideDialog()">Decline</button>
        <button id="acceptButton" onclick="submitForm()">Accept</button>
    </div>

    <script>
        function showDialog(event) {
            event.preventDefault(); // Prevent default form submission
            var dialog = document.getElementById('dialog');
            dialog.style.display = 'block';
        }

        function hideDialog() {
            var dialog = document.getElementById('dialog');
            dialog.style.display = 'none';
        }

        function submitForm() {
            // Check if all required fields are filled
            var form = document.getElementById('registerForm');
            if (form.checkValidity()) {
                // Submit the form if all fields are filled
                form.submit();
            } else {
                // Optionally, you can display an error message or highlight the missing fields
                alert('Please fill in all required fields.');
            }
        }
    </script>
</body>
</html>
