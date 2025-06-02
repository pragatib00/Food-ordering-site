<?php include('partials/menu.php');?>

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

        <form  action="" method="POST" enctype="multipart/form-data">

            <table class='tbl-30'>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Enter the food title">

                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description About food"></textarea>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php

                                //code to display categories from db

                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                $result = mysqli_query($conn,$sql);

                                //count rows to check whether we have categories or not

                                $count= mysqli_num_rows($result);
                                if($count>0){

                                    while($row=mysqli_fetch_assoc($result)){

                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title;?> </option>
                                        <?php
                                    }

                                }
                                else{
                                    ?>
                                    <option vlaue='0'>No Category Found</option>
                                    <?php

                                }


                            ?>
                        
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php

        if(isset($_POST['submit'])){

            $title=$_POST['title'];
            $description=$_POST['description'];
            $price=$_POST['price'];
            $category=$_POST['category'];

            if(isset($_POST["featured"])){
                $featured=$_POST["featured"];
            }
            else{
                $featured="No"; //setting default value
            }
            if(isset($_POST['active'])){
                $active=$_POST['active'];
            }
            else{
                $active="No"; //setting default value
            }

            if(isset($_FILES['image']['name'])){

                $image_name=$_FILES['image']['name'];

                //whether image is selected or not

                if($image_name!=''){

                    //rename the image
                    $ext= end(explode('.',$image_name)); //get the extension of image

                    //create new name for image
                    $image_name='Food-Name'.rand(000,9999).'.'.$ext;

                    //Upload the image

                    $src=$_FILES['image']['tmp_name'];
                    $dest='../slider/food/'.$image_name;

                    $upload=move_uploaded_file($src,$dest);

                    //check whether image uploaded

                    if($upload==false){

                        //failed to upload and redirect to add food page

                        $_SESSION['upload']='<div class ="failed">Failed to upload image </div>';
                        header('location:'.SITEURL.'admin/add-food.php');

                        die(); //stop the process

                    }




                   

                }


            }
            else{
                $image_name=''; 
            }

            $sql2 = "INSERT INTO tbl_food SET
            title='" . $title . "',
            description='" . $description . "',
            price=" . $price . ",
            image_name='" . $image_name . "',
            category_id=" . $category . ",
            featured='" . $featured . "',
            active='" . $active . "'
";

            $res2=mysqli_query($conn,$sql2);


            if($res2){

                $_SESSION['add']="<div class ='success'>Food added successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');

            }
            else{

                $_SESSION['add']="<div class ='failed'>Failed to add food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');


            }
            
        }
        
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>