<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

                    <?php
                        // create sql query to display all categories in the page
                        $sql="SELECT * FROM tbl_category WHERE active='yes' AND featured='yes'" ;

                        // execute the sql query
                        $res=mysqli_query($conn, $sql);

                        // count the rows to check whether the category is available or not
                        $count=mysqli_num_rows($res);

                        if($count>0)
                        {
                            // category available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                // get the individual values
                                $id=$row['id'];
                                $title=$row['title'];
                                $image_name=$row['image_name'];
                                ?>
                                  <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
            <div class="box-3 float-container">
                <?php
                        if($image_name=="")
                        {
                            // image is not available
                            echo "<div class='error'>Sorry Image is not available</div>";
                        }
                        else
                        {
                            // Image is available
                        ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                            <?php
                        }
                ?>
                <h3 class="float-text text-white"><?php echo $title; ?></h3>
            </div>
            </a>
            <?php
                            }
                        }
                        else
                        {
                            echo "<div class='error'>failed to display the category</div>";
                        }
                    ?>

          
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


  <?php include('partials-front/foot.php'); ?>