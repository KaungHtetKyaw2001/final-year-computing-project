<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$ImportCompanyID = $_POST['txtImportCompanyID'];
	$ImportCompanyName = $_POST['txtImportCompanyName'];
	$Description = $_POST['txtDescription'];
	$Password = $_POST['txtPassword'];

	$Insert_ImportCompany = "INSERT INTO `importcompany`(`ImportCompanyID`,`ImportCompanyName`,`Description`,`Password`) VALUES ('$ImportCompanyID','$ImportCompanyName','$Description','$Password')";
	$Insert_Query = mysqli_query($connect,$Insert_ImportCompany);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Import Company Registered! Welcome!!!')</script>";
		echo "<script>window.location = 'ImportCompanyLogin.php'</script>";		
	}	
	else
	{
		echo "<p>Import Company Registration failed! Please check your company name and description.".mysqli_error($connect)."</p>";
	}
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Import Company Registration</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

</head>
<body>
<form action = "ImportCompanyRegistration.php" method="Post">
	<fieldset>
		<legend>Import Company Register</legend>
		<h1 align="center">Register your company account here</h1>
		<table align="center">
			
			<tr>
				<td>Import Company ID</td>
				<td>
					<input type="text" name="txtImportCompanyID" value="<?php echo AutoID('importcompany','ImportCompanyID','IC-',6) ?>" readonly>
				</td>
			</tr>
			<tr>
				<td>Import Company Name</td>
				<td>
					<input type="text" name="txtImportCompanyName" placeholder="Import Company Name" required>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea cellpadding = '4px' name="txtDescription" placeholder="Company Description" required></textarea>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="Password" name="txtPassword" placeholder="Password">
				</td>
			</tr>
			<tr>
				<td><input type="Submit" name="btnRegister" value="Register"></td>
				<td><input type="Reset" value="Clear"></td>
			</tr>
		</table>
	</fieldset>
</form>
</body>
</html>