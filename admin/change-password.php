<?php include('partials/menu.php');?>

<div class="main">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>

        <?php
            if(isset($_GET['id'])){

                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current password</td>
                    <td>
                        <input type="password" name="old_password" placeholder="Current password">
                    </td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Retype New password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type = "submit" name="submit" value = "Change Password" class="btn-secondary">
                    </td>

            </table>
        </form>
    </div>
</div>

<?php

if(isset($_POST['submit'])){

    //echo"button clicked";

    $id=$_POST['id'];
    $current_pass=md5($_POST['old_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    $sql= "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_pass'";

    $result=mysqli_query($conn,$sql);

    if($result)
    {

        $count=mysqli_num_rows($result);

        if($count==1){

            //echo 'User Found';
    

            if($new_password==$confirm_password){
                //echo "password match";

                $sql2="UPDATE tbl_admin SET
                password = '$new_password'
                WHERE id=$id";

                $res2=mysqli_query($conn,$sql2);

                if($res2){
                    $_SESSION['change-pwd']="<div class='success'>Password changed successfully</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');


                }
                else{
                    $_SESSION['change-pwd']="<div class='failed'>Failed to change password.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');

                }

            }
                
            else{
                    $_SESSION['not-match']="<div class='failed'>Password didn't match</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
        }
            else{
                 $_SESSION['not-match']="<div class='failed'>Password didn't match</div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');

            }

        }
        else{
            $_SESSION['user-not-found']="<div class='failed'>User Not Found</div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }



?>

<?php include('partials/footer.php');?>