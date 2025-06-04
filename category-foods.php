<?php include('partials-front/menu.php');?>

<?php
    //check whether id is passed 
    if(isset($_GET['category_id'])){
        $category_id = $_GET['category_id'];
        //get the category title based on category_id
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $category_title = $row['title'];
    }
    else{
        header('location:'.SITEURL);
    }
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center" style="position: relative; padding: 13% 0;">
    <!-- Background image with overlay div -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
        <img src="slider/bg.webp" style="width: 100%; height: 100%; object-fit: cover;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.65);">
        </div>
    </div>
    <div class="container">
        <h2 style="color: white;"class="animated-heading">Foods on <a href="#" class="text-white animated-heading">"<?php echo $category_title;?>"</a></h2>
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Our Menus</h2>

        <?php
            //getting food based on selected category
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            
            if($count2 > 0){
                while($row2 = mysqli_fetch_assoc($res2)){
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                                if($image_name == ""){
                                   
                                    echo"<div class='failed'>Image not available</div>";
                                
                                }
                                else{
                                    
                                    ?>
                                    <img src="<?php echo SITEURL;?>slider/food/<?php echo $image_name;?>" class="imgres">
                                    <?php
                                }
                            ?>
                        </div>
                        <div class="food-menu-description">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-data">
                                <?php echo $description; ?>
                            </p>
                            <br>
                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $row2['id']; ?>" class="button button-primary">Order Now</a>
                        </div>
                    </div>
                    
                    <?php
                }
            }
            else{
                echo "<div class='failed'>Food not available</div>";
            }
        ?>
        <div class="clearfix"></div>
    </div>
</section>

<?php include('partials-front/footer.php');?>