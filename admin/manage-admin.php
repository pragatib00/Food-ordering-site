<?php include('partials/menu.php')?>

        <div class="main">
            <div class="wrapper">
                <h1>Manage Admin</h1><br><br>

                <?php
                    if(isset($_SESSION['add'])){

                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }
                     if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['not-match'])){
                        echo $_SESSION['not-match'];
                        unset($_SESSION['not-match']);
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br><br>

                <a href="add-admin.php"class="btn-primary">Add Admin</a>
                
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php

                        $sql="SELECT * FROM tbl_admin";
                        $result=mysqli_query($conn, $sql);

                        if($result){

                            //counting rows to check whether we have data in database

                            $count=mysqli_num_rows($result); //func to get all the rows in db
                            $sn=1; //creating sn varaiable
                            if($count>0){
                                
                                while($rows=mysqli_fetch_assoc($result)){ //get all the rows from db and store in $rows. runs as long as we have data in db

                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //displaying the values in table

                                    ?>

                                    <tr>
                                        <td><?php echo $sn++?></td>
                                        <td><?php echo $full_name?></td>
                                        <td><?php echo $username?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/change-password.php?id=<?php echo $id?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                     </tr>

                                    <?php




                                }
                            }
                            else{

                            }


                        }
                        ?>
                        


                    
                    
                </table>
               
            </div>
        </div>

<?php include('partials/footer.php')?>
