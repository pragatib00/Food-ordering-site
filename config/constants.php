<?php
// Start session only if not already started
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!defined('SITEURL')) {
    define('SITEURL', 'http://localhost/foodweb/');
}         

$host = "localhost:3307";
$username = "root";
$pass = "";
$db = "food_order";

// Only create connection if it doesn't exist
if (!isset($conn)) {
    $conn = mysqli_connect($host, $username, $pass, $db);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
}
?>