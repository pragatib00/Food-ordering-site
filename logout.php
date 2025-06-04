<?php
// Start session first
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to home page (adjust the URL as needed)
header('Location: http://localhost/foodweb/');
exit();
?>