<?php
include('config/constants.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // secure hash

    $sql = "INSERT INTO tbl_user (firstname, lastname, email, mobile, password)
            VALUES ('$firstname', '$lastname', '$email', '$mobile', '$hashedPassword')";

    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Login user immediately
        $_SESSION['user_id'] = mysqli_insert_id($conn);
        $_SESSION['user_name'] = $firstname . ' ' . $lastname;
        $_SESSION['user_email'] = $email;

        // Optional cookie
        setcookie('user_email', $email, time() + (86400 * 7), "/");

        echo "<script>window.location.replace('order.php');</script>";
        echo "<meta http-equiv='refresh' content='0;url=order.php'>";
        header("Location: order.php");
        exit();
    } else {
        echo "<script>alert('Signup failed. Please try again.');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div id="container" class="container">
        <div id="menu">
            <div class="brand-logo">
                <a href="index.html"><img src="slider/yumkart-removebg-preview.png" alt="logo"></a>
            </div>
            <div class="menu-item">
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Your Orders</a>
                <a href="#">Wishlist</a>
                <a href="#">Address</a>
                <a href="#">Help</a>
            </div>
        </div>

        <div class="signup-container">
            <h2>Sign Up to YumKart</h2>
            <form action="signup.php" method="POST">
                <label>First Name</label>
                <input type="text" placeholder="Your Name" name="firstname" required>
                <br>
                <label>Last Name</label>
                <input type="text" placeholder="Your Name" name="lastname">
                <br>
                <label>Email</label>
                <input type="email" id="email" placeholder="someone@gmail.com" name="email" required>
                <br>
                <label>Mobile Number</label>
                <input type="text" placeholder="98XXXXXXXX" name="mobile" required>
                <br>
                <label>Password</label>
                <input type="password" id="password" placeholder="********" name="password" required>
                <br>
                <button type="submit" class="signup-button" value="Sign Up">Sign Up</button>
            </form>
        </div>
    </div>
</body>

</html>