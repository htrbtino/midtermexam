<?php
// Start the session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Sample users for login
function getUsers() {
    return [
        ['email' => 'user1@email.com', 'password' => 'password1'],
        ['email' => 'user2@email.com', 'password' => 'password2'],
        ['email' => 'user3@email.com', 'password' => 'password3'],
        ['email' => 'user4@email.com', 'password' => 'password4'],
        ['email' => 'user5@email.com', 'password' => 'password5'],
    ];
}

// Validate login credentials
function validateLoginCredentials($email, $password) {
    $errors = [];
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    return $errors;
}

// Check login credentials
function checkLoginCredentials($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

// Check if session is active
function checkUserSessionIsActive() {
    if (isset($_SESSION['email']) && !empty($_SESSION['email']) && isset($_SESSION['current_page'])) {
        header("Location: " . $_SESSION['current_page']);
        exit();
    }
}

// Guard function for restricting access to authorized users
function guard() {
    if (empty($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
}

// Display errors as HTML list
function displayErrors($errors) {
    if (empty($errors)) return '';
    $output = '<div class="alert alert-danger"><strong>System Errors:</strong><ul>';
    foreach ($errors as $error) {
        $output .= "<li>$error</li>";
    }
    $output .= '</ul></div>';
    return $output;
}

// Render a single error message
function renderErrorsToView($error) {
    if (empty($error)) return '';
    return "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                $error
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
}

// Validate student data
function validateStudentData($student_data) {
    $errors = [];
    if (empty($student_data['student_id'])) $errors[] = "Student ID is required.";
    if (empty($student_data['first_name'])) $errors[] = "First name is required.";
    if (empty($student_data['last_name'])) $errors[] = "Last name is required.";
    return $errors;
}

// Check for duplicate student data
function checkDuplicateStudentData($student_data) {
    if (isset($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $student) {
            if ($student['student_id'] === $student_data['student_id']) {
                return ["Student ID already exists."];
            }
        }
    }
    return [];
}

// Get student data by student ID
function getSelectedStudentIndex($student_id) {
    if (isset($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $index => $student) {
            if ($student['student_id'] === $student_id) {
                return $index;
            }
        }
    }
    return null;
}

// Get student data by index
function getSelectedStudentData($index) {
    return $_SESSION['student_data'][$index] ?? null;
}

// Validate subject data
function validateSubjectData($subject_data) {
    $errors = [];
    if (empty($subject_data['subject_code'])) $errors[] = "Subject code is required.";
    if (empty($subject_data['subject_name'])) $errors[] = "Subject name is required.";
    return $errors;
}

// Check for duplicate subject data
function checkDuplicateSubjectData($subject_data) {
    if (isset($_SESSION['subject_data'])) {
        foreach ($_SESSION['subject_data'] as $subject) {
            if ($subject['subject_code'] === $subject_data['subject_code']) {
                return ["Subject code already exists."];
            }
        }
    }
    return [];
}

// Get subject data by subject code
function getSelectedSubjectIndex($subject_code) {
    if (isset($_SESSION['subject_data'])) {
        foreach ($_SESSION['subject_data'] as $index => $subject) {
            if ($subject['subject_code'] === $subject_code) {
                return $index;
            }
        }
    }
    return null;
}

// Get subject data by index
function getSelectedSubjectData($index) {
    return $_SESSION['subject_data'][$index] ?? null;
}

// Validate attached subject data (at least one subject must be selected)
function validateAttachedSubject($subject_data) {
    if (empty($subject_data)) return ["At least one subject must be selected."];
    return [];
}
?>
