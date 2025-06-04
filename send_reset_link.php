<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$host = "localhost:3307";
$username = "root";
$pass = "";
$db = "food_order";

$con = mysqli_connect($host, $username, $pass, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    // Check if email exists
    $query = "SELECT * FROM tbl_user WHERE email='$email'";
    $result = mysqli_query($con, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $token = bin2hex(random_bytes(32)); // Generate a unique token
        $expiry_time = date("Y-m-d H:i:s", strtotime('+1 hour')); // Token expires in 1 hour
        $update = "UPDATE tbl_user SET reset_token='$token', reset_token_expiry='$expiry_time' WHERE email='$email'";
        mysqli_query($con, $update);
        
        // Add this line here for testing
        echo "<a href='http://localhost/foodweb/reset_password.php?token=$token'>Reset Password Link</a>";
        
        // Send reset email
        $reset_link = "http://localhost/foodweb/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the link to reset your password: $reset_link";
        $headers = "From: no-reply@yumkart.com";
        
    } else {
        echo "Email not found.";
    }
}
?>