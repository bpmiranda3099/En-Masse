-- Create the login table with a register_date column and indexes
CREATE TABLE IF NOT EXISTS login (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, 
    user_type ENUM('student', 'teacher') NOT NULL,
    register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (username),
    INDEX (email)
);

-- Create the user_details table with sentence case triggers
CREATE TABLE IF NOT EXISTS user_details (
    user_id INT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    date_of_birth DATE,
    address VARCHAR(255),
    phone_number VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);

-- Drop the trigger if it exists before creating it
DROP TRIGGER IF EXISTS before_user_details_insert;

-- Create a trigger to enforce sentence case on insert
CREATE TRIGGER before_user_details_insert
BEFORE INSERT ON user_details
FOR EACH ROW
SET NEW.first_name = CONCAT(UPPER(LEFT(NEW.first_name, 1)), LOWER(SUBSTRING(NEW.first_name, 2))),
    NEW.last_name = CONCAT(UPPER(LEFT(NEW.last_name, 1)), LOWER(SUBSTRING(NEW.last_name, 2)));

-- Drop the trigger if it exists before creating it
DROP TRIGGER IF EXISTS before_user_details_update;

-- Create a trigger to enforce sentence case on update
CREATE TRIGGER before_user_details_update
BEFORE UPDATE ON user_details
FOR EACH ROW
SET NEW.first_name = CONCAT(UPPER(LEFT(NEW.first_name, 1)), LOWER(SUBSTRING(NEW.first_name, 2))),
    NEW.last_name = CONCAT(UPPER(LEFT(NEW.last_name, 1)), LOWER(SUBSTRING(NEW.last_name, 2)));

-- Create the user_uploaded_tables with cascading deletes
CREATE TABLE IF NOT EXISTS user_uploaded_tables (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    table_name VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);

-- Create the user_sessions table to track login sessions with cascading deletes
CREATE TABLE IF NOT EXISTS user_sessions (
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    login_date DATETIME,
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);

-- Create the login_attempts table with cascading deletes
CREATE TABLE IF NOT EXISTS login_attempts (
    attempt_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    attempt_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    success BOOLEAN,
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);

-- Create the file_uploads table with cascading deletes
CREATE TABLE IF NOT EXISTS file_uploads (
    upload_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    file_name VARCHAR(255) NOT NULL,
    upload_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    success BOOLEAN,
    file_type VARCHAR(50),
    file_size INT,
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);

-- Create the data_table_metrics table with cascading deletes
CREATE TABLE IF NOT EXISTS data_table_metrics (
    metric_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    tables_created INT,
    tables_deleted INT,
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);

-- Create the social_media_accounts table with cascading deletes
CREATE TABLE IF NOT EXISTS social_media_accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    github VARCHAR(255),
    instagram VARCHAR(255),
    facebook VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES login(user_id) ON DELETE CASCADE
);
