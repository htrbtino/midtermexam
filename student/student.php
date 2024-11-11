<?php
session_start();
require_once 'functions.php';

// Protect the page with guard function
guard();

// Handle student registration logic here
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_data = [
        'student_id' => $_POST['student_id'] ?? '',
        'first_name' => $_POST['first_name'] ?? '',
        'last_name' => $_POST['last_name'] ?? ''
    ];

    // Validate the student data
    $errors = validateStudentData($student_data);
    $errors = array_merge($errors, checkDuplicateStudentData($student_data));

    // If no errors, register the student
    if (empty($errors)) {
        $_SESSION['student_data'][] = $student_data;
        header('Location: dashboard.php'); // Redirect back to the dashboard
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Register Student</h2>
        <?= displayErrors($errors) ?>

        <form method="POST">
            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" name="student_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>