<?php include('partials-front/menu.php');?>

    <section class="food-search text-center" style="position: relative; padding: 13% 0;">
        <!-- Background image with overlay div -->
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;">
            <img src="slider/bg.webp" style="width: 100%; height: 100%; object-fit: cover;">
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.65);">
            </div>
        </div>
    
        <!-- Your existing content -->
        <div class="container">
            <form action="">
                <input type="search" name="search" placeholder="search for food">
                <input type="submit" name="submit" value="Search" class="button button-primary">
            </form>
        </div>
    </section>

    <section class="category">
        <div class="container">
            <h2 class="text-center">Explore Foods!!</h2>
            <div class="slider-wrap">
            
                <img src="slider/left.png" id="backbtn">
                <div class="slider">
                    <div>
                        <span><img src="slider/momo.webp"></span>
                        <span><img src="slider/burger.jpg"></span>
                        <span><img src="slider/pizza.jpg"></span>
                    </div>
                    <div>
                        <span><img src="slider/chowmein.jpg"></span>
                        <span><img src="slider/biryani.webp"></span>
                        <span><img src="slider/chicken leg fries.jpg"></span>
                    </div>
                    <div>
                        <span><img src="slider/dessert.jpg"></span>
                        <span><img src="slider/sandwich.webp"></span>
                        <span><img src="slider/boba-tea.avif"></span>
                    </div>
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
                                                <a href="order.html" class="button button-primary">Order Now</a>
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
            <a href="#">See All Foods</a>
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