<?php include('../config/constants.php')?>

<?php
    
    if(isset($_GET['id']) && isset($_GET['image_name'])){

        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove the physical image file if available

        if($image_name !=''){

            $path='../slider/category/'.$image_name;
            $remove=unlink($path);

            if($remove==false){

                $_SESSION['remove']="<div class='failed'>Failed to remove the image</div>";

                header('location:'.SITEURL.'admin/manage-category.php');

                die();
            }

        }

        //Delete data from database

        $sql="DELETE FROM tbl_category WHERE id=$id";

        $result=mysqli_query($conn,$sql);

        if($result){
            $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');

        }
        else{
            $_SESSION['delete']="<div class='failed'>Failed to delete category</div>";
            header('location:'.SITEURL.'admin/manage-category.php');


        }

        //redirect to manage category page

    }
    else{

        header('location:'.SITEURL.'admin/manage-category.php');

    }
?>