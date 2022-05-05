<?php include('../partials/menuadmin.php'); ?> 


<div class="main-content">
<div class="wrapper">
<h1>Add Admin</h1>,
<br><br>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];  //displaying session message.

    unset($_SESSION['add']);  //removing session message.
}
?>
<form action="" method="post">
<table class="tbl-30">
    <tr>
        <td>Full Name</td>
        <td><input type="text" name="full_name" placeholder="enter your full name"></td>
    </tr>
    <tr>
        <td>UserName</td>
        <td><input type="text" name="username" placeholder="your username"></td>
    </tr>
    <tr>
        <td>Password</td>
        <td><input type="password" name="password" placeholder="your password "></td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary" >
        </td>
    </tr>
</table>
</form>

</div>


<?php include('../partials/footer.php');  ?>



<?php
// process the value from form and save it into database
// check whether the button is clicked or not

if (isset($_POST["submit"]))
{
    // echo "button clicked";
    // 1.Now what we have to do is, Get the data from the forms by post method.

    $full_name= mysqli_real_escape_string($conn, $_POST['full_name']);
    $username= mysqli_real_escape_string($conn, $_POST['username']);
    $password= md5($_POST['password']);

// 2. sql query to save the data into database.
$sql= "INSERT INTO tbl_admin SET full_name='$full_name',
username='$username',
password='$password'  ";


//3. executing query and saving data into database.
$res= mysqli_query($conn,$sql) or die(mysqli_error());


//4. check whether the (query is) data is inserted or not
if($res==TRUE)
{
    // data inserted
    // echo "data inserted";
    // create a session variable to display a message
    $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
    // ,Redirece page..
    header ("location:".SITEURL."admin/manage-admin.php");
}

else
{
    // data not inserted
    // echo "failed to insert data";
// create a session variable to display a message
$_SESSION['add']="<div class='error'>failed to add admin</div>";
// ,Redirece page..
header ("location:".SITEURL.'admin/add-admin.php');
}
}

?>


