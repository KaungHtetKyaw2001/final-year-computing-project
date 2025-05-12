<?php 
session_start();
include('Connect.php');

$CustomerID = $_GET['CustomerID'];

$Customer_Delete = "DELETE FROM Customer WHERE `CustomerID` = '$CustomerID'";
$Result = mysqli_query($connect,$Customer_Delete);

if ($Result) 
{
	echo "<script>window.alert('Customer Account has been successfully deleted!')</script>"; 	
	echo "<script> window.location = 'CustomerRegister.php'</script>";
} 
else
{
	echo "<p>Something went wrong in Customer Delete. Cannot operate the delete. ".mysqli_error($connect)."</p>";
}
 ?>
