<?php

include('./config/db.php');

if (isset($_POST['register'])) {

    //store the form data in variables.

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        // check for required fields

        if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
            die('All fields required!');
        }

        //validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Invalid email address.');
        }

        //match the password
        if ($password != $confirm_password) {
            die('Password and confirm password donot match');
        }

        //check for existing email.
        $checkEmail = "SELECT id FROM users WHERE email = ?";

        $stmt = mysqli_prepare($conn, $checkEmail);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            die('Email already exist');
        }

        mysqli_stmt_close($stmt);

        // hash the password

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        

    }
}
