<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center animated-heading">Explore Foods</h2>

            <?php

                //display all the categories that are active
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                $res = mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                if($count>0){

                    while($row=mysqli_fetch_assoc($res)){

                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                        
                         <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">

                          <div class="box float-container">
                            <?php
                                if($image_name==""){

                                    echo "<div class ='failed'>Image not found</div>";

                                }
                                else{

                                    ?>

                                    <img src="<?php echo SITEURL;?>slider/category/<?php echo $image_name;?>" class="img-responsive img-curve">

                                    <?php

                                }
                            ?>
                             

                             <h3 class="float-text text-white" style="position: absolute; bottom: 19px; left: 48%; transform: translateX(-50%); color: white; text-align: center; z-index: 2;">
                                <?php echo $title; ?>
                            </h3>
                          </div>
                         </a>



                        <?php
                    }


                }
                else{

                    echo "<div class ='failed'>Category Not found</div>";

                }
            ?>

            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


   <?php include('partials-front/footer.php');?>