<?php
    //chechks whether user is logged in or not
    //Authorization/ACcess Control

    if(!isset($_SESSION['user'])){

        $_SESSION['no-loginmsg']="<div class='failed'>Please login to access Admin Panel </div>";
        header('location:'.SITEURL.'admin/login.php');

    }
?>
