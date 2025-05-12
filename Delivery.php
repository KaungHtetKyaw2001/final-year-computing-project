<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$DeliveryID = $_POST['txtDeliveryID'];
	$DeliveryDate = $_POST['txtDeliveryDate'];
	$Description = $_POST['txtDescription'];
	$DeliveryRoute = $_POST['txtDeliveryRoute'];
	$DeliveryStaffID = $_POST['cboDeliveryStaffID'];

	$Insert_Delivery = "INSERT INTO delivery(DeliveryID, DeliveryDate, Description, DeliveryRoute, DeliveryStaffID) VALUES ('$DeliveryID','$DeliveryDate','$Description','$DeliveryRoute','$DeliveryStaffID')";
	$Insert_Query = mysqli_query($connect,$Insert_Delivery);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Delivery Registered')</script>";
		echo "<script>window.location = 'Delivery.php'</script>";
	}
	else
	{
		echo "<p>Delivery Registered Failed! Please check your information and data." . mysqli_error($connect). "</p>";
		echo "<script> window.location = 'Delivery.php'</script>";
	}
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
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

<form action="Delivery.php" method="Post">
	<fieldset>
		<legend>Delivery</legend>
		<h1 align="center">Delivery Assignment</h1>
		<table align="center">
			<tr>
				<td>Delivery ID</td>
				<td>
					<input type="text" name="txtDeliveryID" value="<?php echo AutoID('Delivery','DeliveryID','D-',6) ?>" readonly>
				</td>
			</tr>
			
			<tr>
				<td>Delivery Date</td>
				<td>
					<input type="Date" name="txtDeliveryDate" placeholder="YY/MM/DD" required="">
				</td>
			</tr>

			<tr>
				<td>Description</td>
				<td>
					<textarea cellpadding = '4px' name="txtDescription" required></textarea>
				</td>
			</tr>

			<tr>
				<td>Delivery Route</td>
				<td>
					<input type="text" name="txtDeliveryRoute" required>
				</td>
			</tr>

			<tr>
				<td>Delivery Staff ID</td>
				<td>
					<select name="cboDeliveryStaffID">
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

			<tr>
				<td>
					<input type="Submit" name="btnRegister" value="Register">
					<input type="Reset" name="Clear">
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
	<legend>Delivery List:</legend>
	<table id = "tableid" class="display">
		<thead>
			<tr>
	<th>DeliveryID</th>
	<th>Delivery Date</th>
	<th>Description</th>
	<th>Delivery Route</th>
	<th>Delivery Staff ID</th>
		   </tr>
		</thead>
		<tbody>
<?php  
	
	$Select_Delivery="SELECT * FROM delivery";
	$Delivery_Query=mysqli_query($connect,$Select_Delivery);
	$Delivery_Count=mysqli_num_rows($Delivery_Query);

	for($i=0;$i<$Delivery_Count;$i++) 
	{ 
		$rows=mysqli_fetch_array($Delivery_Query);
		$DeliveryID=$rows['DeliveryID'];
		// $StaffID=$_SESSION['StaffID'];
		echo "<tr>";
			echo "<td>$DeliveryID</td>";
			echo "<td>" . $rows['DeliveryDate'] . "</td>";
			echo "<td>" . $rows['Description'] . "</td>";
			echo "<td>" . $rows['DeliveryRoute'] . "</td>";
			echo "<td>" . $rows['DeliveryStaffID'] . "</td>";
			echo "<td>
				  <a href='DeliveryUpdate.php?DeliveryID=$DeliveryID'>Update</a> |
				  <a href='DeliveryDelete.php?DeliveryID=$DeliveryID'>Delete</a>
				  </td>";
		echo "</tr>";
	}
?>
		</tbody>
	</table>
</fieldset>
</form>
 </body>
 </html>