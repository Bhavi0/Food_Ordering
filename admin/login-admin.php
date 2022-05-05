<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login-admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login"><br>
        <h1 class="text-center">Login</h1> <br>
        <?php
        if(isset($_SESSION['login']))
        {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['no-login-message']))
        {
            echo  $_SESSION['no-login-message'];
            unset  ($_SESSION['no-login-message']);
        }
        ?>
        <br><br>
<!-- form starts here -->
<form action="" method="post" class="text-center">
    Username: <br>
    <input type="text" name="username" placeholder="enter username" id=""><br><br>

    Password: <br>
    <input type="password" name="password" placeholder="enter password" id=""> <br>
<br>
    <input type="submit" value="login" class="btn-primary" name="submit">
</form>
<br>
<!-- form ends here -->
        <p class="text-center">created by- <a href="www.bhavikagajbhiye.com">Bhavika Gajbhiye</a></p>
    </div>
</body>
</html>

<?php
// check whether the submit button is clicked or not,
if(isset($_POST['submit']))
{
    // process for login
    // echo "button clicked";
    // 1. get the data from login form 
    // $username=$_POST['username'];
    // $password=md5($_POST['password']);

    $username=mysqli_real_escape_string($conn, $_POST['username']);

    $password=mysqli_real_escape_string($conn, md5($_POST['password']));

    // 2. sql to check whether the user with username and password exist or not
    
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
//3. execute the query
$res=mysqli_query($conn,$sql);  

// 4. count rows to check whether the user exist or not
$count=mysqli_num_rows($res);
if($count==1)
{
    $_SESSION['login']= "<div class='success'>login successfully</div>";
    // creating another section to check whether the user is logged in or not and logout will unset it.
    $_SESSION["user"]= $username;   //to check whehter the user is logged in or not
    // redirect to homepage/dashboard
    header('location:'.SITEURL.'admin/');

}
else
{
    // user not available login alert
    $_SESSION['login']= "<div class='error' style='text-align:center;'>username or password did not match</div>";
    // redirect to loginpage
    header('location:'.SITEURL.'admin/login-admin.php');
}

}

?>