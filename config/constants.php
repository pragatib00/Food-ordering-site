<?php
    //starting session

    session_start();

    define('SITEURL','http://localhost/foodweb/');
    $host = "localhost:3307";
    $username = "root";
    $pass = "";
    $db = "food_order";

    $conn = mysqli_connect($host, $username, $pass, $db);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>