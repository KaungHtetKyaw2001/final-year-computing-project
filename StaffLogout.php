<?php 
session_start();

session_destroy();
echo "<script>alert('Staff Logged Out Successfully')</script>";
echo "<script> window.location = 'SupplierLogin.php'</script>";

 ?>