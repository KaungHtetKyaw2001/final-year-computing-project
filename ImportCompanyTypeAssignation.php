<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');


if (isset($_REQUEST['ImportCompanyID'])) 
{
	$ImportCompanyID = $_REQUEST['ImportCompanyID'];
	$query="SELECT * FROM importcompany WHERE ImportCompanyID = '$ImportCompanyID'";
	$result = mysqli_query($connect,$query);
	$row1= mysqli_fetch_array($result);

	$ImportCompanyID = $row1['ImportCompanyID'];
	$ImportCompanyName = $row1['ImportCompanyName'];
	$Description = $row1['Description'];

}
	
	
if (isset($_POST['btnAssign'])) 
{
	$ImportCompanyTypeID = $_POST['cboImportCompanyTypeID'];
	$Update_ImportCompanyType = "UPDATE `importcompany`
								SET `ImportCompanyTypeID` = '$ImportCompanyTypeID'
								WHERE ImportCompanyID = '$ImportCompanyID'";
	$Update_Query = mysqli_query($connect,$Update_ImportCompanyType);
	if ($Update_Query) 
	{
		echo "<script>window.alert('Import company type is assigned to this import company successfully!')</script>";
		echo "<script>window.location='ImportCompanyTypeAssign.php'</script>";	
	}
	else
	{
		echo "<script>window.alert('Cannot assign to this import company!')".mysqli_error($connect)."</script>";
		echo "<script>window.location='ImportCompanyTypeAssignation.php'</script>";
	}


}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Import Company Type Assignation</title>
 	<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <form action="ImportCompanyTypeAssignation.php" method="Post">
 	<fieldset>
 		<legend>Import Company Type Assignation</legend>
 		<h1 align="center">Assign Import Company Type Here!</h1>
 		<table align="center">
 			
 			<tr>
 				<td>Import Company ID</td>
 				<td>
 					<input type="text" name="txtImportCompanyID" value="<?php echo $row1['ImportCompanyID'] ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Import Company Name</td>
 				<td>
 					<input type="text" name="txtImportCompanyName" placeholder="Enter Import Company Name" value="<?php echo $row1['ImportCompanyName'] ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Description</td>
 				<td>
 					<input type="text" name="txtDescription" width="50%" value="<?php echo $row1['Description'] ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Import Company Type ID</td>
 				<td>
 					<select name = "cboImportCompanyTypeID">
 					<option>->Choose Import Company Type ID<-</option>
 					<?php  
 					 $ImportCompanyType_query = "SELECT * FROM importcompanytype";
 					 $ret = mysqli_query($connect,$ImportCompanyType_query);
 					 $count = mysqli_num_rows($ret);

 					 for ($i=0; $i < $count ; $i++) 
 					 { 
 					 	$rows = mysqli_fetch_array($ret);
 					 	$ImportCompanyTypeID = $rows['ImportCompanyTypeID'];
 					 	$ImportCompanyType = $rows['ImportCompanyType'];

 					 	echo "<option value = '$ImportCompanyTypeID' > $ImportCompanyTypeID - $ImportCompanyType</option>";
 					 }
 					?>
 					</select>
 				</td>
 			</tr>
 			<td>
 				<td>
 					<input type="Submit" name="btnAssign" value="Assign">
 					<input type="Reset" name="Clear">
 				</td>
 			</td>
 		</table>
 	</fieldset>
 </form>
 </body>
 </html>