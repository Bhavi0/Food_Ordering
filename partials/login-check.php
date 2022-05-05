


<!--login-check -->
<?php
// Authorization- access control
// check whether the user is logged in or not
if(!isset($_SESSION['user']))
{
    // user is not logged in
    // redirecting to login page with message
    $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Main Admin Panel</div>";
    // redirect to login page
    header("location:".SITEURL."admin/login-admin.php");
}
?> 
