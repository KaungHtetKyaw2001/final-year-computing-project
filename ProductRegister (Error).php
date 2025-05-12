<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$ProductID = $_POST['txtProductID'];
	$ProductName = $_POST['txtProductName'];
	$Logo = $_POST['txtLogo'];
	$Quantity = $_POST['txtQuantity'];
	$Description = $_POST['txtDescription'];
	$Price = $_POST['txtPrice'];
    $ProductImage1=$_FILES['txtProductImage1']['name'];
	$Folder="ProductImage/";

	$FileName1=$Folder . '_' . $ProductImage1; //ProductImage/_Shirt1.jpg

	$copied=copy($_FILES['txtProductImage1']['tmp_name'], $FileName1);

	if(!$copied) 
	{
		echo "<p>Product Image 1 cannot upload!</p>";
		exit();
	}
	//======================================================
	$ProductImage2=$_FILES['txtProductImage2']['name']; //Product2.jpg
	$Folder="ProductImage/";

	$FileName2=$Folder . '_' . $ProductImage2; //ProductImage/_Shirt1.jpg

	$copied=copy($_FILES['txtProductImage2']['tmp_name'], $FileName2);

	if(!$copied) 
	{
		echo "<p>Product Image 2 cannot upload!</p>";
		exit();
	}
	//======================================================
	// $ImportID = $_POST['cboImportID'];
	$ProductTypeID = $_POST['cboProductTypeID'];
	$StaffID = $_POST['cboStaffID'];

	$Insert_Product = "INSERT INTO `product`(`ProductID`,`ProductName`,`Logo`,`Quantity`,`Description`,`Price`,`ProductImage1`,`ProductImage2`,`ImportID`,`ProductTypeID`,`StaffID`) VALUES ('$ProductID','$ProductName','$Logo','$Quantity','$Description','$Price','$ProductImage1','$ProductImage2','$ProductTypeID','$StaffID')";
	$Insert_PurchaseDetails = "INSERT INTO `purchasedetails`(`ProductID`) VALUES('$ProductID')";
	$Insert_Query = mysqli_query($connect,$Insert_Product);
	$Insert_Query2 = mysqli_query($connect,$Insert_PurchaseDetails);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Product Registration completed.')</script>";
		echo "<script>window.location = 'ProductRegister.php'</script>";
	}
	else
	{
		echo "<p>Product Registration Failed!".mysqli_error($connect)."</p>";
		echo "<script>window.location='ProductRegister.php'</script>";
	}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Product Register</title>

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

 <form action="ProductRegister.php" method="Post" enctype="multipart/form-data">
 	<fieldset>
 		<legend>Product Register</legend>
 		<h1 align="center">Register your product here</h1>
 		<table align="center">
 			<tr>
 				<td>Product ID</td>
 				<td>
 					<input type="text" name="txtProductID" value="<?php echo AutoID('Product','ProductID','P-',6) ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Product Name</td>
 				<td>
 					<input type="text" name="txtProductName" placeholder="Product Name" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Logo</td>
 				<td>
 					<input type="text" name="txtLogo" placeholder="Logo name" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Quantity</td>
 				<td>
 					<input type="text" name="txtQuantity" placeholder="Quantity" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Description</td>
 				<td>
 					<textarea name="txtDescription" placeholder="Product Description" required></textarea>
 				</td>
 			</tr>

 			<tr>
 				<td>Price</td>
 				<td>
 					<input type="text" name="txtPrice" placeholder="Product Price" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Product Image 1</td>
 				<td>
 					<input type="file" name="txtProductImage1" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Product Image 2</td>
 				<td>
 					<input type="file" name="txtProductImage2" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Product Type ID</td>
 				<td>
 					<select name="cboProductTypeID">
 						<option>-Choose Product Type ID-</option>
 				<?php 
 				$ProductType_Query = "SELECT * FROM producttype";
 				$ret = mysqli_query($connect,$ProductType_Query);
 				$count = mysqli_num_rows($ret);

 				for ($i=0; $i < $count ; $i++) 
 				{ 
 					$rows = mysqli_fetch_array($ret);
 					$ProductTypeID = $rows['ProductTypeID'];
 					$ProductType = $rows['ProductType'];

 					echo "<option value = '$ProductTypeID'> $ProductTypeID - $ProductType </option>";
 				}

 						 ?>
 					</select>
 				</td>
 			</tr>

 			<tr>
 				<td>Staff ID</td>
 				<td>
 				<select name="cboStaffID">
 					<option>-Choose Staff ID-</option>
 				<?php 
 				$Staff_Query = "SELECT * FROM staff";
 				$ret = mysqli_query($connect,$StaffID_Query);
 				$count = mysqli_num_rows($ret);

 				for ($i=0; $i < $count ; $i++) 
 				{ 
 					$rows = mysqli_fetch_array($ret);
 					$StaffID = $rows['StaffID'];
 					$StaffName = $rows['StaffName'];

 					echo "<option value = '$StaffID'> $StaffID - $StaffName </option>";
 				}
 				 ?>
 				</select>
 				</td>
 			</tr>
 			<td>
 				<input type="submit" name="btnRegister" value="Register">
 				<input type="Reset" value="Clear">
 			</td>
 		</table>
 	</fieldset>

 	<fieldset>
 		<legend>Products List:</legend>
 		<table id="tableid" class="display" align="center">
 			<thead>
 				<tr>
 					<th>Product ID</th>
 					<th>Product Name</th>
 					<th>Logo</th>
 					<th>Quantity</th>
 					<th>Description</th>
 					<th>Price</th>
 					<th>Product Image 1</th>
 					<th>Product Image 2</th>
 					<th>Product Type ID</th>
 					<th>Staff ID</th>
 				</tr>
 			</thead>
 			<tbody>
 				<?php 

 				$Select_Product = "SELECT * FROM product"; 
 				$Product_Query =mysqli_query($connect,$Select_Product);
 				$Product_Count =mysqli_num_rows($Product_Query);

 				for ($i=0; $i < $Product_Count ; $i++) 
 				{ 
 					$rows = mysqli_fetch_array($Product_Query);
 					$ProductID= $rows['ProductID'];

 					echo "<tr>";
 					echo "<td>$ProductID</td>";
 					echo "<td>".$rows['ProductName']."</td>";
 					echo "<td>".$rows['Logo']."</td>";
 					echo "<td>".$rows['Quantity']."</td>";
 					echo "<td>".$rows['Description']."</td>";
 					echo "<td>".$rows['Price']."</td>";
 					$img1 = $rows['ProductImage1'];
 					echo "<td>"."<img src='$img1' width='100px' height='auto'>"."</td>";
 					$img2 = $rows['ProductImage2'];
 					echo "<td>"."<img src='$img2' width='100px' height='auto'>"."</td>";
 					echo "<td>".$rows['ProductTypeID']."</td>";
 					echo "<td>".$rows['StaffID']."</td>";
 					echo "<td><a href = 'ProductUpdate.php? ProductID = $ProductID'>Update</a> | <a href = 'ProductDelete.php? ProductID = $ProductID'>Delete</a></td>";
 					echo "</tr>";
 				}

 				?>
 			</tbody>
 		</table>
 	</fieldset>
 </form>
 </body>
 </html>