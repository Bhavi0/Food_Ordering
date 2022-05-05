<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.html" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
        
           
    <?php
                        // Getting foods from database
                        $sql2="SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' limit 6";

                        // execute the query
                        $res2=mysqli_query($conn,$sql2);

                        // count the foods to check whether the food is available or not
                        $count2=mysqli_num_rows($res2);

                        if($count2>0)
                        {
                            while($row2=mysqli_fetch_assoc($res2))
                            {
                                // getting all values
                                $id=$row2['id'];
                                $title=$row2['title'];
                                $price=$row2['price'];
                                $description=$row2['description'];
                                $image_name=$row2['image_name'];
                                ?>
                                     <div class="food-menu-box">
                <div class="food-menu-img">
                <?php
            // check whether the image is available or not
            if($image_name=="")
            {
               // image is not available
               echo "<div class='error'>Image is not available</div>";

            }
            else
            {
                // image is available
                ?>
                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                <?php
            }
            ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>
               <?php
                            }
                        }
                        else
                        {
                            // food not available
                            echo "<div class='error'>food not available</div>";
                        }
?>
           
        

    
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/foot.php'); ?>

