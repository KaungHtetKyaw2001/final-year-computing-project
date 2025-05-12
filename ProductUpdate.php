<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_REQUEST['ProductID'])) 
{
	$ProductID = $_REQUEST['ProductID'];
	$Update_Query = "SELECT * FROM product WHERE ProductID = '$ProductID'";
	$Result = mysqli_query($connect,$Update_Query);
	$Ret = mysqli_fetch_array($Result);

	$ProductID = $Ret['ProductID'];
	$ProductName = $Ret['ProductName'];
	$Logo = $Ret['Logo'];
	$Quantity = $Ret['Quantity'];
	$Description = $Ret['Description'];
	$Price = $Ret['Price'];
	$ProductImage1 = $Ret['ProductImage1'];
	$ProductImage2 = $Ret['ProductImage2'];
	$ProductTypeID = $Ret['ProductTypeID'];;
	$StaffID = $Ret['StaffID'];
}

if (isset($_POST['btnUpdate'])) 
{
	$ProductID = $_POST['txtProductID'];
	$ProductName = $_POST['txtProductName'];
	$Logo = $_POST['txtLogo'];
	$Quantity = $_POST['txtQuantity'];
	$Description = $_POST['Description'];
	$Price = $_POST['Price'];
	$Image1=$_FILES['txtProductImage1']['name'];
	$ProductImage1='ProductImage/';
	if ($ProductImage1) 
	{
		$filename1=$ProductImage1."_".$Image1;
 			$Copied=copy($_FILES['txtProductImage2']['tmp_name'],$filename1);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}
	$Image2=$_FILES['txtProductImage2']['name'];
	$ProductImage2='ProductImage/';
	if ($ProductImage2) 
	{
		$filename2=$ProductImage2."_".$Image2;
 			$Copied=copy($_FILES['txtProductImage2']['tmp_name'],$filename2);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}
	$ProductTypeID = $_POST['cboProductTypeID'];
	$StaffID = $_POST['cboStaffID'];

	$Update_Product = "UPDATE `product`
					   SET `ProductID` = '$ProductID',
					   	   `ProductName` = '$ProductName',
					   	   `Logo`= '$Logo',
					   	   `Quantity` = '$Quantity',
					   	   `Description` = '$Description',
					   	   `Price` = '$Price',
					   	   `ProductImage1` = '$filename1',
					   	   `ProductImage2` = '$filename2',
					   	   `ProductTypeID` = '$ProductTypeID',
					   	   `StaffID` = '$StaffID'
					   	WHERE `ProductID` = '$ProductID'";
	$Update_Query = mysqli_query($connect,$Update_Product);

	if ($Update_Query) 
	{
		echo "<script>window.alert('Product Information Updated.')</script>";
		echo "<script>window.location='ProductRegister.php</script>";
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
 	<meta charset="utf-8">
 	<title>Product Update</title>

 	<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <form action="ProductUpdate.php" method="Post" enctype="multipart/form-data">
 	<fieldset>
 		<legend>Product Update</legend>
 		<h1 align="center">Product Update</h1>
 		<table align="center">
 			<tr>
 				<td>Product ID</td>
 				<td>
 					<input type="text" name="txtProductID" value="<?php echo $ProductID ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Product Name</td>
 				<td>
 					<input type="text" name="txtProductName" value="<?php echo $ProductName ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Logo</td>
 				<td>
 					<input type="text" name="txtLogo" value="<?php echo $Logo ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Quantity</td>
 				<td>
 					<input type="text" name="txtQuantity" value="<?php echo $Quantity ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Description</td>
 				<td>
 					<input type="text" name="txtDescription" value="<?php echo $Description ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Price</td>
 				<td>
 					<input type="text" name="txtPrice" value="<?php echo $Price ?>">
 				</td>
 			</tr>

 			<tr>
 				<td>Product Image 1</td>
 				<td>
 					<input type="file" name="txtProductImage1" value="<?php echo $ProductImage1 ?>">
 				</td>
 			</tr>

 			<tr>
 				<td>Product Image 2</td>
 				<td>
 					<input type="file" name="txtProductImage2" value="<?php echo $ProductImage2 ?>">
 				</td>
 			</tr>

 			<tr>
					<td>Product Type ID</td>
		<td>
		<select name="cboProductTypeID">
			<option>-Choose Product Type ID-</option>
			<?php 
			$ProductType_query="SELECT * FROM producttype";
			$ret=mysqli_query($connect,$ProductType_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$ProductTypeID=$rows['ProductTypeID'];
				$ProductType=$rows['ProductType'];
				$ProductSpecificType=$rows['ProductSpecificType'];


				echo "<option value='$ProductTypeID'> $ProductTypeID - $ProductType - $ProductSpecificType</option>";
			}
			?>
		</select>
		</td>
			</tr>
			<tr>
					<td>Staff Type ID</td>
		<td>
		<select name="cboStaffID">
			<option>-Choose Staff ID-</option>
			<?php 
			$Staff_query="SELECT * FROM staff";
			$ret=mysqli_query($connect,$Staff_query);
			$count=mysqli_num_rows($ret);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($ret);
				$StaffID=$rows['StaffID'];
				$StaffName=$rows['StaffName'];

				echo "<option value='$StaffID'> $StaffID - $StaffName</option>";
			}
			?>
		</select>
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