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
    $username = ($_POST['username']);
    $password = sanitizeInput($_POST['password']);
// var_dump($username);exit;
    // SQL query to select user based on username
    $sql = "SELECT * FROM users WHERE Username = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if a user with the provided username exists
    if ($result->num_rows > 0) {
        // User found, now verify the password
        // var_dump($user['Username']);exit;
        $user = $result->fetch_assoc();
        // var_dump($user['Username']);exit;
        // $userRole = $user['UserRole'];
        if (password_verify($password, $user['Password'])) {
            // Password is correct, create a session for the user
    // var_dump($username);exit;
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = $user['UserRole'];
            // Redirect to a logged-in area or any other page
            header("Location:../dashboard.php");
            exit();
        } else {
            // Password is incorrect, redirect back to the login page with an error
            header("Location: index.php?error=incorrectpassword");
            exit();
        }
    } else {
        // User with the provided username does not exist, redirect back to the
        // login page with an error
        header("Location: index.php?error=usernotfound");
        exit();
    }

    // Close the statement
    $stmt->close();
}

?>
