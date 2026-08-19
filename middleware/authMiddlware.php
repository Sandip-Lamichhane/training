<?php

session_start();

if(!isset($_SESSION['user'])){
header('Location: ../login.php');
$_SESSION['success'] = 'Please login to proceed';
exit();
}