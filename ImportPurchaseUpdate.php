<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');
if (isset($_POST['btnUpdate'])) 
{
	$PurchaseID = $_POST['txtPurchaseID'];
	$PurchaseDate = $_POST['txtPurchaseDate'];
	$Purchase = $_POST['txtPurchase'];
	$Quantity = $_POST['txtQuantity'];
	$Purchase_Amount = $_POST['txtPurchaseAmount'];
	$Description = $_POST['txtDescription'];

	$Update_Purchase = "UPDATE `purchase`
						SET `PurchaseID` = '$PurchaseID',
							`PurchaseDate` = '$PurchaseDate',
							`Purchase` = '$Purchase',
							`Quantity` = '$Quantity',
							`Purchase_Amount` = '$Purchase_Amount',
							`Description` = '$Description'
						WHERE `PurchaseID`= '$PurchaseID'";
	$Update_Query = mysqli_query($connect,$Update_Purchase);

	if ($Update_Query) 
	{
			echo "<script>window.alert('Your purchase has successfully updated!')</script>";
			echo "<script>window.location = 'ImportPurchase.php'</script>";
	}	
	else
	{
		echo "<p>Cannot Update Information. Please Check your infomation.".mysqli_error($connect)."</p>";
	}
}
if (isset($_GET['PurchaseID'])) 
{
	$PurchaseID=$_GET['PurchaseID'];

	$Select_Query = "SELECT * FROM Purchase WHERE PurchaseID = '$PurchaseID'";
	$ret = mysqli_query($connect,$Select_Query);
	$rows = mysqli_fetch_array($ret);	
}
else
{
	$PurchaseID = "";
	echo "<script>window.alert('An error occurred. PurchaseID not Found')</script>";
	echo "<script>window.location = 'ImportPurchase.php'</script>";
	exit();
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Import Purchase Update</title>
 	 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
 </head>
 <body>
 <form action="ImportPurchaseUpdate.php" method="Post">
 	<fieldset>
 		<legend>Import Purchase Update</legend>
 		<h1 align="center">Update your purchase information</h1>
 		<table align="center">
 			<tr>
 				<td>PurchaseID</td>
 				<td>
 					<input type="text" name="txtPurchaseID" value="<?php echo $rows['PurchaseID'] ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Purchase Date</td>
 				<td>
 				<input type="text" name="txtPurchaseDate" value="<?php echo $rows['PurchaseDate'] ?>" placeholder = "Purchase Date" required></td>
 			</tr>

 			<tr>
 				<td>Purchase</td>
 				<td>
 					<input type="text" name="txtPurchase" value="<?php echo $rows['Purchase'] ?>" placeholder = "Purchase" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Quantity</td>
 				<td>
 					<input type="text" name="txtQuantity" value="<?php echo $rows['Quantity'] ?>" placeholder = "Quantity" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Purchase Amount</td>
 				<td>
 					<input type="text" name="txtPurchaseAmount" value="<?php echo $rows['Purchase_Amount'] ?>" placeholder="Purchase Amount" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Description</td>
 				<td>
 					<input type="text" name="txtDescription" value="<?php echo $rows['Description']?>" placeholder = "Description" required>
 				</td>
 			</tr>

 			<tr>
 				<td><input type="Submit" name="btnUpdate" value="Update"></td>
 				<td><input type="Reset" value="Redo"></td>
 			</tr>
 		</table>
 	</fieldset>
 </form>
 </body>
 </html>