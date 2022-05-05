
    <?php include('../partials/menuadmin.php');  ?>

    <!-- main content section starts -->
    <div class="main-content">
        <div class="wrapper">

          <h1>Manage-Admin</h1>
          <br>
<!-- button to add admin -->
<?php
// add-admin side session
if(isset($_SESSION['add']))
{
echo $_SESSION['add'];     //Displaying Session Message.
unset($_SESSION['add']);   //Removing Session Message.
}

// delete-admin message session
if(isset($_SESSION['delete']))
{
    echo $_SESSION['delete']; //Displaying Session Message
    unset($_SESSION['delete']); //Removing Session Message.

}

// update-admin message session
if(isset($_SESSION['update']))
{
    echo $_SESSION['update'];  //updating session message
    unset($_SESSION['update']);  //removing session message
}

// changing password
if(isset($_SESSION['password-not-match']))
{
    
    echo $_SESSION['password-not-match'];  //updating session message
    unset($_SESSION['password-not-match']);  //removing session message
}
if(isset($_SESSION['change-password']))
{
    echo $_SESSION['change-password'];
    unset($_SESSION['change-password']); 
}
?>
<br><br>    
<a href="add-admin.php" class="btn-primary">Add Admin</a>
<br><br><br>
<br>

<table class="tbl-full">
    <tr>
        <th>S.no</th>
        <th>full_name</th>
        <th>Username</th>
        <th>Actions</th>
    </tr>

<!-- here we'll display the data from the database -->

<?php
// this is my query
$sql= "SELECT * FROM tbl_admin";
// execute the query                
$res=mysqli_query($conn,$sql);
// check whether the query is executed or not
if($res==TRUE)
{
    //count rows to check whether we have data in our database or not
    $count=mysqli_num_rows($res);  //function to get all the rows in database

    $sn=1; //create a variable and assign the value
    //check the number of rows
    if($count>0)
    {
// we have data in database
while($rows=mysqli_fetch_assoc($res))
// The PHP mysqli_fetch_assoc() function returns an associative array which contains the current row of the result object.
{
    // using while loop to get all the data from the database
    // and while loop will run only as long as we have data in our database

    // getting individual data
    $id=$rows['id'];
    $full_name=$rows['full_name'];
    $username=$rows['username'];

    // display the values in our design table
    ?> 
    <!-- //breaking off the php here so i can write the html code -->
    <!-- //Here myphp code break here -->

<tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $full_name; ?></td>
        <td><?php echo $username; ?></td>
        <td>
            <a href="<?php SITEURL; ?>changepassword-admin.php?id=<?php echo $id; ?>" class="btn-success">change password</a>
            <a href="<?php SITEURL; ?>update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
            <!-- in SITEURL home url is set so that affter deletion it will be redirect to the home url page.  -->
            <!-- here i am passing the value or query  through url this method is said to be get method. -->
            <a href="<?php SITEURL; ?>delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
        </td>
    </tr>


    <?php  //continue here my php

}
    }
}
?>


    
</table>
         
          <div class="clearfix"></div>
        </div>
    </div>    
    <!-- main content section ends -->


    <?php include('../partials/footer.php');  ?>