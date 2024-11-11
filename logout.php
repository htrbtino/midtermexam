<?php
session_start();
session_destroy();
header("Location: index.php"); // Redirect to the login page or home page
exit();
?>
