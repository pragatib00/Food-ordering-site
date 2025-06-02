<?php include('../config/constants.php')?>

<?php

    session_destroy();

    //unset $_SESSION['user']
    

    header('location:'.SITEURL.'admin/login.php');
?>