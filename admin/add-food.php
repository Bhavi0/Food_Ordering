<?php include('../partials/menuadmin.php');  ?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add food</h1> 
            <br><br><br>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title</td>
                        <td><input type="text" name="title" placeholder="title of the food"></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description" placeholder=" Description of the food" id="" cols="30" rows="5"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" ></td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                       <td> <input type="file" name="image" id=""></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td><select name="category" >
                            <?php
                                // Create Php Code to display all active(yes) categories from database
                                // 1. Create sql to get all Categories from database. Using select all option
                                        $sql="SELECT * FROM tbl_category WHERE active='yes'";

                                // Executing query
                                        $res=mysqli_query($conn,$sql);

                                // Count rows to check whether we have categories or not
                                        $count=mysqli_num_rows($res);

                                // If count is greater than zero then we have categories otherwise we don't have any categories
                                if($count>0)
                                {


                                    
                                        // we have categories
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            // get the details of categories
                                                $id=$row['id'];
                                                $title=$row['title'];

                                                ?>
                                                        <option value=" <?php echo $id; ?>"><?php echo $title; ?></option>                        
                                                <?php
                                        }
                                }
                                else
                                {
                                    // we do not have any category 
                                    ?>
                                            <option value="0 ">No category found</option>
                                    <?php
                                }

                                // 2. Display on dropdown
                            ?>


                        </select></td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input type="radio" name="featured" value="yes" >Yes
                            <input type="radio" name="featured" value="no" >No
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Active</td>
                        <td>
                            <input type="radio" name="active" value="yes" id="">yes
                            <input type="radio" name="active" value="no" id="">no
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Add Food" class="btn-secondary" name="submit">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // add the food in database from here...
                // 1. get the data from form 
                
                                    $title=$_POST['title'];
                                    $description=$_POST['description'];
                                    $price=$_POST['price'];
                                    $category=$_POST['category'];

                                    // check whether the radio button for feature and active is checked or not
                                    if(isset($_POST['featured']))   
                                    {
                                        $featured=$_POST['featured'];
                                    }
                                    else
                                    {
                                        $featured="no"; // default value
                                    }
                                    if(isset($_POST['active']))   
                                    {
                                        $active=$_POST['active'];
                                    }
                                    else
                                    {
                                        $active="no"; // default value
                                    }
                
                // 2. upload image if selected
                if(isset($_FILES['image']['name']))
                {
                //upload the Traget
                //To upload image we need image name, source path and destination path
                $image_name=$_FILES['image']['name'];

                // check whether the image is selected or not
                          if($image_name!="")
                                {
                                // renaming the image or auto rename the image
                                $ext=end(explode('.',$image_name));
                                // rename the image
                                $image_name="food-name-".rand(0000, 9999).'.'.$ext; 


                                $src=$_FILES['image']['tmp_name'];

                                $dst="../images/food/".$image_name;
                                // finally upload the image
                                $upload= move_uploaded_file($src, $dst );
                                // check whether the image is uploaded or not
                                // if image is not uploaded then will stop the process and redirect to error message
                                if($upload==false)
                                {
                                    // set message
                                    $_SESSION['upload']="<div class='error'>failed to upload image</div>";
                                    // redirect to add category page
                                    header("location:".SITEURL."admin/add-food.php");
                                    // stop the process
                                    die();  
                                }
                                }
                
                }
                    else
                {
                    $image_name="";  //setting default value as blank
                }    

                // 3.  Insert it into database
                // create a sql query to create save or add food
                // for numerical I do not need to pass the value in single quote '', but for string i have to pass the values in quotes 
                $sql2="INSERT INTO tbl_food SET title='$title',
                 description='$description',
                  price=$price,
                   image_name='$image_name',
                   category_id='$category',
                    featured='$featured',
                    active='$active'";
                    //  Execute the query
                    $res2=mysqli_query($conn,$sql2);
                    // check whether the query is executed or not and data updated or not
                    if($res2==true)
{
    // query executed and category updated
    
    $_SESSION['add']="<div class='success'>category added successfully</div>";
    // redirect to manage-category.php page
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    // failed to add category
    $_SESSION['add']="<div class='error'>failed to add the category</div>";
    // redirect to manage-category.php page
    header('location:'.SITEURL.'admin/add-food.php');
}

        }
           



            

            ?>
        </div>
    </div>
<?php include('../partials/footer.php');  ?>