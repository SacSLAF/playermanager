<?php

include '../config.php'; // Include the database configuration file

// Function to sanitize input data
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $role = $_POST['role'];
    $password = sanitizeInput($_POST['password']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.php?error=invalidemail");
        exit();
    }

    // Encrypt the password (you can use any secure hashing algorithm here)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert data into the database
    $sql = "INSERT INTO Users (Username, Email, Password,UserRole) VALUES ('$username', '$email', '$hashedPassword','$role')";

    if ($conn->query($sql) === TRUE) {
        // echo "New record created successfully";
        header("Location:../login.php"); 
        // echo "hi";
        exit();
    } else {
        // If insertion fails, redirect to index.php with an error message
        header("Location: index.php?error=dberror");
        
    }

    // Close database connection
    $conn->close();
}

?>
