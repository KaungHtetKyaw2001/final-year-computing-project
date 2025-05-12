<?php 
session_start();

session_destroy();
echo "<script>window.alert('Customer logged out successfully')</script>";
echo "<script> window.location = 'CustomerLogin.php'</script>";
 ?>