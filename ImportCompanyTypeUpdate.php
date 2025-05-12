<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');
if (isset($_POST['btnUpdate'])) 
{
	$ImportCompanyTypeID = $_POST['txtImportCompanyTypeID'];
	$ImportCompanyType = $_POST['txtImportCompanyType'];
	$Update_ImportCompanyType = "UPDATE `importcompanytype`
									SET `ImportCompanyTypeID` = '$ImportCompanyTypeID',
										`ImportCompanyType` = '$ImportCompanyType'
								 WHERE  `ImportCompanyTypeID` = '$ImportCompanyTypeID'";
	$Update_Query = mysqli_query($connect,$Update_ImportCompanyType);
	if ($Update_Query) 
	{
		echo "<script>window.alert('Import Company Type Updated!')</script>";
		echo "<script>window.location = 'ImportCompanyTypeRegistration.php'";		
	}	
	else
	{
		echo "<p>Cannot Update your type. Please check your information" . mysqli_error($connect). "</p>";
	}
}
if (isset($_GET['ImportCompanyTypeID'])) 
{
	$ImportCompanyTypeID=$_GET['ImportCompanyTypeID'];

	$Select_Query = "SELECT * FROM importcompanytype WHERE ImportCompanyTypeID = '$ImportCompanyTypeID'";
	$ret = mysqli_query($connect,$Select_Query);
	$rows = mysqli_fetch_array($ret);	
}
else
{
	$ImportCompanyTypeID = "";
	echo "<script>window.alert('An error occurred. ImportCompanyTypeID not Found')</script>";
	echo "<script>window.location = 'ImportCompanyTypeRegistration.php'</script>";
	exit();
}
?>
<!DOCTYPE html>
 <html>
 <head>
 	<b><title>Import Company Type Update</title></b>

 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />


 </head>
 <body>

<form action= 'ImportCompanyTypeUpdate.php' method="Post">
	<fieldset>
		<legend>Import Company Type Update</legend>
		<h1 align="center">Import Company Type Update Form</h1>
		<table align="center">
			<tr>
				<td>Import Company Type ID</td>
				<td>
					<input type="text" name="txtImportCompanyTypeID" value="<?php echo $rows['ImportCompanyTypeID'] ?>"readonly> 
				</td>
			</tr>

			<tr>
				<td>Import Company Type</td>
				<td><input type="text" name="txtImportCompanyType" value="<?php echo $rows['ImportCompanyType'] ?>" placeholder = "Import Company Type" required></td>
			</tr>

			<tr>
				<td>
					<input type="Submit" name="btnUpdate" value="Update">
					<input type="Reset" name="Clear" value="Clear">
				</td>
			</tr>
		</table>
	</fieldset>
	</form>
 </body>
 </html>