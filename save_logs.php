<?php
// Receive logs from the request
$logs = isset($_POST['logs']) ? $_POST['logs'] : '';

// Define the path to save the logs
$logFilePath = __DIR__ . '/console_logs.txt';

// Save the logs to a text file
file_put_contents($logFilePath, $logs);

// Respond with success message
echo 'Logs saved successfully.';
?>