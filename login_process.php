<?php
session_start(); // Ensure session is started at the beginning

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $login_id = $_POST['login'];
    $password = $_POST['password'];

    // Prepare data to send to the Flask endpoint
    $data = array(
        'login' => $login_id,
        'password' => $password
    );
    $data_json = json_encode($data);

    // Initialize cURL session
    $ch = curl_init('http://localhost:5000/login'); // Replace with your Flask server address
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);

    // Execute the POST request
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Handle the response based on HTTP status code
    if ($http_code == 200) {
        // Successful login
        $response_data = json_decode($response, true);
        $_SESSION['username'] = $response_data['user']['username'];
        header("Location: landing_page.php");
        exit();
    } elseif ($http_code == 401) {
        // Invalid login credentials
        header("Location: login.php?error=1");
        exit();
    } else {
        // Other errors
        echo "An error occurred: " . $response;
    }
}
?>