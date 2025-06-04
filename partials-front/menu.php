<?php include('config/constants.php');?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <img src="slider/yumkart-removebg-preview.png" alt="logo" class="imgres">
            </div>
        

        <div class="menu">
            <ul>
                <li><a href="<?php echo SITEURL;?>">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="<?php echo SITEURL;?>categories.php">Category</a></li>
                <li><a href="<?php echo SITEURL;?>foods.php">Foods</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="login.php"><button class="button button-primary">Login</button></a></li>
            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
    </section>