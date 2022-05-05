<?php include('../partials/menuadmin.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>ADD CATEGORY PAGE</h1>  
        <br><br><br>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        // if(isset($_SESSION['upload']))
        // {
        //     echo $_SESSION['upload'];
        //     unset($_SESSION['upload']);
        // }
        ?>
        <br><br>
        <!-- ADD CATEGORY FORM STARTS -->

<form action="" method="post" enctype="multipart/form-data">
    <!-- HENCE ENCTYPE PROPERTY ALLOW US TO UPLOAD A FILE    -->
    <table class="tbl-30">
        <tr>
            <td>Title:</td>
            <td><input type="text" name="title" placeholder="Category Title" id=""></td>
        </tr>
        <tr>

<tr>
    <td>Select Image</td>
    <td>
        <input type="file" name="image" id="">
    </td>
</tr>

            <td>Featured</td>
            <td>
                <input type="radio" name="featured" id="" value="yes">yes
                <input type="radio" name="featured" id="" value="no">No

            </td>
        </tr>

        <tr>
               <td>Active:</td>
               <td>
                <input type="radio" name="active" value="yes">yes
                <input type="radio" name="active" value="no">no
               </td>
        </tr>
        
        <tr>
            <td colspan="2">
                <input type="submit" value="ADD CATEGORY" name="submit" class="btn-secondary">
            </td>
        </tr>
    </table>
</form>

<?php
if(isset($_POST['submit']))
{
    // echo "hi bhavika your button is clicked";

    // 1. Get the value from category form
    $title=$_POST['title'];
    if(isset($_POST['featured']))   
    {
        // get the value from form
        $featured=$_POST['featured'];
    }
    else
    {
        // set the default value
        $featured="no";
    }   
    
    if(isset($_POST['active']))
    {
        $active=$_POST['active'];
    }
    else
    {
        $active="no";
    }

// CHECK WHETHER THE img    IS SELECTED OR NOT and set the value for image_name accordingly
// print_r($_FILES['image']); 
// die(); //break the code here

if(isset($_FILES['image']['name']))
{
//upload the Traget
//To upload image we need image name, source path and destination path
$image_name=$_FILES['image']['name'];

// upload the image only if image is selected
if($image_name!="")
{



// renaming the image or auto rename the image
$ext=end(explode('.',$image_name));
// rename the image
$image_name="food_category_".rand(000, 999).'.'.$ext; 


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
    header("location:".SITEURL."admin/add-category.php");
    // stop the process
    die();  
}
}

}
else    
{
//Don't Upload Image and set the image name value as blank
$image_name="";

}

// 2. CREATE SQL QUERY TO INSERT DATA INTO DATABASE
        $sql="INSERT INTO tbl_category SET 
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

// execute the query and save in database
$res=mysqli_query($conn,$sql);

// check whether the query is executed or not and data updated or not
if($res==true)
{
    // query executed and category updated
    
    $_SESSION['add']="<div class='success'>category added successfully</div>";
    // redirect to manage-category.php page
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
    // failed to add category
    $_SESSION['add']="<div class='error'>failed to add the category</div>";
    // redirect to manage-category.php page
    header('location:'.SITEURL.'admin/add-category.php');
}

        }
?>

        <!-- ADD CATEGORY FORM ENDS -->
    </div>
</div>





<?php include('../partials/footer.php');  ?>
