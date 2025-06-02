<?php include ('partials/menu.php');?>

<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1><br><br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>


        <form action="" method="POST"enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                   <td>Select Image: </td>
                   <td>
                        <input type="file" name="image">
                   </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
               
                        
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){

                $title=$_POST['title'];

                //for radio type we need to check whether button is selected
                
                if(isset($_POST['featured'])){

                    $featured=$_POST['featured'];
                }
                else{
                    $featured="No";
                }
                if(isset($_POST['active'])){

                    $active=$_POST['active'];
                }
                else{
                    $active="No";
                }

                // print_r($_FILES['image']);

                // die();

                if(isset($_FILES['image']['name'])){
                    //upload image only if image is available

                    if($image_name !='')
                {

                    

                    $image_name=$_FILES['image']['name'];

                    //auto rename our image
                    //get the extension of our image like jpg, png, webp

                    $ext=end(explode('.',$image_name));

                    //rename the image

                    $image_name= "food_category_".rand(000,999).'.'.$ext; //food_category_090.jpg


                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path='../slider/category/'.$image_name;

                    //upload image

                    $_upload=move_uploaded_file($source_path,$destination_path);

                    //checking whether the image is uploaded
                    //if image is not uploaded then we will stop the process and redirect with error message

                    if($_upload==false){

                        $_SESSION['upload']="<div class='failed'>Failed to upload image</div>";
                        header('location:'.SITEURL.'admin/add-category.php');

                        //stop the process

                        die();
                    }

                }

                }
                else{

                    $image_name="";
                }

                $sql="INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                $result=mysqli_query($conn,$sql);

                if($result){

                    $_SESSION['add']="<div class ='success'>Category added successfully</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else{

                    $_SESSION['add']="<div class ='failed'>Failed to add category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');

                }

            }
           
        ?>
    </div>
</div>


<?php include ('partials/footer.php');?>