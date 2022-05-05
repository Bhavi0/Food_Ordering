//get the id of selected category

    <?php include('../partials/menuadmin.php');  ?>
<?php include('../config/constants.php');   

// check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // get the value and delete it
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    // Remove the Physical image file from local drive that means if i delete image from delete-category then i need to delete the image from local drive too
    if($image_name!="")
    {
        // And to remove the image I need to give the path
        $path="../images/food/".$image_name;
        // remove the image
        // with the help of this it will remove from local directory file
        $remove=unlink($path);
        // if failed to remove an image then display error message and stop the process
        if($remove==false)
        {
            // set the session message
            $_SESSION['upload']= "<div class='error'>failed to remove the category image</div>";
            // redirect to manage-category page and then will stop the process
            header('location:'.SITEURL.'admin/manage-food.php');
            // to stop the process i will use die() function for it
            die();


        }
    }
 
//2. create sql query to delete category
$sql="DELETE FROM tbl_food WHERE id='$id'";

//  execute the query
$res=mysqli_query($conn,$sql);
// check whether the query is successfully executed or not
if($res==TRUE)
{
    // query successfully updated and category deleted
// echo "category deleted";.
// I don't want to display a message of "category deleted" I want to redirect on manage-admin.php page. To do that i need to create a session variable to display a message.
// Create session variable to display a message in manage-category.php page.
$_SESSION['delete']="<div class='success'>Food Deleted Successfully</div>";
// redirect to manage-admin page
header("location:".SITEURL."admin/manage-food.php");
}
else
{
    // error occured/ food not deleted
    // echo "food not deleted";
    $_SESSION['delete']="<div class='error'>Failed to delete the Food sorryy....</div>";
    header("location:".SITEURL."admin/manage-food.php");
}
}
 //3. redirect to manage-admin page with message(successfully deleted or failed to deleted) respectively.

else
{
    // redirect to manage-category.php page
    $_SESSION['Unauthorize']= "<div class='error'>Unauthorized access</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>
<?php include('../partials/footer.php');  ?>







<!-- MANAGE-FOOD.PHP -->
