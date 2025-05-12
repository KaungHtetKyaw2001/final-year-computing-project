<?php  
session_start();
include('Connect.php');

$DeliveryID=$_GET['DeliveryID'];

$Delivery_Delete="DELETE FROM delivery WHERE `DeliveryID`='$DeliveryID'";
$result=mysqli_query($connect,$Delivery_Delete);

if($result) //True
{
	echo "<script>window.alert('This delivery has been successfully deleted!')</script>";
	echo "<script>window.location='Delivery.php'</script>";
}
else
{
	echo "<p>Something went wrong in Delivery Delete. Cannot operate the delete" . mysqli_error($connect) . "</p>";
}
?>