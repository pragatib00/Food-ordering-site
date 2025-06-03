<?php include('partials/menu.php');?>

<?php

if(isset($_GET['id'])){

    $id=$_GET['id'];

    $sql2="SELECT * FROM tbl_food WHERE id=$id";
    $res2=mysqli_query($conn,$sql2);

    $row=mysqli_fetch_assoc($res2);

    $title=$row['title'];
    $description=$row['description'];
    $price=$row['price'];
    $current_img=$row['image_name'];
    $current_category=$row['category_id'];
    $featured=$row['featured'];
    $active=$row['active'];


}
else{
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>
<div class='main'>
    <div class='wrapper'>
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type='text' name="title" value ="<?php echo $title ;?>">

                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols='30' rows='5'><?php echo $description;?></textarea>
                        
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type='number' name='price' value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                       <?php
                        if($current_img===""){

                            echo"<div class='failed'>Image not available</div>";


                        }
                        else{

                            ?>
                            <img src="<?php echo SITEURL;?>slider/food/<?php echo $current_img;?>" width="100px">
                            <?php

                        }
                       ?>
                    </td>
                    
                </tr>
                <tr>
                    <td>Select New Image:</td>
                    <td>
                        <input type='file' name='image'>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name='category'>

                            <?php
                                $sql="SELECT * FROM tbl_category WHERE active='yes'";
                                $res=mysqli_query($conn,$sql);
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $category_title=$row['title'];
                                        $category_id=$row['id'];
                                        $selected = ($current_category == $category_id) ? 'selected="selected"' : '';
                                        ?>
                                        <option value="<?php echo $category_id; ?>" <?php echo $selected; ?>>
                                            <?php echo $category_title; ?>
                                        </option>
                                        <?php
                                    }

                                }
                                else{
                                    echo "<option value='0'>Category Not Available</option>";
                                }

                                
                            ?>
                            <option value='0'>Test</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                    <input <?php if($featured=='yes'){echo "checked ";}?>type='radio' name='featured' value='yes'>Yes
                    <input <?php if($featured=='no'){echo "checked ";}?>type='radio' name='featured' value='no'>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                    <input <?php if($active=='yes'){echo "checked ";}?>type='radio' name='active' value='yes'>Yes
                    <input <?php if($active=='no'){echo "checked ";}?>type='radio' name='active' value='no'>No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type='hidden' name='id' value='<?php echo $id;?>'>
                        <input type='hidden' name='current_image' value='<?php echo $current_img;?>'>
                        <input type='submit' name='submit' value='Update Food' class='btn-secondary'>
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                //echo"Button Clicked";

                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_img=$_POST['current_image'];
                $category=$_POST['category'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !== "" && $_FILES['image']['error'] == 0){

                    $image_name=$_FILES['image']['name'];

                    if($image_name===""){

                        $ext=end(explode('.',$image_name));
                        $image_name="Food-Name".rand(0000,9999).'.'.$ext;

                        $src=$_FILES['image']['tmp_name'];
                        $dest="../slider/food/".$image_name;

                        $upload=move_uploaded_file($src,$dest);

                        if($upload==false){
                            $_SESSION['upload']="<div class='failed'>Failed to upload new image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }

                        if($current_img!=""){

                            $remove_path="../slider/food/".$current_img;

                            $remove=unlink($remove_path);

                            if($remove==false){

                                $_SESSION['remove-failed']="<div class='failed'>Failed to remove current image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();

                            }
                        }


                    }

                }
                else{

                    $image_name=$current_img;

                }
                $sql3="UPDATE tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = '$category',
                featured = '$featured',
                active = '$active'
                WHERE id = $id
                ";

                $res3=mysqli_query($conn,$sql3);

                if($res3==true){

                    $_SESSION['update']="<div class='success'>Food updated successfully</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');

                }
                else{

                    $_SESSION['update']="<div class='error'>Failed to update food </div>";
                    header('location:'.SITEURL.'admin/manage-food.php');


                }

                
            }
        ?>

    </div>
</div>
<?php include('partials/footer.php');?>





