<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnLogin'])) 
{
	$txtCompanyName = $_POST['txtCompanyName'];
	$txtPassword = $_POST['txtPassword'];

	$Select_Company = "SELECT * FROM importcompany
					   WHERE ImportCompanyName = '$txtCompanyName'
					   AND Password = '$txtPassword'";
	$Query = mysqli_query($connect,$Select_Company);
	$Count = mysqli_num_rows($Query);
	$Array = mysqli_fetch_array($Query);

	if ($Count == 1) 
	{
	 	$_SESSION['ImportCompanyID'] = $Array['ImportCompanyID'];
	 	$_SESSION['ImportCompanyName'] = $Array['ImportCompanyName'];
	 	$_SESSION['Description'] = $Array['Description'];
	 	$_SESSION['Password'] = $Array['Password'];

	 	echo "<script>window.alert('Account Login Successfully Completed')</script>";
	 	echo "<script>window.location ='ImportPurchase.php'</script>";
 	}
 	else
 	{
 		echo "<script>window.alert('Company Name or Password is incorrect!')".mysqli_error($connect)."</script>";
 	}
}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Import Company Login</title>
</head>
<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
<body>
<form action="ImportCompanyLogin.php" method="Post">
	<fieldset>
		<legend>Import Company Account Login</legend>
		<h1 align="center">Please Login your account here</h1>
		<table align="center">
			<tr>
				<td>Import Company Name</td>
				<td>
					<input type="text" name="txtCompanyName" placeholder="Import Company Name" required>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="Password" name="txtPassword" placeholder="Password" required>
				</td>
			</tr>
			<tr>
				<td><input type="Submit" name="btnLogin" value="Login"></td>
				<td><a href="ImportCompanyRegistration.php">Register</a></td>
			</tr>
		</table>
	</fieldset>
</form>
</body>
</html>