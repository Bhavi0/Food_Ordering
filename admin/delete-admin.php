<?php include('../partials/menuadmin.php');  ?>
<?php include('../config/constants.php'); ?>
<?php
// include constants file here
 //1. Get the id of admin to be deleted
  $id=$_GET['id'];   
 //2. create sql query to delete admin
 $sql="DELETE FROM tbl_admin WHERE id='$id'";

//  execute the query
$res=mysqli_query($conn,$sql);
// check whether the query is successfully executed or not
if($res==TRUE)
{
    // query successfully updated and admin deleted
// echo "admin deleted";.
// I don't want to display a message of "admin deleted" I want to redirect on manage-admin.php page. To do that i need to create a session variable to display a message.
// Create session variable to display a message
$_SESSION['delete']="<div class='success'>Deleted Successfully</div>";
// redirect to manage-admin page
header ("location:".SITEURL."admin/manage-admin.php");
}
else{
    // error occured/ admin not deleted
    // echo "admin not deleted";
    $_SESSION['delete']="<div class='error'>Admin Not Deleted Yet</div>";
    header ("location:".SITEURL."admin/manage-admin.php");
}



 //3. redirect to manage-admin page with message(successfully deleted or failed to deleted) respectively.


?>


<?php include('../partials/footer.php');  ?>