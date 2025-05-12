<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');
 
if (isset($_POST['btnUpdate'])) 
{
	$ProductTypeID = $_POST['txtProductTypeID'];
	$ProductType = $_POST['txtProductType'];
	$Update_ProductType = "UPDATE `producttype`
						   SET `ProductType` = '$ProductType'
						   WHERE `ProductTypeID`= '$ProductTypeID'";
	$Update_Query = mysqli_query($connect,$Update_ProductType);
	if ($Update_Query) 
	{
		echo "<script>window.alert('Product Type Update Completed.')</script>";
		echo "<script>window.location = 'ProductTypeRegister.php'</script>";
	}
	else
	{
		echo "<p>Cannot update the information.Please check your information".mysqli_error($connect)."</p>";
	}
}
if (isset($_GET['ProductTypeID'])) 
{
	$ProductTypeID = $_GET['ProductTypeID'];
	$query = "SELECT * FROM producttype WHERE ProductTypeID = '$ProductTypeID'";
	$ret = mysqli_query($connect,$query);
	$rows=mysqli_fetch_array($ret);
}
else
{
	$ProductTypeID = "";
	echo "<script>window.alert('Something went wrong | Product Type ID not found')</script>";
	echo "<script>window.location = 'ProductTypeRegister.php'</script>";
	exit();
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Product Type Update</title>
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

<form action="ProductTypeUpdate.php" method="Post">
	<fieldset>
		<legend><h1 align="center">Product Type Update Form</h1></legend>
			<table align="center">
				<tr>
					<td>Product Type ID</td>
					<td>
						<input type="text" name="txtProductTypeID"
						value="<?php echo $rows['ProductTypeID'] ?>" readonly>
					</td>
				</tr>

				<tr>
					<td>Product Type</td>
					<td>
						<input type="text" name="txtProductType" placeholder="Product Type" value="<?php echo $rows['ProductType'] ?>" required>
					</td>
				</tr>

				<td>
					<input type="Submit" name="btnUpdate" value="Update">
					<input type="Reset" value="Clear">
				</td>
			</table>
	</fieldset>
</form>

</body>
</html>
