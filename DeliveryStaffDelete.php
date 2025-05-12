<?php 
session_start();
include('Connect.php');

$DeliveryStaffID = $_GET['DeliveryID'];
$DeliveryStaff_Delete = "DELETE FROM deliverystaff WHERE `DeliveryStaffID` = '$DeliveryStaffID'";
$Result = mysqli_query($connect, $DeliveryStaff_Delete);

if ($Result) 
{
	echo "<script>window.alert('Delivery Staff Information has been successfully deleted!')</script>";
	echo "<script>window.location ='DeliveryStaffRegister.php'</script>";
}
else
{
	echo "<p>Something went wrong in Delivery Staff Delete. Cannot operate the delete". mysqli_error($connect)."</p>";
}
 ?>