<?php
function executeSQLFile($filename, $conn) {
    $sql = file_get_contents($filename);
    if ($conn->multi_query($sql)) {
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());
    }
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enmasse";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute user_data.sql
executeSQLFile('user_data.sql', $conn);
?>
