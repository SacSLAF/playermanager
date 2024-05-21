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
    $firstname = sanitizeInput($_POST['firstname']);
    $lastname = sanitizeInput($_POST['lastname']);
    $dateofbirth = sanitizeInput($_POST['dateofbirth']);
    $gender = sanitizeInput($_POST['gender']);
    $city = sanitizeInput($_POST['city']);
    $country = sanitizeInput($_POST['country']);
    $phone = sanitizeInput($_POST['phone']);

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            header("Location: index.php?error=fileisnotimage");
            exit();
        }
    }

    // Check file size
    if ($_FILES["img"]["size"] > 500000) {
        header("Location: index.php?error=filetoolarge");
        exit();
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        header("Location: index.php?error=invalidfiletype");
        exit();
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        header("Location: index.php?error=uploadfailed");
        exit();
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            $profile_picture = basename($_FILES["img"]["name"]); // Get the file name
        } else {
            header("Location: index.php?error=uploaderror");
            exit();
        }
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO Users (FirstName, LastName, DateOfBirth, Gender, City, Country, Phone, ProfilePicture) VALUES ('$firstname', '$lastname', '$dateofbirth', '$gender', '$city', '$country', '$phone', '$profile_picture')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../login.php"); 
        exit();
    } else {
        // If insertion fails, redirect to index.php with an error message
        header("Location: index.php?error=dberror");
    }

    // Close database connection
    $conn->close();
}
?>
