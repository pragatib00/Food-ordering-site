<?php 
include('partials/menu.php');

// Handle form submission BEFORE any HTML output
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Handle featured field
    if(isset($_POST["featured"])){
        $featured = $_POST["featured"];
    } else {
        $featured = "No"; // setting default value
    }

    // Handle active field
    if(isset($_POST['active'])){
        $active = $_POST['active'];
    } else {
        $active = "No"; // setting default value
    }

    $image_name = ''; // Default empty image name

    // Handle file upload
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] !== '' && $_FILES['image']['error'] == 0){
        $upload_image_name = $_FILES['image']['name'];
        
        // Get file extension
        $ext = pathinfo($upload_image_name, PATHINFO_EXTENSION);
        
        // Create new name for image
        $image_name = 'Food-Name' . rand(1000, 9999) . '.' . $ext;

        // Upload the image
        $src = $_FILES['image']['tmp_name'];
        $dest = '../slider/food/' . $image_name;

        $upload = move_uploaded_file($src, $dest);

        // Check whether image uploaded
        if($upload == false){
            $_SESSION['upload'] = '<div class="failed">Failed to upload image</div>';
            header('location:' . SITEURL . 'admin/add-food.php');
            exit(); // stop the process
        }
    }

    // Insert into database
    $sql2 = "INSERT INTO tbl_food SET
        title = '$title',
        description = '$description',
        price = $price,
        image_name = '$image_name',
        category_id = $category,
        featured = '$featured',
        active = '$active'";

    $res2 = mysqli_query($conn, $sql2);

    if($res2){
        $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    } else {
        $_SESSION['add'] = "<div class='failed'>Failed to add food</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
        exit();
    }
}
?>

<div class='main'>
    <div class='wrapper'>
        <h1>Add Food</h1>
        <br><br>
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter the food title" required>
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description About food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" step="0.01" min="0" required>
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" accept="image/*">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" required>
                            <option value="">Select Category</option>
                            <?php
                                // Code to display categories from db
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($result);
                                
                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($title); ?></option>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value='0'>No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes" id="featured_yes">
                        <label for="featured_yes">Yes</label>
                        <input type="radio" name="featured" value="no" id="featured_no" checked>
                        <label for="featured_no">No</label>
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" id="active_yes" checked>
                        <label for="active_yes">Yes</label>
                        <input type="radio" name="active" value="no" id="active_no">
                        <label for="active_no">No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>