<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_REQUEST['DeliveryID'])) 
{
	$DeliveryID=$_REQUEST['DeliveryID'];
	$select="SELECT * From delivery
			WHERE DeliveryID='$DeliveryID'";
	$ret=mysqli_query($connect,$select);
	$req=mysqli_fetch_array($ret);
	$did=$req['DeliveryID'];
	$date=$req['DeliveryDate'];
	$des=$req['Description'];
	$dr=$req['DeliveryRoute'];
	$dsid=$req['DeliveryStaffID'];
}

if (isset($_POST['btnUpdate'])) 
{
	$DeliveryID=$_POST['txtDeliveryID'];
	$DeliveryDate=$_POST['txtDeliveryDate'];
	$Description=$_POST['txtDescription'];
	$DeliveryRoute=$_POST['txtDeliveryRoute'];
	$DeliveryStaffID=$_POST['cboDeliveryStaffID'];
	$Update_Delivery="UPDATE `delivery` 
					  SET `DeliveryID`='$DeliveryID',
					      `DeliveryDate`='$DeliveryDate',
					      `Description`='$Description',
					      `DeliveryRoute`='$DeliveryRoute',
					      `DeliveryStaffID`='$DeliveryStaffID' 
					  WHERE `DeliveryID`='$DeliveryID'";
	$Update_Query=mysqli_query($connect,$Update_Delivery);

	if ($Update_Query) 
	{
		echo "<script>window.alert('Delivery Updated')</script>";
		echo "<script>window.location='Delivery.php'</script>";
	}
	else
	{
		echo "<p>Delivery Update Failed!" . mysqli_error($connect). "</p>";
		echo "<script>window.location='Delivery.php'</script>";
	}
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Delivery</title>

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

<form action="DeliveryUpdate.php" method="Post">
		<fieldset>
			<legend>Delivery</legend>
			<h1 align="center">Delivery Assignment</h1>
			<table align="center">

				<!-- Staff Name and User name -->
				<tr>
					<td>Delivery ID</td>
					<td>
						<input type="text" name="txtDeliveryID" value="<?php echo $did ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>Delivery Date</td>
					<td>
						<input type="Date" name="txtDeliveryDate" value="<?php echo $date ?>" required>
					</td>
				</tr>
				<tr>
					<td>Description</td>
					<td><input type="text" name="txtDescription" value="<?php echo $des ?>" required></td>
				</tr>
				<tr>
					<td>Delivery Route</td>
					<td><input type="text" name="txtDeliveryRoute" value="<?php echo $dr ?>" required></td>
				</tr>
				<tr>
					<td>Delivery Staff ID</td>
					<td>
					<select name="cboDeliveryStaffID" value="<?php echo $dsid ?>">
			<option>Delivery Staff ID</option>
			<?php 
			$DeliveryStaff_Select="SELECT * FROM DeliveryStaff";
			$Query=mysqli_query($connect,$DeliveryStaff_Select);
			$count=mysqli_num_rows($Query);

			for($i=0;$i<$count;$i++) 
			{ 
				$rows=mysqli_fetch_array($Query);
				$DeliveryStaffID=$rows['DeliveryStaffID'];
				$DeliveryStaffName=$rows['DeliveryStaffName'];

				echo "<option value='$DeliveryStaffID'> $DeliveryStaffID - $DeliveryStaffName </option>";
			}
			?>
		</select>
	</td>
				</tr>
				
				<td></td>
				<td>
					<input type="Submit" name="btnUpdate" value="Update">
					<input type="Reset" value="Clear">
				</td>
			</table>
		</fieldset>
		</table>
</form>
 </body>
 </html>