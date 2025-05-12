<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnLogin'])) 
{
 	$Username = $_POST['txtUsername'];
 	$Password = $_POST['txtPassword'];

 	$Select = "SELECT * FROM staff
 			   WHERE StaffUsername = '$txtusername'
 			   AND StaffPassword = '$txtpassword'";
 	$Query = mysqli_query($connect,$Select);
 	$Count = mysqli_num_rows($Query);
 	$Array = mysqli_fetch_array($Query);

 	print_r($Array);

 	if ($Count < 1) 
 	{
 		echo "<script>window.alert('Staff Username or Password is incorrect!')</script>";
 		echo "<script>window.location = 'StaffLogin.php'</script>";
 		exit();	
 	}
 	else
 	{
 		$_SESSION['StaffID']=$Array['StaffID'];
 		$_SESSION['StaffName']=$Array['StaffName'];
 		$_SESSION['Age']=$Array['Age'];
		$_SESSION['Gender']=$Array['Gender'];
		$_SESSION['Role']=$Array['Role'];
		$_SESSION['DateOfBirth']=$Array['DateOfBirth'];
		$_SESSION['Address']=$Array['Address'];
		$_SESSION['Email']=$Array['Email'];
		$_SESSION['NRCNumber']=$Array['NRCNumber'];
		$_SESSION['PhoneNumber']=$Array['PhoneNumber'];
		$_SESSION['StaffUsername']=$Array['StaffUsername'];
		$_SESSION['StaffPassword']=$Array['StaffPassword'];
		$_SESSION['StaffImage']=$Array['StaffImage'];

		echo "<script>window.alert('Your Account Login is Success.')</script>";
		echo "<script>window.location='StaffAdministration.php'</script>";
 	}
} 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Staff Login</title>
	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css" />

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
	<form action="StaffLogin.php" method="Post">
		<fieldset>
			<legend>Staff Login</legend>
			<h1 align="center">Please login to get access your account</h1>
			<table align="center">
				<tr>
					<td>Username</td>
					<td>
						<input type="text" name="txtUsername" placeholder="Your Username" required>
					</td>
				</tr>

				<tr>
					<td>Password</td>
					<td>
						<input type="Password" name="txtPassword" placeholder="Your Password" required>
					</td>
				</tr>

				<tr>
					<td>
						<input type="Submit" name="btnLogin" value="Login">
					</td>
					<td>
						<a href="StaffRegister.php">Register</a>
					</td>
				</tr>

			</table>
		</fieldset>
	</form>
</body>
</html>