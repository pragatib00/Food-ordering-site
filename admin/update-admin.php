<?php include('partials/menu.php');?>

<div class = "main">
    <div class="wrapper">
        <h1>Update Admin</h1><br><br>

        <?php
            $id=$_GET['id'];

            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            $result=mysqli_query($conn,$sql);

            if($result){

                $count=mysqli_num_rows($result);

                if($count==1){

                    //echo"Admin Available";
                    $row=mysqli_fetch_assoc($result);
                    $fullname= $row['full_name'];
                    $username= $row['username'];

                }
                else{

                    header('location:'.SITEURL.'admin/manage-admin.php');
                }

            }
            
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Fullname: </td>
                    <td>
                        <input type="text" name="fullname" value="<?php echo $fullname?>">
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username?>">
                    </td>
                </tr>
                <br>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php

if(isset($_POST['submit'])){

    //echo"Button clicked";
    $id=$_POST['id'];
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];

    $sql="UPDATE tbl_admin SET 
        full_name='$fullname',
        username= '$username' 
        WHERE id='$id'
    ";

    $result=mysqli_query($conn,$sql);

    if($result){
        $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }
    else{
         $_SESSION['update']="<div class='failed'>Failed to update admin</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

}

?>


<?php include('partials/footer.php');?>