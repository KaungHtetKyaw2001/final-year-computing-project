<?php 
session_start();
include('Connect.php');

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Delivery Staff Schedules</title>

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

<form action="DeliveryStaffSchedule.php" method="Post">
	<fieldset>
		<legend>Delivery Staff Schedules</legend>
		<?php 

		$DeliverySelect = "SELECT * FROM delivery";
		$Query = mysqli_query($connect, $DeliverySelect);
		$Size = mysqli_num_rows($Query);
		 ?>
		 <table id="tableid" class="display">
		 	<thead>
		 		<tr>
		 			<th>No</th>
		 			<th>Delivery ID</th>
		 			<th>Delivery Date</th>
		 			<th>Description</th>
		 			<th>Delivery Route</th>
		 			<th>Delivery Staff ID</th>
		 		</tr>
		 	</thead>
		 	<tbody>
		 		<?php 
		 		for ($i=0; $i < $size; $i++) 
		 		{ 
		 			$rows = mysqli_fetch_array($Query);
		 			$DeliveryID = $rows['DeliveryID'];

		 			echo "<tr>";
			echo "<td>" . ($i + 1) . "</td>";
			echo "<td>" . $rows['DeliveryID'] . "</td>";
			echo "<td>" . $rows['DeliveryDate'] . "</td>";
			echo "<td>" . $rows['Description'] . "</td>";
			echo "<td>" . $rows['DeliveryRoute'] . "</td>";
			echo "<td>" . $rows['DeliveryStaffID'] . "</td>";
		echo "</tr>";
		 		}
		 		 ?>
		 	</tbody>
		 </table>
	</fieldset>
</form>
</body>
</html>