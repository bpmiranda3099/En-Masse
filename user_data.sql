-- Create the login table
CREATE TABLE IF NOT EXISTS login (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- hashed password for security
    user_type ENUM('student', 'teacher') NOT NULL
);

-- Create the user_details table
CREATE TABLE IF NOT EXISTS user_details (
    user_id INT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    date_of_birth DATE,
    address VARCHAR(255),
    phone_number VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES login(user_id)
);
