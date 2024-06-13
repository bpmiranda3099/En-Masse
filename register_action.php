<?php
session_start();
include 'execute_sql.php'; // The file containing the executeSQLFile function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection is already established by execute_sql.php
    $user_username = $_POST['username'];
    $user_email = $_POST['email'];
    $user_password = $_POST['password']; // Hashing is recommended
    $user_first_name = $_POST['first_name'];
    $user_last_name = $_POST['last_name'];
    $user_dob = $_POST['date_of_birth'];
    $user_address = $_POST['address'];
    $user_phone = $_POST['phone_number'];
    $user_type = $_POST['user_type'];

    // Check if username or email already exists using a prepared statement
    $check_query = $conn->prepare("SELECT * FROM login WHERE username=? OR email=?");
    $check_query->bind_param("ss", $user_username, $user_email);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "Username or Email already exists!";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Insert into login table (register_date is automatically handled by MySQL)
        $login_query = $conn->prepare("INSERT INTO login (username, email, password, user_type) VALUES (?, ?, ?, ?)");
        $login_query->bind_param("ssss", $user_username, $user_email, $hashed_password, $user_type);

        if ($login_query->execute()) {
            $user_id = $conn->insert_id;

            // Insert into user_details table
            $details_query = $conn->prepare("INSERT INTO user_details (user_id, first_name, last_name, date_of_birth, address, phone_number) VALUES (?, ?, ?, ?, ?, ?)");
            $details_query->bind_param("isssss", $user_id, $user_first_name, $user_last_name, $user_dob, $user_address, $user_phone);

            if ($details_query->execute()) {
                // Redirect to login.php with success parameter
                header("Location: login.php?registration=success");
                exit();
            } else {
                echo "Error: " . $details_query->error;
            }
        } else {
            echo "Error: " . $login_query->error;
        }
    }

    $check_query->close();
    $login_query->close();
    $details_query->close();
}

$conn->close();
?>
