<?php
require_once 'functions.php';

// Redirect if session is active
checkUserSessionIsActive();

// Handle form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Custom validation for required fields (email and password)
    if (empty($email)) {
        $errors[] = "Email Address is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If there are no errors, proceed to check credentials
    if (empty($errors)) {
        $errors = validateLoginCredentials($email, $password);  // Additional validation (e.g., format check)
        if (empty($errors)) {
            if (checkLoginCredentials($email, $password, getUsers())) {
                $_SESSION['email'] = $email;
                $_SESSION['current_page'] = 'dashboard.php';
                header('Location: dashboard.php');
                exit();
            } else {
                $errors[] = "Invalid credentials.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Center the form horizontally and adjust vertical position */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;  /* Align form to the top */
        }

        .login-container {
            width: 100%;
            max-width: 480px;  /* Increased the width by 20% (20% bigger than 400px) */
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30%;  /* Adjust form to be 30% from the top */
        }

        .form-group label {
            font-weight: bold;
            color: #6c757d;  /* Grey color for the label text */
        }

        .btn-primary {
            width: 100%;
        }

        h2 {
            text-align: left;  /* Align the heading to the left */
            margin-bottom: 10px;
            background-color: #f8f9fa;  /* Light grey background */
            color: #6c757d;  /* Grey color for the "Login" text */
            padding: 20px 30px;  /* Increased padding for a fuller header */
            border-radius: 5px 5px 0 0;  /* Rounded corners at the top */
        }

        .alert-danger {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <!-- Display system errors if there are any -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <strong>System Error:</strong> <!-- This is the "System Error" header -->
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>  <!-- Display each error -->
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="login-container">
            <!-- Grey Header with Title -->
            <h2>Login</h2>  <!-- Grey header with "Login" title -->

            <form method="POST" action="">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email ?? '') ?>" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" />
                </div>
                <button type="submit" class="btn btn-primary mt-3">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
