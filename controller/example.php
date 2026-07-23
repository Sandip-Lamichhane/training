<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../views/register.php");
    exit;
}

$errors = [];

// Get form data
$name = ($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirm_password = trim($_POST['confirm_password']);

// Store old values
$_SESSION['old'] = [
    'name' => $name,
    'email' => $email
];

// Validation
if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
    $errors[] = "All fields are required.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match.";
}

if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters.";
}

// Check if email already exists
if (empty($errors)) {

    $checkEmail = "SELECT id FROM users WHERE email = ?";

    $stmt = mysqli_prepare($conn, $checkEmail);

    mysqli_stmt_bind_param($stmt, "s", $email);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        $errors[] = "Email already exists.";
    }

    mysqli_stmt_close($stmt);
}

// If there are validation errors
if (!empty($errors)) {

    $_SESSION['errors'] = $errors;

    header("Location: ../views/register.php");
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$insert = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

$stmt = mysqli_prepare($conn, $insert);

mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPassword);

if (mysqli_stmt_execute($stmt)) {

    $_SESSION['success'] = "Registration successful! Please login.";

    unset($_SESSION['old']);

    header("Location: ../views/login.php");
    exit;
} else {

    $_SESSION['errors'] = ["Registration failed. Please try again."];

    header("Location: ../views/register.php");
    exit;
}

mysqli_stmt_close($stmt);
mysqli_close($conn);