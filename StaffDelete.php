<?php 
session_start();
include('Connect.php');

$StaffID = $_GET['StaffID'];
$Staff_Delete = "DELETE FROM staff WHERE `StaffID` = '$StaffID'";
$Result = mysqli_query($connect, $Staff_Delete);

if ($Result) 
{
	echo "<script>window.alert('Staff Information has been successfully deleted!')</script>";
	echo "<script>window.location ='StaffAdministration.php'</script>";
}
else
{
	echo "<p>Something went wrong in Staff Delete. Cannot operate the delete". mysqli_error($connect)."</p>";
}
 ?>
