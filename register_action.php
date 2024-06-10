<?php
session_start();
include 'execute_sql.php'; // The file containing the executeSQLFile function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection is already established by execute_sql.php
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password']; // No need for hashing here, but it is recommended
    $user_first_name = $_POST['first_name'];
    $user_last_name = $_POST['last_name'];
    $user_dob = $_POST['date_of_birth'];
    $user_address = $_POST['address'];
    $user_phone = $_POST['phone_number'];
    $user_type = $_POST['user_type'];

    // Check if username or email already exists
    $check_query = "SELECT * FROM login WHERE username='$user_username' OR email='$user_email'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        // Insert into login table (register_date is automatically handled by MySQL)
        $login_query = "INSERT INTO login (username, email, password, user_type) VALUES ('$user_username', '$user_email', '$user_password', '$user_type')";
        if ($conn->query($login_query) === TRUE) {
            $user_id = $conn->insert_id;
            // Insert into user_details table
            $details_query = "INSERT INTO user_details (user_id, first_name, last_name, date_of_birth, address, phone_number) VALUES ('$user_id', '$user_first_name', '$user_last_name', '$user_dob', '$user_address', '$user_phone')";
            if ($conn->query($details_query) === TRUE) {
                // Redirect to login.php with success parameter
                header("Location: login.php?registration=success");
                exit();
            } else {
                echo "Error: " . $details_query . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $login_query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
