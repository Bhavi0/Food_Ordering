<?php include('../partials/menuadmin.php');  ?>

<div class="main-content">

<div class="wrapper">
    <h1>Update Food</h1>
    <br><br>
  
    <?php
// check whether the id is set or not
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    //2. create sql query to get the details
    $sql2="SELECT * FROM tbl_food WHERE id='$id'";

    //3.executed the query
    $res2=mysqli_query($conn,$sql2);

    // check whether the query is executed or not
  
        $row2=mysqli_num_rows($res2);
        // check whether we have admin data or not
        
// GET THE INDIVIDUAL VALUES OF SELECTED FOOD
            $row2=mysqli_fetch_assoc($res2);

            $title=$row2['title'];
            $description=$row2['description'];
            $price=$row2['price'];
            $current_image=$row2['image_name'];
            $current_category=$row2['category_id'];
            $featured=$row2['featured'];
            $active=$row2['active'];
}
        else
        {
            // redirect to manage-category.php page
            $_SESSION['no-category-found']="<div class='error'>No food found</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
    
?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea  name="description" id="" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                    </tr>
                    <tr>
                        <td>Current Image</td>
                        <td>
                            <!-- current image will display here -->
                            <!-- image will displayed here -->
        <?php
                    if($current_image!="")      
                    {
                        // display the image
                    ?>
                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?> " width="200px" >
                    <?php
            
                    }
                    else
                    {
                        // display error
                        echo "<div class='error'>Image not added</div>";
                    }
        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image</td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                            <select name="category" >
                                    <?php
                                        // Query to get active categories
                                        $sql="SELECT * FROM tbl_category WHERE active='yes'";
                                        
                                        // execute the query
                                    $res=mysqli_query($conn,$sql);

                                    // count rows
                                    $count=mysqli_num_rows($res);

                                    // check whether the category is available or not
                                    if($count>0)
                                    {
                                        // category available
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            $category_title=$row['title'];
                                            $category_id=$row['id'];

                                            // echo "<option value='$category_id'>$category_title</option>";   
                                            ?>
                                                <option <?php if($current_category==$category_id){echo "selected";} ?>  value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                            <?php

                                        }
                                    }
                                    else
                                    {
                                        // category not available
                                        echo "<option value='0'>category not available</option>";
                                    }

                                    ?>

                                <option value="0">Test Category</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured</td>
                        <td>
                            <input <?php if($featured=="yes"){echo "checked";} ?> type="radio" name="featured" value="yes">yes
                            <input <?php if($featured=="no"){echo "checked";} ?> type="radio" name="featured"  value="no">No
            
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                         <input <?php if($active=="yes"){echo "checked";} ?> type="radio" name="active" value="yes">yes
                         <input <?php if($active=="no"){echo "checked";} ?> type="radio" name="active" value="no">no
                        </td>
                 </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                                <input type="submit" value="Update Food" name="submit" class="btn-secondary">
                            </td>
                        </tr>         
                </table>
            </form>

            <?php
// check whether the "update-category" button is clicked or not
if(isset($_POST['submit']))
{
    // echo "button clicked";
    // 1.Now what we have to do is, Get the data from the forms by post method.
    $id=$_POST['id'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $price=$_POST['price'];
    $current_image=$_POST['current_image'];
    $category=$_POST['category'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];
// 2.  Updating New Image if Selected
//  check whether the image is selected or not
if(isset($_FILES['image']['name']))
{
    // Get the image details
$image_name=$_FILES['image']['name'];
// check whether the image is available or not
if($image_name!="")
{
        // image available
        // Upload The New Image
        $ext= end(explode('.', $image_name));  //it gets the extension of the image
        // remove the current image
        $image_name = "food_name_".rand(0000,9999).'.'.$ext;  //
        // get the source and destination path
        $src_path=$_FILES['image']['tmp_name'];

        $dest_path="../images/food/".$image_name;
// finally upload the image
        $upload= move_uploaded_file($src_path, $dest_path);
// check whether the image is uploaded or not
// if image is not uploaded then will stop the process and redirect to error message
if($upload==false)
{
    // set message
    $_SESSION['upload']="<div class='error'>failed to upload image</div>";
    // redirect to add category page
    header("location:".SITEURL."admin/manage-food.php");
    // stop the process
    die();  
}
        // b. Remove the current Image if available
      if($current_image!=="")
        {
            $remove_path="../images/food/".$current_image;
            $remove= unlink($remove_path);   
    
            // check whether the image is removed or not
            //  if failed to remove then display a error message and stop the process
             if($remove==false)
             {
                //   failed to remove image
                $_SESSION['remove-failed']="<div class='error'>failed to remove the image</div>";
                header("location:".SITEURL."admin/manage-food.php");
                die();  //stop the process  
             }
        }

    }
else
{
    $image_name=$current_image;
}

}
else
{
    $image_name=$current_image;
}

// create a sql query to update the details
    $sql3= "UPDATE tbl_food SET title='$title',image_name='$image_name',description='$description', price='$price',category_id='$category',featured='$featured',active='$active' WHERE id='$id' ";
// executing the query
//3. executing query and saving data into database.
$res3= mysqli_query($conn,$sql3);
//4. check whether the (query is) data is inserted or not
if($res3==true)
{
    // data inserted
    // echo "data inserted";
    // create a session variable to display a message
    $_SESSION['update']="<div class='success'>Updated Successfully</div>";
    // ,Redirece page..
    // header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    // data not inserted
    // echo "failed to insert data";
// create a session variable to display a message
$_SESSION['update']="<div class='error'>failed to Update the details</div>";
// ,Redirece page..
header ("location:".SITEURL.'admin/manage-food.php');
}
}

?>

  
</div>
</div>





<?php include('../partials/footer.php');  ?>