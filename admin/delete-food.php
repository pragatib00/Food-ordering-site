<?php

include('../config/constants.php');

if(isset($_GET['id']) && isset($_GET['image_name'])){

    //get id and image name

    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //whether image is available or not. delete only if available
    if($image_name!=""){
        $path="../slider/food/".$image_name;

        //remove image file from folder

        $remove=unlink($path);

        if($remove==false){

            $_SESSION['upload']="<div class='failed'>Failed to remove image file</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            die();

        }
    }
    //delete food from database
    $sql="DELETE FROM tbl_food WHERE id=$id";

    $res=mysqli_query($conn,$sql);

    if($res){

        $_SESSION['delete']="<div class='success'>Food deleted successfully</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else{

        $_SESSION['delete']="<div class='failed'>Failed to delete food</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

    }

    

}
else{

    $_SESSION['unauthorized']="<div class='failed'>Unauthorized access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}

?>