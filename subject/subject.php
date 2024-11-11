<?php
session_start();
require_once 'functions.php';

// Protect the page with guard function
guard();

// Handle adding a subject
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_data = [
        'subject_code' => $_POST['subject_code'] ?? '',
        'subject_name' => $_POST['subject_name'] ?? ''
    ];

    // Validate the data
    $errors = validateSubjectData($subject_data);
    $errors = array_merge($errors, checkDuplicateSubjectData($subject_data));

    // If no errors, add the subject to the session
    if (empty($errors)) {
        $_SESSION['subject_data'][] = $subject_data;
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
    <title>Manage Subjects</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Manage Subjects</h2>
        <?= displayErrors($errors) ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="subject_code">Subject Code</label>
                <input type="text" name="subject_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subject_name">Subject Name</label>
                <input type="text" name="subject_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Subject</button>
        </form>

        <h3 class="mt-5">Subject List</h3>
        <ul class="list-group">
            <?php if (isset($_SESSION['subject_data'])): ?>
                <?php foreach ($_SESSION['subject_data'] as $subject): ?>
                    <li class="list-group-item">
                        <?= $subject['subject_code'] . ' - ' . $subject['subject_name'] ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">No subjects added yet.</li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
