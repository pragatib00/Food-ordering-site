<?php include('partials-front/menu.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center" style="position: relative; padding: 13% 0;">
        <!-- Background image with overlay div -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
            <img src="slider/menuback.jpg" style="width: 100%; height: 100%; object-fit: cover;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.45);">
            </div>
        </div>
        <div class="container">

            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="button button-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Our Menus</h2>
            
            <?php
                //display food that are active

                $sql="SELECT * FROM tbl_food WHERE active='yes'";

                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                if($count>0){

                    while($row=mysqli_fetch_assoc($res)){

                        $id=$row['id'];
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $image_name=$row['image_name'];

                        ?>
                             <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        //check whether image available or not

                                        if($image_name==""){

                                            echo"<div class='failed'>Image not available</div>";

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
                                    <p class="food-price">$<?php echo $price?></p>
                                    <p class="food-data">
                                        <?php echo $description?>
                                    </p>
                                    <br>
                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="button button-primary">Order Now</a>
                                </div>
               
                            </div>
                            
                        <?php
                    }


                }
                else{

                    echo"<div class = 'failed'>Food not available</div>";
                }
            ?>
    
           
          
    
            <div class="clearfix"></div>
    
        </div>
    </section>
   <?php include('partials-front/footer.php');?>