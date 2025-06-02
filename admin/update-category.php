<?php include('partials/menu.php');?>

<div class="main">
    <div class="wrapper">
        <h1>Update Category</h1><br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($count == 1){
                    $row = mysqli_fetch_assoc($result);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else{
                    $_SESSION['no-category'] = "<div class='failed'>Category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else{
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td>
                    <?php
                        if($current_image != ''){
                        ?>
                            <img src="<?php echo SITEURL . 'slider/category/' . $current_image; ?>" width="100px">
                        <?php
                        }
                        else{
                            echo "<div class='failed'>Image not Added</div>";
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes" <?php if($featured=="Yes"){echo "checked";} ?>>Yes
                    <input type="radio" name="featured" value="No" <?php if($featured=="No"){echo "checked";} ?>>No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" name="active" value="Yes" <?php if($active=="Yes"){echo "checked";} ?>>Yes
                    <input type="radio" name="active" value="No" <?php if($active=="No"){echo "checked";} ?>>No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>

    <?php
        if(isset($_POST['submit'])){
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check whether image is selected or not
            if(isset($_FILES['image']['name'])){
                $image_name = $_FILES['image']['name'];

                // Check whether image is available or not
                if($image_name != ""){
                    // Upload new image
                    
                    // Auto rename our image
                    // Get the extension of our image like jpg, png, webp
                    $parts = explode('.', $image_name);
                    $ext = end($parts);

                    // Rename the image
                    $image_name = "food_category_".rand(000,999).'.'.$ext; // food_category_090.jpg

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = '../slider/category/'.$image_name;

                    // Upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    // Checking whether the image is uploaded
                    // If image is not uploaded then we will stop the process and redirect with error message
                    if($upload == false){
                        $_SESSION['upload'] = "<div class='failed'>Failed to upload image</div>";
                        header('location:'.SITEURL.'admin/update-category.php?id='.$id);
                        // Stop the process
                        die();
                    }

                    // Remove current image if available
                    if($current_image != ''){
                        $path = "../slider/category/".$current_image;
                        $remove = unlink($path);

                        // Check whether the image is removed or not
                        if($remove == false){
                            $_SESSION['failed-remove'] = "<div class='failed'>Failed to remove current image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }
                } 
                else {
                    $image_name = $current_image;
                }
            } 
            else {
                $image_name = $current_image;
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id=$id";

            $res = mysqli_query($conn, $sql2);

            if($res){
                $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                $_SESSION['update'] = "<div class='failed'>Failed to update category</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
    ?>
    </div>
</div>

<?php include('partials/footer.php');?>