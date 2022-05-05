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
        $path="../images/category/".$image_name;
        // remove the image
        // with the help of this it will remove from local directory file
        $remove=unlink($path);
        // if failed to remove an image then display error message and stop the process
        if($remove==false)
        {
            // set the session message
            $_SESSION['remove']= "<div class='error'>failed to remove the category image</div>";
            // redirect to manage-category page and then will stop the process
            header('location:'.SITEURL.'admin/manage-category.php');
            // to stop the process i will use die() function for it
            die();


        }
    }
 
//2. create sql query to delete category
$sql="DELETE FROM tbl_category WHERE id=$id";

//  execute the query
$res=mysqli_query($conn,$sql);
// check whether the query is successfully executed or not
if($res==TRUE)
{
    // query successfully updated and category deleted
// echo "category deleted";.
// I don't want to display a message of "category deleted" I want to redirect on manage-admin.php page. To do that i need to create a session variable to display a message.
// Create session variable to display a message in manage-category.php page.
$_SESSION['delete']="<div class='success'>Deleted Successfully</div>";
// redirect to manage-admin page
header ("location:".SITEURL."admin/manage-category.php");
}
else
{
    // error occured/ category not deleted
    // echo "category not deleted";
    $_SESSION['delete']="<div class='error'>Category Not Deleted Yet</div>";
    header ("location:".SITEURL."admin/manage-category.php");
}
}
 //3. redirect to manage-admin page with message(successfully deleted or failed to deleted) respectively.

else
{
    // redirect to manage-category.php page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>
<?php include('../partials/footer.php');  ?>