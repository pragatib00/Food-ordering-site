<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Forgot Password</h2>
        <form action="send_reset_link.php" method="POST">
            <label>Email</label>
            <input type="text" name="email" required>
            <br>
            <button type="submit">Send Reset Link</button>
        </form>
    </div>
</body>

</html>