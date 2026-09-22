<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    $_SESSION['errors'] = ['Please log in to access this page.'];
    header('Location: /workshop/views/login.php');
    exit();
}