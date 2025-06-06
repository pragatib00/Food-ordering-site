<?php include('partials-front/menu.php');?>

    <section class="food-search text-center" style="position: relative; padding: 13% 0;">
        <!-- Background image with overlay div -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
            <img src="slider/background.jpg" style="width: 100%; height: 100%; object-fit: cover;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.65);">
            </div>
        </div>
    
        <!-- Your existing content -->
        <div class="container">
            <form action="<?php echo SITEURL;?>food-search.php"method="POST">
                <input type="search" name="search" placeholder="search for food">
                <input type="submit" name="submit" value="Search" class="button button-primary">
            </form>
        </div>
    </section>
    
    

    <?php
// Fetch categories from database
$sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 9";
$res = mysqli_query($conn, $sql);

// Create an array to store category data
$categories = array();
if($res == TRUE) {
    while($row = mysqli_fetch_assoc($res)) {
        $categories[] = $row;
    }
}

// Map images to categories (you'll need to adjust this based on your image names)
$category_images = array(
    'Momo' => 'slider/momo.webp',
    'Burger' => 'slider/burger.jpg',
    'Pizza' => 'slider/pizza.jpg',
    'Chowmein' => 'slider/chowmein.jpg',
    'Biryani' => 'slider/biryani.webp',
    'Chicken' => 'slider/chicken.jpg',
    'Dessert' => 'slider/dessert.jpg',
    'Sandwich' => 'slider/sandwich.webp',
    'Boba Tea' => 'slider/boba-tea.avif'
);
?>

<section class="category">
    <div class="container">
        <h2 class="text-center">Explore Foods!!</h2>
        <div class="slider-wrap">
            <img src="slider/left.png" id="backbtn">
            <div class="slider">
                <?php
                $count = 0;
                foreach($categories as $category) {
                    if($count % 3 == 0) echo '<div>'; // Start new row every 3 items
                    
                    // Find matching image for this category
                    $image_src = 'slider/default.jpg'; // default image
                    foreach($category_images as $cat_name => $image_path) {
                        if(stripos($category['title'], $cat_name) !== false) {
                            $image_src = $image_path;
                            break;
                        }
                    }
                ?>
                    <span>
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $category['id']; ?>">
                            <img src="<?php echo $image_src; ?>" alt="<?php echo $category['title']; ?>">
                        </a>
                    </span>
                <?php
                    $count++;
                    if($count % 3 == 0) echo '</div>'; // Close row every 3 items
                }
                
                // Close the last div if needed
                if($count % 3 != 0) echo '</div>';
                ?>
            </div>
            <img src="slider/left.png" id="nextbtn">
        </div>
    </div>
</section>
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Our Menus</h2>

            <?php
                //getting foods from database that are active and featured

                $sql="SELECT * FROM tbl_food WHERE active ='yes' AND featured='yes' LIMIT 6";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                if($count>0){

                    while($row=mysqli_fetch_assoc($res)){

                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>

                                        <div class="food-menu-box">
                                            <div class="food-menu-img">
                                                <?php
                                                    //check whether image available or not

                                                    if($image_name===""){

                                                        echo"<div class='failed'>Image not found</div>";

                                                    }
                                                    else{

                                                        ?>
                                                        <img src="<?php echo SITEURL;?>slider/food/<?php echo $image_name;?>" alt="Chicken Hawain Pizza" class="imgres">
                                                        <?php

                                                    }
                                                ?>
                                                
                                            </div>
                                            <div class="food-menu-description">
                                                <h4><?php echo $title;?></h4>
                                                <p class="food-price">$<?php echo $price;?></p>
                                                <p class="food-data">
                                                    <?php echo $description;?>
                                                </p>
                                                <br>
                                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="button button-primary">Order Now</a>
                                            </div>
                                            
                                        </div>


                        <?php

                    }

                }
                else{

                    echo"<div class='failed'>Food not available</div>";

                }


            ?>
            

           

            <div class="clearfix"></div>
           
            
            
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL;?>foods.php">See All Foods</a>
        </p>
    </section>

    


    <script>
        let slider = document.querySelector('.slider');
            let scrollAmount = slider.clientWidth;
            let autoScrollInterval;

            function autoSlide() {
                autoScrollInterval = setInterval(() => {
                    if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth) {
                        slider.scrollLeft = 0;
                    } else {
                        slider.scrollLeft += scrollAmount;
                    }
                }, 5000);
            }

            autoSlide();

            document.querySelector("#nextbtn").addEventListener("click", () => {
                clearInterval(autoScrollInterval);
                slider.scrollLeft -= scrollAmount;
                autoSlide();
            });

            document.querySelector("#backbtn").addEventListener("click", () => {
                clearInterval(autoScrollInterval);
                slider.scrollLeft += scrollAmount;
                autoSlide();
            });
    </script>

<?php include('partials-front/footer.php');?>