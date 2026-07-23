<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include ('../config/db.php');

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header('Location: ../views/login.php');
}

$errors = [];

//get form data 

$email = trim($_POST['email']);
$password = trim($_POST['password']);

$_SESSION['old'] = [
    'email' => $email
];

//validation
if(empty($email) || empty($password)){
    $errors = 'All fields are required';
}

//validate email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors = 'Please enter a valid email address';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../views/login.php");
    exit;
}

// Check if user exists
$query = "SELECT id, name, email, password FROM users WHERE email = ?";

$stmt = mysqli_prepare($conn, $query);

mysqli_stmt_bind_param($stmt, "s", $email);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);

if (!$user) {

    $_SESSION['errors'] = ["Invalid email or password."];
    header("Location: ../views/login.php");
    exit;
}

// Verify password
if (!password_verify($password, $user['password'])) {

    $_SESSION['errors'] = ["Invalid email or password."];
    header("Location: ../views/login.php");
    exit;
}

//  Login successful
$_SESSION['user'] = [
    'id' => $user['id'],
    'name' => $user['name'],
    'email' => $user['email']
];

$_SESSION['success'] = "Login successful!";

unset($_SESSION['old']);

header("Location: ../views/dashboard.php");
exit;

mysqli_stmt_close($stmt);
mysqli_close($conn);