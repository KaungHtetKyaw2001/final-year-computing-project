<?php 
session_start();

session_destroy();
echo "<script>alert('Import Company Logged Out Successfully')</script>";
echo "<script>window.location = 'ImportCompanyLogin.php'</script>";
 ?>