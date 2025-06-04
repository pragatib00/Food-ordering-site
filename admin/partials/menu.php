
<?php include('../config/constants.php');?>

<?php
// Add this at the top of EVERY admin page (after including constants.php)
if(!isset($_SESSION['user'])) {
    $_SESSION['no-loginmsg'] = "<div class='failed'>Please login to access admin panel.</div>";
    header('location:'.SITEURL.'admin/login.php');
    exit();
}
?>



<html>
    <head>
        <title>Food ordering website</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-users.php">Users</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="manage-messages.php">Feedback</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            
        </div>
