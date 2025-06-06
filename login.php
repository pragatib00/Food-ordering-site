<?php include('config/constants.php');

$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_input = mysqli_real_escape_string($conn,$_POST['password']);

    $sql = "SELECT * FROM tbl_user WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $hashed_password = $row['password'];

        if (password_verify($password_input, $hashed_password)) {
            // Set sessions to match what dashboard.php expects
            $_SESSION['user_id'] = $row['id'];  // Add user ID
            $_SESSION['user_name'] = $row['firstname'] . ' ' . $row['lastname'];
            $_SESSION['user_email'] = $row['email'];
            
            header("Location: dashboard.php");
            exit;
        
        } else {
            $loginMessage = "<span style='color:red;'>Invalid email or password.</span>";
        }
    } else {
        $loginMessage = "<span style='color:red;'>Invalid email or password.</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | YumKart</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <!-- Desktop View -->
    <div id="container" class="container">
        <div id="menu">
            <div class="brand-logo">
                <a href="<?php echo SITEURL;?>"><img src="slider/yumkart-removebg-preview.png" alt="logo"></a>
            </div>
            <div class="menu-item">
                <a href="<?php echo SITEURL;?>about.php">About</a>
                <a href="<?php echo SITEURL;?>categories.php">Category</a>
                <a href="<?php echo SITEURL;?>foods.php">Foods</a>
                <a href="<?php echo SITEURL;?>contact.php">Contact</a>

                
            </div>
        </div>

        <div class="login-container">
            <h2>Login to YumKart</h2>
            <form action="" method="POST" id="loginForm">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Enter your email" name="email" required>
                <br>
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="********" name="password" required>
                <br>
                <?php echo $loginMessage; ?><br><br>
                <button type="submit" class="login-button">Login</button>
            </form>
            <p><a href="forget_password.php">Forgot Password?</a></p>
            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
        </div>

        <div></div> <!-- Layout spacing -->
    </div>

    <!-- Mobile View -->
    <div id="mobile-view" class="mobile-view">
        <div class="mobile-top">
            <div class="logo-box">
                <img src="/slider/yumkartt.png" alt="logo">
            </div>
        </div>
</body>

</html>
