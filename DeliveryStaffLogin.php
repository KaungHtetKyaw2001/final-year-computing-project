<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnLogin'])) 
{
	$txtUsername = $_POST['txtUsername'];
	$txtPassword = $_POST['txtPassword'];

	$Select = "SELECT * FROM deliverystaff WHERE DeliveryStaffUsername = 'txtUsername'
		AND DeliveryStaffPassword = '$txtPassword'";

	$Query = mysqli_query($connect,$Select);
	$Count = mysqli_num_rows($Query);
	$Array = mysqli_fetch_array($Query);

	print_r($Array);

	if ($Count < 1) 
	{
	 	echo "<script> window.alert ('Delivery Staff Username or Password Incorrect!')</script>";
	 	echo "<script> window.location = 'DeliveryStaffLogin.php'</script>";
	 	exit();
	} 
	else
	{
		$dsid=$Array['DeliveryStaffID'];
		$_SESSION['DeliveryStaffName']=$Array['DeliveryStaffName'];
		$_SESSION['Age']=$Array['Age'];
		$_SESSION['DateOfBirth']=$Array['DateOfBirth'];
		$_SESSION['Gender']=$Array['Gender'];
		$_SESSION['Email']=$Array['Email'];
		$_SESSION['Address']=$Array['Address'];
		$_SESSION['PhoneNumber']=$Array['PhoneNumber'];
		$_SESSION['DeliveryStaffUsername']=$Array['DeliveryStaffUsername'];
		$_SESSION['DeliveryStaffPassword']=$Array['DeliveryStaffPassword'];
		$_SESSION['DeliveryStaffImage']=$Array['DeliveryStaffImage'];
		echo "<script>window.alert('Your Account Login is Success.')</script>";
		echo "<script>window.location='DeliveryStaffUpdate.php?DeliveryStaffID=$dsid'</script>";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Delivery Staff Login</title>
 </head>
 <body>
 <form action="DeliveryStaffLogin.php" method="Post">
 	<fieldset>
 		<legend>Delivery Staff Login</legend>
 		<h1 align="center">Please login to get access your account</h1>
 		<table align="center">
 			<tr>
 				<td>Username</td>
 				<td>
 					<input type="text" name="txtUsername" placeholder='Your username' required>
 				</td>
 			</tr>

 			<tr>
 				<td>Password</td>
 				<td>
 					<input type="Password" name="txtPassword" placeholder="Your password" required>
 				</td>
 			</tr>

 			<tr>
 				<td>
 					<input type="Submit" name="btnLogin" value="Login">
 					<a href="DeliveryStaffRegister.php">Register</a>
 				</td>
 			</tr>
 		</table>
 	</fieldset>
 </form>
 </body>
 </html>