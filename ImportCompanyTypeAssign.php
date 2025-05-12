<?php 
session_start();
include('Connect.php');
if (isset($_POST['Assign'])) 
{
	$_SESSION["ImportCompanyID"]=$rows['ImportCompanyID'];	
}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Import Company Type Assign</title>

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

<form action="ImportCompanyTypeAssign.php" method="post">
	<fieldset>
		<legend>Import Company Type Assign</legend>
		<?php 

		$ImportCompanySelect = "SELECT * FROM importcompany";
		$Query = mysqli_query($connect,$ImportCompanySelect);
		$size = mysqli_num_rows($Query);
		 ?>
		 <table id = "tableid" class="display">
		 	<thead>
		 		<tr>
		 			<th>No</th>
		 			<th>Import Company ID</th>
		 			<th>Import Company Name</th>
		 			<th>Description</th>
		 			<th>Password</th>
		 			<th>Import Company Type ID</th>
		 		</tr>
		 	</thead>
		 	<tbody align="center">
		 		<?php 
		 		for ($i=0; $i < $size ; $i++) 
		 		{ 
		 		 	$rows = mysqli_fetch_array($Query);
		 		 	$ImportCompanyID = $rows['ImportCompanyID'];

		 		 	echo "<tr>";
		 		 	echo "<td>".($i+1)."</td>";
		 		 	echo "<td>".$rows['ImportCompanyID']."</td>";
		 		 	echo "<td>".$rows['ImportCompanyName']."</td>";
		 		 	echo "<td>".$rows['Description']."</td>";
		 		 	echo "<td>".$rows['Password']."</td>";
		 		 	echo "<td><a href = 'ImportCompanyTypeAssignation.php?ImportCompanyID=$ImportCompanyID'>Assign</a></td>";
		 		 	echo "</tr>";
		 		} ?>
		 	</tbody>
		 </table>
	</fieldset>
</form>
</body>
</html>