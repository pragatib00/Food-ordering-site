<?php include('partials/menu.php');?>


<div class="main">
    <div class="wrapper">
        <h1>Add Admin</h1><br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" placeholder="Enter Your Name" name="fullname">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" placeholder="Your username" name="username">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" placeholder="Your password" name="password">
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                    
                </tr>
            </table>

        </form>
    </div>

</div>

<?php include('partials/footer.php');?>

<?php

    if(isset($_POST['submit']))
    {
        $full_name=$_POST['fullname'];
        $username=$_POST['username'];
        $password= md5($_POST['password']);

        $sql="INSERT INTO tbl_admin SET
            full_name= '$full_name',
            username = '$username',
            password = '$password'
        ";

         

        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['add']="<div class='success'>Admin added successfully </div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            $_SESSION['add']="<div class= 'failed'>Failed to add admin </div>";
            header("location:".SITEURL.'admin/add-admin.php');
        }
        

        
    }
   
?>