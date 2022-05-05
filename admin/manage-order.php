<?php include('../partials/menuadmin.php'); ?> 

<!-- main section starts here -->
<div class="main-content">
    <div class="wrapper"> 
 <!-- menu section ends -->
 <br><br>    
<h1>Manage Order</h1>
<br /><br /><br />

            <?php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
            ?>
            <br><br>

<table class="tbl-full">
    <tr  style=' font-weight:bold; font-size:15px;'>
        <th>S.No. </th>
        <th>Food </th>
        <th><pre>  Price </th>
        <th> <pre>  Quantity </th>
        <th>Total</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Customer Name</th>
        <th>Customer Contact</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>

        <?php
            // get the all the orders from database, CREATE A QUERY FOR IT
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC";   //Display the latest order at first.

            // EXECUTE THE QUERY
            $res = mysqli_query($conn,$sql);

            // count the rows
            $count = mysqli_num_rows($res);

            $sn = 1; //create a serial number and set its initial value as 1

            if($count>0)
            {
                // order available
                while($row=mysqli_fetch_assoc($res))
                {
                    // get all the values from database
                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status']; 
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];  


                    ?>

                        <tr>
                                <td ><b><?php echo $sn++; ?></b></td>
                                <td  style=' font-weight:bold;' ><?php echo $food; ?></td>
                                <td  style=' font-weight:bold;'><b><?php echo $price; ?></b></td>
                                <td  style=' font-weight:bold;'><?php echo $qty; ?></td>
                                <td  style=' font-weight:bold;'><?php echo $total; ?></td>
                                <td  style=' font-weight:bold;'><?php echo $order_date;?></td>
                                <td> 
                                    
                                <?php 
                                    // ordered, on delivery, delivered, cancelled

                                    if($status=="ordered")
                                    {
                                        echo "<label style='color:blue; font-weight:bold;'>$status</label>";
                                    }
                                    else if($status=="on delivery")
                                    {
                                        echo "<label style='color:orange; font-weight:bold;'>$status</label>";
                                    }
                                    else if($status=="delivered")
                                    {
                                        echo "<label style='color:green; font-weight:bold;'>$status</label>";
                                    }
                                    else if($status=="cancelled")
                                    {
                                        echo "<label style='color:red; font-weight:bold;'>$status</label>";
                                    }
                                ?>
                            
                                </td>
                                <td  style=' font-weight:bold;'> <pre>  <?php echo $customer_name; ?>  </pre></td>
                                <td  style=' font-weight:bold;'><pre>   <?php echo $customer_contact; ?>      </pre></td>
                                <td  style=' font-weight:bold;'><?php echo $customer_email; ?></td>
                                <td  style=' font-weight:bold;'><?php echo $customer_address; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                </td>
                        </tr>


                    <?php

                }

            }
            else
            {
                // order is not available
                ?>
                <tr>
                    <td colspan="12">
                        <div class="error">No order found</div>
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

<!-- main sections ends here -->



<?php include('../partials/footer.php');  ?>