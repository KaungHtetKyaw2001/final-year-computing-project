<?php 
session_start();
include('Connect.php');

$PurchaseID = $_GET['PurchaseID'];
$Purchase_Delete = "DELETE FROM purchase WHERE `PurchaseID` = '$PurchaseID'";
$Result = mysqli_query($connect, $Purchase_Delete);
if ($Result) 
{
	echo "<script>window.alert('This Purchase Information is Successfully deleted!')</script>";
	echo "<script>window.location = 'ImportPurchase.php'</script>";
}
else
{
	echo "<p>Someting went wrong in Purchase Deletion. Cannot operate the delete" . mysqli_error($connect)."</p>";
	echo "<script>window.location = 'ImportPurchase.php'</script>";
}

 ?>