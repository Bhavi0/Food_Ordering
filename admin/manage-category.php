<?php include('../partials/menuadmin.php'); ?> 

    <!-- menu section ends -->
    <div class="main-content">

    <div class="wrapper">
    <br><br>  
    
    <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br><br>
    
<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
<br><br><br>
<table class="tbl-full">
    <tr>
        <th>S.no</th>
        <th>title</th>
        <th>image</th>
        <th>featured</th>
        <th>Active</th>
        <th>Actions</th>
    </tr>


<?php
// QUERY TO GET ALL CATEGORIES FORM DATABASE
$sql="SELECT * FROM tbl_category ";

// EXECUTE THE QUERY
$res=mysqli_query($conn,$sql);

// count rows
$count=mysqli_num_rows($res);

// creating serial number variable here and assigning value it to 1
$sn=1;
// check whether we have data in our database or not
if($count>0)
{
    // we have data in database
    // Get the data and display
    while($row=mysqli_fetch_assoc($res))
    {
        $id=$row['id'];
        $title=$row['title'];
        $image_name=$row['image_name'];
        $featured=$row['featured'];
        $active=$row['active'];
        ?>

<tr>
        <td><?php echo $sn++;?></td>
        <td><?php echo $title; ?></td>
        <td> 
        <?php
        // check whether the image name is available or not
        if($image_name!="")
        {
            // to Display the Image
            ?>        <!-- Ending Php Here so I can input Html code -->

<!-- Hence SITEURL gives link to the our website directory -->
<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width='120px' >
            
            <?php
            
        }
        else
        {
            // Display the Error
            echo "<div class='error'>Image not Added</div>";
        }
        ?>
    </td>
        <td><?php echo $featured; ?></td>
        <td><?php echo $active; ?></td>
        <td>
            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
        </td>
    </tr>

<?php
    }
}
else
{
    // we do not have data sorry
    // display data from database in table
    ?>
<tr>
    <td colspan="6">
        <div class="error">No category added</div>
    </td>
</tr>
    <?php
}
?>



  
   
</table>
<div class="clearfix"></div>
        </div>
    </div>    
    <!-- main content section ends -->


    <?php include('../partials/footer.php');  ?>