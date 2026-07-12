<?php

// Include Database Connection
include("../config/database.php");

// Check if the form is submitted
if (isset($_POST['register'])) {

    // Get form data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $contact_number = trim($_POST['contact_number']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // -------------------------
    // Validation
    // -------------------------

    // Check if required fields are empty
    if (empty($fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All required fields are mandatory.");
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid Email Address.");
    }

    // Contact Number Validation (Optional)
    if (!empty($contact_number) && !preg_match('/^[0-9]{10}$/', $contact_number)) {
        die("Contact number must be 10 digits.");
    }

    // Password Match
    if ($password != $confirm_password) {
        die("Password and Confirm Password do not match.");
    }

    // -------------------------
    // Check Duplicate Email
    // -------------------------

    $checkEmail = "SELECT id FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $checkEmail);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {

        mysqli_stmt_close($stmt);

        die("Email already exists.");
    }

    mysqli_stmt_close($stmt);

    // -------------------------
    // Hash Password
    // -------------------------

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // -------------------------
    // Insert User
    // -------------------------

    $insertQuery = "INSERT INTO users
    (
        fullname,
        email,
        contact_number,
        password
    )
    VALUES
    (
        ?, ?, ?, ?
    )";

    $stmt = mysqli_prepare($conn, $insertQuery);

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $fullname,
        $email,
        $contact_number,
        $hashedPassword
    );

    if (mysqli_stmt_execute($stmt)) {

        echo "Registration Successful.";

        // OR

        // header("Location: ../views/login.php");
        // exit();

    } else {

        echo "Registration Failed.";
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
} else {

    echo "Invalid Request.";
}
