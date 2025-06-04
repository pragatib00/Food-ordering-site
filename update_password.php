<?php
$host = "localhost:3307";
$username = "root";
$pass = "";
$db = "food_order";

$conn = mysqli_connect($host, $username, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Secure hash

    // Find user by token
    $query = "SELECT * FROM tbl_user WHERE reset_token='$token' AND reset_token_expiry > " . time();
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $update = "UPDATE tbl_user SET password='$new_password', reset_token=NULL, reset_token_expiry=NULL WHERE reset_token='$token'";
        mysqli_query($conn, $update);
        echo "Password updated! <a href='login.php'>Login now</a>";
    } else {
        echo "Invalid or expired reset link.";
    }
}
?>
