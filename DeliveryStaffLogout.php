<?php 
session_start();

session_destroy();
echo "<script>window.alert('Delivery Staff logged out successfully')</script>";
echo "<script> window.location = 'DeliveryStaffLogin.php'</script>";
 ?>