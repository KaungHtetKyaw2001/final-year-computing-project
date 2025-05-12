<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnUpdate'])) 
{
	$txtImportCompanyID = $_POST['txtImportCompanyID'];
	$txtImportCompanyName = $_POST['txtImportCompanyName'];
	$txtDescription = $_POST['txtDescription'];
	$txtPassword = $_POST['txtPassword'];

	$Update_ImportCompany = "UPDATE `importcompany`
							 SET `ImportCompanyName` = '$txtImportCompanyName',
							 	 `Description` = '$txtDescription',
							 	 `Password` = '$txtPassword'
							 WHERE `ImportCompanyID` = '$txtImportCompanyID'";
	$Update_Query = mysqli_query($connect,$Update_ImportCompany);

	if ($Update_Query) 
	{
		echo "<script>window.alert('Import Company Update Successfully completed.')</script>";
		echo "<script>window.location = 'ImportCompanyLogin.php'</script>";
	}	
	else
	{
		echo "<p>Cannot update the information.Please check your information".mysqli_error($connect)."</p>";	
	}
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Import Company Update</title>
 </head>
 <body>
 	<form action="ImportCompanyUpdate.php" method="Post">
 		<fieldset>
 			<legend>Import Company Update</legend>
 			<h1 align="center">Update your account information here</h1>
 			<table align="center">
 				<tr>
				<td>Import Company ID</td>
				<td>
					<input type="text" name="txtImportCompanyID" value="<?php echo $_SESSION['ImportCompanyID'] ?>" readonly>
				</td>
			</tr>
			<tr>
				<td>Import Company Name</td>
				<td>
					<input type="text" name="txtImportCompanyName" placeholder="Import Company Name" value="<?php echo $_SESSION['ImportCompanyName'] ?>" required>
				</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>
					<textarea cellpadding = '4px' name="txtDescription" placeholder="Company Description"  required></textarea>
				</td>
			</tr>
			<tr>
				<td>Password</td>
				<td>
					<input type="Password" name="txtPassword" placeholder="Password" value="<?php echo $_SESSION['Password'] ?>">
				</td>
			</tr>
			<tr>
				<td><input type="Submit" name="btnUpdate" value="Update"></td>
				<td><input type="Reset" value="Redo"></td>
				<td><a href="ImportCompanyDelete.php">Delete</a></td>
			</tr>
 			</table>
 		</fieldset>
 	</form>
 </body>
 </html>