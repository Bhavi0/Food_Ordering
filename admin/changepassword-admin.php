<?php include('../partials/menuadmin.php');  ?>
<div class="main-content">
<div class="wrapper">
<h1>change password</h1>
<br><br>
<form action="" method="post">
    <table class="tbl-30">
        <tr>
            <td>Old password</td>
            <td>
                <input type="password" name="current_password" placeholder="old password">
            </td>
        </tr>

        <tr>
            <td>new password</td>
            <td>
                <input type="password" name="new_password" placeholder="new password">
            </td>
        </tr>

        <tr>
            <td>confirm password</td>
            <td>
                <input type="password" name="confirm_password" placeholder="confirm password">
            </td>
        </tr>
        

        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="change password" name="submit" class="btn-success">
            </td>
        </tr>
    </table>
</form>
</div>
</div>

<?php
// check whether the "changepassword-admin" button is clicked or not
// echo "clicked";
if(isset($_POST['submit']))
{
    // echo "button clicked";
    // 1.Now what we have to do is, Get the data from the forms by post method.
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    // create a sql query to update the details
    $sql= "SELECT * FROM tbl_admin WHERE id='$id' AND password='$current_password'";

$res= mysqli_query($conn,$sql);
//3. executing query and saving data into database.
//4. check whether the (query is) data is inserted or not
if($res==true)
{
    // data inserted
    // echo "data inserted";
    // create a session variable to display a message
$count=mysqli_num_rows($res);

if($count==1)
    {
        //user exists and password can be changed
        // echo "user found";  
        if($new_password==$confirm_password)
        {
            // update the password
            $sql2=" UPDATE tbl_admin SET password='$new_password' WHERE id='$id'";

            // execute the query
            $res2= mysqli_query($conn,$sql2);

            // check whether the query is executed or not
            if($res2==true)
            {
                // display success message
                $_SESSION['change-password']= "<div class='success'>password change successfully</div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
            else
            {
                // display error message
                $_SESSION['change-password']= "<div class='error'>password not changed successfully</div>";

                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            // redirect to manage-admin
            $_SESSION['password-not-match']= "<div class='error'>password not match</div>";

            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
    else
    {
        //user does not exist
        $_SESSION['user-not-found']= "<div class='error'>user not found</div>";

        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
else
{
    // data not inserted
    // echo "failed to insert data";
// create a session variable to display a message
$_SESSION['update']="<div class='error'>failed to Update the details</div>";
// ,Redirece page..
// header ("location:".SITEURL.'manage-admin.php');
}
}

?>

<?php include('../partials/footer.php');  ?>