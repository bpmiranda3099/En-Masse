<?php
// Start the session
session_start();

// Send request to Flask logout endpoint
$url = 'http://127.0.0.1:5000/logout';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Redirect to login page
header("Location: login.php");
exit();
?>

<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Flask logout endpoint URL
$url = 'http://127.0.0.1:5000/logout'; // Change to your Flask server's URL

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); // Verify SSL certificate
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // Check the existence of a common name and also verify that it matches the hostname provided
curl_setopt($ch, CURLOPT_CAINFO, '/certs/cacert.pem'); // Path to CA certificate bundle

// Execute cURL request
$response = curl_exec($ch);

// Check if the request was successful and the response is valid JSON
if ($response === false || !json_decode($response)) {
    // If request failed or response is not JSON, handle the error
    echo "Error: Logout failed.";
    // Log the error or take appropriate action
} else {
    // Decode the JSON response
    $result = json_decode($response, true);

    // Check if the response indicates successful logout
    if (isset($result['message']) && $result['message'] === 'Logout successful') {
        // If logout successful, destroy session
        session_destroy();
    } else {
        // If logout failed, handle the error
        echo "Error: Logout failed.";
        // Log the error or take appropriate action
    }
}

// Close cURL session
curl_close($ch);

// Redirect to the login page
header("Location: login.php");
exit();
?>
