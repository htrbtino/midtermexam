<?php
require_once 'functions.php';

// Protect the page with guard function
guard();

// Check if the user is logged in
if (isset($_SESSION['email'])) {
    // Welcome message
    $welcomeMessage = "Welcome to the System: " . htmlspecialchars($_SESSION['email']);
} else {
    $welcomeMessage = "Welcome to the System";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        /* Container for the welcome message and logout button */
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        .welcome-message {
            font-size: 3rem;
            color: black;
        }

        .logout-button {
            font-size: 1rem;
        }

        .container {
            margin-top: 20px;
        }

        .dashboard-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .section {
            width: 48%;
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .section h3 {
            margin-bottom: 15px;
            color: #6c757d;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Header section with welcome message and logout button -->
    <div class="header-container">
        <div class="welcome-message">
            <?php echo $welcomeMessage; ?>
        </div>
        <a href="logout.php" class="btn btn-danger logout-button">Logout</a>
    </div>

    <div class="container">
        <!-- Dashboard content -->
        <div class="dashboard-container">
            <!-- Left section: Add a Subject -->
            <div class="section">
                <h3>Add a Subject</h3>
                <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                <a href="add_subject.php" class="btn btn-primary">Add Subject</a>
            </div>

            <!-- Right section: Register a Student -->
            <div class="section">
                <h3>Register a Student</h3>
                <p>This section allows you to register a new student in the system. Click the button to proceed with the registration process.</p>
                <a href="register_student.php" class="btn btn-primary">Register</a>
            </div>
        </div>
    </div>

</body>
</html>
