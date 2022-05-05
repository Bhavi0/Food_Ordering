
<?php include('../partials/menuadmin.php'); ?> 

<!-- menu section ends -->
<div class="main-content">

    <div class="wrapper">
<br><br>    
<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
<br><br><br>
<?php 

if(isset($_POST['add']))
{
   echo $_SESSION['add'];
           unset($_SESSION['add']);
}
if(isset($_SESSION['delete']))
{
   echo $_SESSION['delete'];
   unset($_SESSION['delete']);
}
if(isset($_SESSION['remove-failed']))
{
   echo $_SESSION['remove-failed'];
   unset($_SESSION['remove-failed']);
}
if(isset($_POST['upload']))
{
   echo $_SESSION['upload'];
           unset($_SESSION['upload']);
}
if(isset($_SESSION['Unauthorize']))
{
   echo $_SESSION['Unauthorize'];
   unset($_SESSION['Unauthorize']);
}
if(isset($_SESSION['update']))
{
   echo $_SESSION['update'];
   unset($_SESSION['update']);
}

?>
<br><br>

<table class="tbl-full">
   <tr>
       <th>S.no</th>
       <th>Title</th>
       <th>Price</th>
       <th>Image</th>
       <th>Featured</th>
       <th>Active</th>
       <th>Actions</th>
   </tr>
   <!-- CREATE SQL QUERY TO GET ALL THE FOOD DETAILS -->
   <?php
       $sql="SELECT * FROM tbl_food ";

       // execute the query
       $res=mysqli_query($conn,$sql);

       // count rows to check whether i have categories or not
       $count=mysqli_num_rows($res);
       // create serial number variable and set default value as 1
       $sn=1;
       if($count>0)
       {
           // I have food in database
           while($row=mysqli_fetch_assoc($res))
           {
               // getting the value from individual columns
                   $id=$row['id'];
                   $title=$row['title'];
                   $price=$row['price'];
                   $image_name=$row['image_name'];
                   $featured=$row['featured'];
                   $active=$row['active'];

                   ?>
                                   <tr>
                                           <td><?php echo $sn++; ?></td>
                                           <td><?php echo $title; ?></td>
                                           <td><?php echo $price; ?></td>
                                           <td>
                                               <?php 
                                               // check whether I have image or not
                                               if($image_name!="")
                                               {
                                                                    
                                                        //  I have image
                                           // display the available image
                                           ?>
                                           <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">  
                                   <?php            
                                            }
                                            else
                                            {
                                                
                                                // I do not have an image, display an error message
                                                echo "<div class='error'>Image not Added</div>";   
                                               }
                                               ?>
                                               </td>
                                           <td><?php echo $featured; ?></td>    
                                           <td><?php echo $active; ?></td>
                                           <td>
                                               <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-danger">Update Food</a>
                                               <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">Delete Food</a>
                                           </td>
                                       </tr>
                                      
                   <?php
               
           }
       }
       else
       {
           // I do not have any food sorry
           ?>
            <tr>
                <td colspan="6">
        <div class="error">No food added yet</div>
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
 