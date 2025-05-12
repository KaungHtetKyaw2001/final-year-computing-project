<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnLogin'])) 
{
	$txtusername = $_POST['txtusername'];
	$txtpassword = $_POST['txtpassword'];

	$Select = "SELECT * FROM customer
			   WHERE CustomerUsername = '$txtusername'
			   AND CustomerPassword = '$txtpassword'";

	$Query = mysqli_query($connect,$Select);
	$Count = mysqli_num_rows($Query);
	$Array = mysqli_fetch_array($Query);

	print_r($Array);

	if ($Count < 1) 
	{
		echo "<script>window.alert('Customer Username or Password Incorrect!')</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
		exit();
	}
	else
	{
		$_SESSION['CustomerID']=$Array['CustomerID'];
		$_SESSION['CustomerName']=$Array['CustomerName'];
		$_SESSION['Age']=$Array['Age'];
		$_SESSION['DateOfBirth']=$Array['DateOfBirth'];
		$_SESSION['Address']=$Array['Address'];
		$_SESSION['Gender']=$Array['Gender'];
		$_SESSION['Email']=$Array['Email'];
		$_SESSION['NRCNumber']=$Array['NRCNumber'];
		$_SESSION['PhoneNumber']=$Array['PhoneNumber'];
		$_SESSION['CustomerUsername']=$Array['CustomerUsername'];
		$_SESSION['CustomerPassword']=$Array['CustomerPassword'];
		$_SESSION['CustomerImage']=$Array['CustomerImage'];

		echo "<script>window.alert('Your Account login is success.')</script>";
		echo "<script>window.location = 'ProductDisplay.php</script>";
	}
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Customer Login</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action="CustomerLogin.php" method="Post">
	<fieldset>
		<legend>Customer Login</legend>
		<h1 align="center">Please Login to get access to your account</h1>
		<table align="center">
			<tr>
				<td>Username</td>
				<td>
					<input type="text" name="txtusername" placeholder="Username" required>
				</td>
			</tr>

			<tr>
				<td>Password</td>
				<td>
					<input type="Password" name="txtpassword" placeholder="Password" required>
				</td>
			</tr>

			<tr>
				<td>
					<input type="Submit" name="btnLogin" value="Login">
					<a href="CustomerRegister.php">Register</a>
					<a href="#">Forgot Password?</a>
				</td>
			</tr>
		</table>
	</fieldset>
</form>
</body>
</html>