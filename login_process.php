<?php
session_start();

// Retrieve form data
$login_id = $_POST['login'];
$password = $_POST['password'];

// Send form data to Flask backend
$url = 'http://127.0.0.1:5000/login'; // Update with your Flask app URL
$data = array('login' => $login_id, 'password' => $password);

$options = array(
    'http' => array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$response = @file_get_contents($url, false, $context); // Suppress warnings

if ($response === false) {
    // Handle error
    echo "Failed to connect to the backend.";
} else {
    // Process the response from Flask
    $result = json_decode($response, true);
    if (isset($result['message']) && $result['message'] === "Login successful") {
        // Set session variables
        $_SESSION['username'] = $result['user']['username']; // Assuming `username` is the key
        // Redirect the user to landing_page.php upon successful login
        header("Location: landing_page.php");
        exit();
    } else {
        // Redirect back to login.php with error message
        header("Location: login.php?error=1");
        exit();
    }
}
?>
