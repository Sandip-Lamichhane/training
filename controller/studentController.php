<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/../config/db.php';

// Determine the requested action
$action = $_POST['action'] ?? $_GET['action'] ?? '';

// Default to create if form was submitted via POST without an explicit action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($action)) {
    $action = 'create';
}

switch ($action) {
    case 'create':
        handleCreateStudent($conn);
        break;

    case 'update':
        handleUpdateStudent($conn);
        break;

    case 'delete':
        handleDeleteStudent($conn);
        break;

    default:
        // Redirect unknown requests to students list
        header("Location: ../views/student/index.php");
        exit();
}

/**
 * Handle adding a new student
 */
function handleCreateStudent($conn) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../views/student/addStudent.php");
        exit();
    }

    $firstName   = trim($_POST['first_name'] ?? '');
    $lastName    = trim($_POST['last_name'] ?? '');
    $dob         = trim($_POST['dob'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $parentName  = trim($_POST['parents_name'] ?? '');

    // Retain input for re-populating the form in case of errors
    $_SESSION['old'] = [
        'first_name'   => $firstName,
        'last_name'    => $lastName,
        'dob'          => $dob,
        'email'        => $email,
        'phone'        => $phone,
        'parents_name' => $parentName,
    ];

    $errors = [];

    // Validation
    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }
    if (empty($dob)) {
        $errors[] = "Date of birth is required.";
    }
    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($parentName)) {
        $errors[] = "Parent's / Guardian's name is required.";
    }

    // Return with errors if any validation failed
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../views/student/addStudent.php");
        exit();
    }

    // Insert student record
    $sql = "INSERT INTO students (first_name, last_name, dob, email, phone, parents_name)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $_SESSION['errors'] = ["Database error: " . $conn->error];
        header("Location: ../views/student/addStudent.php");
        exit();
    }

    $stmt->bind_param("ssssss", $firstName, $lastName, $dob, $email, $phone, $parentName);

    if ($stmt->execute()) {
        unset($_SESSION['old']);
        $_SESSION['success'] = "Student '{$firstName} {$lastName}' added successfully!";
        $stmt->close();
        header("Location: ../views/student/index.php");
        exit();
    } else {
        $_SESSION['errors'] = ["Failed to save student: " . $stmt->error];
        $stmt->close();
        header("Location: ../views/student/addStudent.php");
        exit();
    }
}

/**
 * Handle updating an existing student
 */
function handleUpdateStudent($conn) {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header("Location: ../views/student/index.php");
        exit();
    }

    $id          = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $firstName   = trim($_POST['first_name'] ?? '');
    $lastName    = trim($_POST['last_name'] ?? '');
    $dob         = trim($_POST['dob'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $parentName  = trim($_POST['parents_name'] ?? '');

    if ($id <= 0) {
        $_SESSION['errors'] = ["Invalid student ID."];
        header("Location: ../views/student/index.php");
        exit();
    }

    $errors = [];

    if (empty($firstName)) {
        $errors[] = "First name is required.";
    }
    if (empty($lastName)) {
        $errors[] = "Last name is required.";
    }
    if (empty($dob)) {
        $errors[] = "Date of birth is required.";
    }
    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    if (empty($phone)) {
        $errors[] = "Phone number is required.";
    }
    if (empty($parentName)) {
        $errors[] = "Parent's / Guardian's name is required.";
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../views/student/editStudent.php?id=" . $id);
        exit();
    }

    // Update query
    $sql = "UPDATE students 
            SET first_name = ?, last_name = ?, dob = ?, email = ?, phone = ?, parents_name = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $_SESSION['errors'] = ["Database error: " . $conn->error];
        header("Location: ../views/student/editStudent.php?id=" . $id);
        exit();
    }

    $stmt->bind_param("ssssssi", $firstName, $lastName, $dob, $email, $phone, $parentName, $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Student '{$firstName} {$lastName}' updated successfully!";
        $stmt->close();
        header("Location: ../views/student/index.php");
        exit();
    } else {
        $_SESSION['errors'] = ["Failed to update student: " . $stmt->error];
        $stmt->close();
        header("Location: ../views/student/editStudent.php?id=" . $id);
        exit();
    }
}

/**
 * Handle deleting a student
 */
function handleDeleteStudent($conn) {
    // Accept either POST (preferred for safety) or GET
    $id = 0;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    } else {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    }

    if ($id <= 0) {
        $_SESSION['errors'] = ["Invalid student record ID for deletion."];
        header("Location: ../views/student/index.php");
        exit();
    }

    // First fetch the student's name for a friendly flash notification
    $nameQuery = "SELECT first_name, last_name FROM students WHERE id = ?";
    $nameStmt = $conn->prepare($nameQuery);
    $studentName = "Student #{$id}";
    if ($nameStmt) {
        $nameStmt->bind_param("i", $id);
        $nameStmt->execute();
        $res = $nameStmt->get_result();
        if ($row = $res->fetch_assoc()) {
            $studentName = $row['first_name'] . ' ' . $row['last_name'];
        }
        $nameStmt->close();
    }

    // Delete record
    $sql = "DELETE FROM students WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        $_SESSION['errors'] = ["Database error: " . $conn->error];
        header("Location: ../views/student/index.php");
        exit();
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "{$studentName} has been deleted successfully.";
    } else {
        $_SESSION['errors'] = ["Could not delete student: " . $stmt->error];
    }

    $stmt->close();
    header("Location: ../views/student/index.php");
    exit();
}