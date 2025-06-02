<?php

include ('../config/constants.php');

$id=$_GET['id'];

$sql="DELETE FROM tbl_admin WHERE id=$id";

$result=mysqli_query($conn,$sql);

if($result){

    //echo "Admin Deleted";
    $_SESSION['delete'] = "<div class='success'>Admin deleted successfully</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');

}
else{

    //echo "Failed to delete Admin";
    $_SESSION['delete']="<div class='failed'>Failed to delete. Try again later</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');


}


?>
