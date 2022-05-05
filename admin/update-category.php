<?php include('../partials/menuadmin.php');  ?>
<div class="main-content">
<div class="wrapper">
<h1>update category</h1>
<br><br>
<?php
// check whether the id is set or not
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    //2. create sql query to get the details
    $sql="select * from tbl_category where id='$id'";

    //3.executed the query
    $res=mysqli_query($conn,$sql);

    // check whether the query is executed or not
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        // check whether we have admin data or not
        if($count==1)
        {
            //  get the details
            // echo "admin available";
            $row=mysqli_fetch_assoc($res);

            $title=$row['title'];
            $current_image=$row['image_name'];
            $featured=$row['featured'];
            $active=$row['active'];
        }
        else
        {
            // redirect to manage-category.php page
            $_SESSION['no-category-found']="<div class='error'>No category found</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    }
}
?>
<form action="" method="post" enctype="multipart/form-data">
<table class="tbl-30">
<tr>
            <td>Title:</td>
            <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
        </tr>
        <tr>

<tr>
    <td>current Image:</td>
    <td>
        <!-- image will displayed here -->
        <?php
                    if($current_image!="")      
                    {
                        // display the image
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?> " width="200px" >
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
<td>New Image:</td>
<td>
    <input type="file" name="image" id="">
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
            <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="UPDATE CATEGORY" name="submit" class="btn-secondary">
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
    $current_image=$_POST['current_image'];
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
        $ext=end(explode('.',$image_name));
        // remove the current image
        $image_name="food_category_".rand(000,999).'.'.$ext;  //
        $source_path=$_FILES['image']['tmp_name'];

$destination_path="../images/category/".$image_name;
// finally upload the image
$upload= move_uploaded_file($source_path, $destination_path );
// check whether the image is uploaded or not
// if image is not uploaded then will stop the process and redirect to error message
if($upload==false)
{
    // set message
    $_SESSION['upload']="<div class='error'>failed to upload image</div>";
    // redirect to add category page
    header("location:".SITEURL."admin/manage-category.php");
    // stop the process
    die();  
}
        // b. Remove the current Image if available
      if($current_image!=="")
        {
            $remove_path="../images/category/".$current_image;
            $remove=unlink($remove_path);   
    
            // check whether the image is removed or not
            //  if failed to remove then display a error message and stop the process
             if($remove==false)
             {
                //   failed to remove image
                $_SESSION['failed-remove']="<div class='error'>failed to remove the image</div>";
                header("location:".SITEURL."admin/manage-category.php");
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
    $sql2= "UPDATE tbl_category SET title='$title',image_name='$image_name', featured='$featured',active='$active' WHERE id='$id' ";
// executing the query
//3. executing query and saving data into database.
$res2= mysqli_query($conn,$sql2);
//4. check whether the (query is) data is inserted or not
if($res2==true)
{
    // data inserted
    // echo "data inserted";
    // create a session variable to display a message
    $_SESSION['update']="<div class='success'>Updated Successfully</div>";
    // ,Redirece page..
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
    // data not inserted
    // echo "failed to insert data";
// create a session variable to display a message
$_SESSION['update']="<div class='error'>failed to Update the details</div>";
// ,Redirece page..
header ("location:".SITEURL.'admin/manage-category.php');
}
}

?>


</div>
</div>










<?php include('../partials/footer.php');  ?>