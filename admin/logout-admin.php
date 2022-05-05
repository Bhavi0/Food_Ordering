<?php
// Include constants.php  for SITEURL so that we can access SITEURL  function.
include('../config/constants.php');
// destroy the session
session_destroy();  //unset $_SESSION['user'];
// redirect to log-in page
header("location:".SITEURL."admin/login-admin.php");
?>