<?php include('partials/menu.php')?>
        <div class="main">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br>

            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
            ?>
            <br>

                <div class="col-4 text-center">
                <?php
                        $sql="SELECT * FROM tbl_category";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count ;?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php
                        $sql2="SELECT * FROM tbl_food";
                        $res2=mysqli_query($conn,$sql2);
                        $count2=mysqli_num_rows($res2);

                    ?>
                    <h1><?php echo $count2 ;?></h1>
                    <br>
                    Foods
                </div>

                <div class="col-4 text-center">
                <?php
                        $sql6="SELECT * FROM tbl_user";
                        $res6=mysqli_query($conn,$sql6);
                        $count6=mysqli_num_rows($res6);

                    ?>
                    <h1><?php echo $count6 ;?></h1>
                    <br>
                    Users
                </div>

                 <div class="col-4 text-center">
                 <?php
                        $sql3="SELECT * FROM tbl_order";
                        $res3=mysqli_query($conn,$sql3);
                        $count3=mysqli_num_rows($res3);

                    ?>
                    <h1><?php echo $count3 ;?></h1>
                    <br>
                    Total Orders
                </div>

                 <div class="col-4 text-center">
                    <?php
                        $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status ='Delivered'";
                        $res4=mysqli_query($conn,$sql4);
                        $row4=mysqli_fetch_assoc($res4);

                        $total_revenue=$row4['Total'];
                        

                    ?>
                    <h1>$<?php echo $total_revenue;?></h1>
                    <br>
                    Revenue Generated
                </div>
                 <div class="col-4 text-center">
                 <?php
                        $sql5="SELECT * FROM tbl_contact";
                        $res5=mysqli_query($conn,$sql5);
                        $count5=mysqli_num_rows($res5);

                    ?>
                    <h1><?php echo $count5 ;?></h1>
                    <br>
                    Feedback
                </div>
            </div>
           <div class="clearfix"></div>
        </div>

<?php include('partials/footer.php')?>    
