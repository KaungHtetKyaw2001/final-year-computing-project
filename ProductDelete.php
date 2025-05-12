<?php 
session_start();
include('Connect.php');

$ProductID = $_GET['ProductID'];
$Product_Delete = "DELETE FROM Product WHERE `ProductID` = '$ProductID'";
$Result = mysqli_query($connect, $Product_Delete);

if ($Result) 
{
	echo "<script>window.alert('Product has been sucessfully deleted!')</script>";
	echo "<script>window.location='ProductRegister.php'</script>";	
}
else
{
	echo "<p>Something went wrong in Product Delete. Cannot operate the delete".mysqli_error($connect)."</p>";
}

 ?>
