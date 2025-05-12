<?php 
session_start();
include('Connect.php');

if (isset($_SESSION['CustomerID'])) 
{
	$OrderID = $_GET['OrderID'];

	$Result = mysqli_query($connect,"SELECT * FROM orderdetails WHERE OrderID = '$OrderID'");
	while ($Arr = mysqli_fetch_array($result)) 
	{
		$ProductID = $Arr['ProductID'];
		$Quantity = $Arr ['Quantity'];
		$UpdateQuantity = "UPDATE product
						   SET Quantity = Quantity - '$Quantity'
						   WHERE ProductID ='$ProductID'";
		$Ret = mysqli_query($connect,$UpdateQuantity);
	}

	$UpdateStatus = "UPDATE orders
					 SET Status = 'Confirmed'
					 WHERE OrderID = '$OrderID'";
	$Result = mysqli_query($connect,$UpdateStatus);

	if ($result) 
	{
		echo "<script>window.alert('Order Successfully Confirmed!')</script>";
		echo "<script>window.location = 'OrderSearch.php</script>";
	}
	else
	{
		echo "<p>Something went wrong in Order Confirmed". mysqli_error($connect)."</p>";
	}
}
else
{
	echo "<script>window.alert('Please login as customer to continue...')</script>";
	echo "<script>window.location = 'CustomerLogin.php'</script>";
	exit();
}
 ?>

