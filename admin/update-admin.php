<?php include('../partials/menuadmin.php');  ?>
<div class="main-content">
<div class="wrapper">
<h1>update admin</h1>
<br><br>
<?php
//get the id of selected admin
    $id=$_GET['id'];

    //2. create sql query to get the details
    $sql="select * from tbl_admin where id='$id'";

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

            $full_name=$row['full_name'];
            $username=$row['username'];
        }
        else
        {
            // redirect to manage-admin.php page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>
<form action="" method="post">
<table class="tbl-30">
<tr>
    <td>Full Name</td>
    <td>
        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
    </td>
</tr>
<tr>
    <td>User Name</td>
    <td>
        <input type="text" name="username" value="<?php echo $username; ?>">
    </td>
</tr>
<tr>
    <td colspan="2">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" name="submit" value="update-admin" class="btn-secondary">
    </td>
</tr>
</table>
</form>
</div>
</div>

<?php
// check whether the "update-admin" button is clicked or not
if(isset($_POST['submit']))
{
    // echo "button clicked";
    // 1.Now what we have to do is, Get the data from the forms by post method.
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    // create a sql query to update the details
    $sql= "UPDATE tbl_admin SET full_name='$full_name',
username='$username' WHERE id='$id' ";

$res= mysqli_query($conn,$sql);
//3. executing query and saving data into database.
//4. check whether the (query is) data is inserted or not
if($res==true)
{
    // data inserted
    // echo "data inserted";
    // create a session variable to display a message
    $_SESSION['update']="<div class='success'>Updated Successfully</div>";
    // ,Redirece page..
    header('location:'.SITEURL.'admin/manage-admin.php');
}
else
{
    // data not inserted
    // echo "failed to insert data";
// create a session variable to display a message
$_SESSION['update']="<div class='error'>failed to Update the details</div>";
// ,Redirece page..
header ("location:".SITEURL.'admin/manage-admin.php');
}
}

?>








<?php include('../partials/footer.php');  ?>