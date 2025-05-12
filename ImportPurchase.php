<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnProceed'])) 
{
	$PurchaseID = $_POST['txtPurchaseID'];
	$PurchaseDate = $_POST['txtPurchaseDate'];
	$Purchase = $_POST['txtPurchase'];
	$Quantity = $_POST['txtQuantity'];
	$Purchase_Amount = $_POST['txtPurchaseAmount'];
	$Description = $_POST['txtDescription'];
	$ImportCompanyID = $_SESSION['ImportCompanyID'];

	$Purchase_Insert = "INSERT INTO `purchase`(`PurchaseID`,`PurchaseDate`,`Purchase`,`Quantity`,`Purchase_Amount`,`Description`,`ImportCompanyID`) VALUES ('$PurchaseID','$PurchaseDate','$Purchase','$Quantity','$Purchase_Amount','$Description','$ImportCompanyID')";
	$Insert_Query = mysqli_query($connect,$Purchase_Insert);
	$PurchaseDetails_Insert = "INSERT INTO `purchasedetails`(`PurchaseID`) VALUES ('$PurchaseID')";
	$Insert_Query2 = mysqli_query($connect,$PurchaseDetails_Insert);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Your import purchase is successfully completed!')</script>";
		echo "<script>window.location = 'ImportPurchase.php'</script>";	
	}
	else
	{
		echo "<script>window.alert('Purchase Failed! Please check your information and try again')".mysqli_error($connect)."</script>";
		echo "<script>window.location = 'ImportPurchase.php'</script>";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Import Purchase</title>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <script>
$(document).ready( function (){
$('#tableid').DataTable();
	} );
</script>
<form action = "ImportPurchase.php" method="Post">
	<h3>Welcome <?php echo $_SESSION['ImportCompanyName'] ?></h3>
	<fieldset>
		<legend>Import Purchase</legend>
		<h1 align="center">Purchase your import here</h1>
		<table align="center">
			<tr>
				<td>PurchaseID</td>
				<td>
					<input type="text" name="txtPurchaseID" value="<?php echo AutoID('purchase','PurchaseID','IP-',6) ?>" readonly>
				</td>
			</tr>

			<tr>
				<td>Purchase Date</td>
				<td>
					<input type="text" name="txtPurchaseDate" value="<?php echo date('Y-m-d') ?>" readonly>
				</td>
			</tr>

			<tr>
				<td>Purchase</td>
				<td>
					<input type="text" name="txtPurchase" placeholder="Purchase" required>
				</td>
			</tr>

			<tr>
				<td>Quantity</td>
				<td>
					<input type="text" name="txtQuantity" placeholder="Quantity" required>
				</td>
			</tr>

			<tr>
				<td>Purchase Amount</td>
				<td>
					<input type="text" name="txtPurchaseAmount" placeholder="Purchase Amount" required>
				</td>
			</tr>

			<tr>
				<td>Description</td>
				<td>
					<textarea name="txtDescription" placeholder="Description" required></textarea>
				</td>
			</tr>

			<!-- <tr>
			<td>Import Company ID</td>
				<td>
					<input type="text" name="txtImportCompanyID" alue="<?php echo $_SESSION['Password'] ?>"" readonly>
				</td>
			</tr> -->

			<tr>
				<td>
					<input type="Submit" name="btnProceed" value="Proceed">
					<input type="Reset" value="Clear">
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>Purchase List:</legend>
		<table id = "tableid" class="display" align="center" width="100%" border="1">
			<thead>
				<tr>
					<th>Purchase ID</th>
					<th>Purchase Date</th>
					<th>Purchase</th>
					<th>Quantity</th>
					<th>Purchase Amount</th>
					<th>Description</th>
					<th>Import Company ID</th>
				</tr>
			</thead>
			<?php 
				$Select_Purchase = "SELECT * FROM purchase";
				$Purchase_Query = mysqli_query($connect,$Select_Purchase);
				$Purchase_Count = mysqli_num_rows($Purchase_Query);
				for ($i=0; $i < $Purchase_Count ; $i++) 
				{ 
					$rows = mysqli_fetch_array($Purchase_Query);
					$PurchaseID = $rows['PurchaseID'];

					echo "<tr>";
					echo "<td>$PurchaseID</td>";
					echo "<td>".$rows['PurchaseDate']."</td>";
					echo "<td>".$rows['Purchase']."</td>";
					echo "<td>".$rows['Quantity']."</td>";
					echo "<td>".$rows['Purchase_Amount']."</td>";
					echo "<td>".$rows['Description']."</td>";
					echo "<td>".$_SESSION['ImportCompanyID']."</td>";
					echo "<td>
						 <a href = 'ImportPurchaseUpdate.php?PurchaseID=$PurchaseID'>Update</a> |
						 <a href = 'ImportPurchaseDelete.php?PurchaseID=$PurchaseID'>Delete</a>
						 </td>";
				    echo "</tr>";
				}
			 ?>
		</table>
	</fieldset>
</form>
 </body>
 </html>