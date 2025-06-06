<?php include ('../config/constants.php');?>

<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                if(isset($_SESSION['no-loginmsg'])){
                    echo $_SESSION['no-loginmsg'];
                    unset ($_SESSION['no-loginmsg']);
                }
            ?>

            <br>

            <form action="" method="POST">
                <label>Username:</label><br>
                <input type="text" name="username" placeholder="Enter Username"><br>
                <label>Password:</label><br>
                <input type="password" name="password" placeholder="Enter Password"><br>
                <br>
                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>

            <p class="text-center">Created by <a href="#">YumKart</a></p>
        </div>
    </body>

</html>

<?php
    if(isset($_POST['submit'])){

        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password = '$password'";

        $result=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($result);

        if($count==1){

            $_SESSION['login']="<div class='success'>Login Successful </div>";
            $_SESSION['user']=$username; //checks whether user is logged in
            header('location:'.SITEURL.'admin/');
        }
        else{

            $_SESSION['login']="<div class='failed'>Invalid Username and Password. Login Failed </div>";
            header('location:'.SITEURL.'admin/login.php');

        }


    }
?>