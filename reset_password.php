<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Reset Your Password</h2>
        <form action="update_password.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
            <label>New Password</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>
