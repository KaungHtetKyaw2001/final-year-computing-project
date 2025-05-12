<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$ImportCompanyTypeID = $_POST['txtImportCompanyTypeID'];
	$ImportCompanyType   = $_POST['txtImportCompanyType'];
	$Insert_ImportCompanyType = "INSERT INTO `importcompanytype`(`ImportCompanyTypeID`,`ImportCompanyType`) VALUES ('$ImportCompanyTypeID','$ImportCompanyType')";
	$Insert_Query = mysqli_query($connect,$Insert_ImportCompanyType);
	if ($Insert_Query) 
	{
		echo "<script>window.alert('Import Company Type is registered')</script>";	
		echo "<script>window.location = 'ImportCompanyTypeRegistration.php'</script>";
	}
	else
	{

		echo"<p>Import Company Type registration failed!". mysqli_error($connect)."</p>";
		echo"<script> window.location= 'ImportCompanyTypeRegistration.php'</script>";
	}
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<b><title>Import Company Type Registration</title></b>

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

<form action= 'ImportCompanyTypeRegistration.php' method="Post">
	<fieldset>
		<legend>Import Company Type Registration</legend>
		<h1 align="center">Import Company Type Registration Form</h1>
		<table align="center">
			<tr>
				<td>Import Company Type ID</td>
				<td>
					<input type="text" name="txtImportCompanyTypeID" value="<?php echo AutoID('importcompanytype','ImportCompanyTypeID','ICT-',6) ?>"readonly> 
				</td>
			</tr>

			<tr>
				<td>Import Company Type</td>
				<td><input type="text" name="txtImportCompanyType" placeholder="Import Company Type" required></td>
			</tr>

			<tr>
				<td>
					<input type="Submit" name="btnRegister" value="Register">
					<input type="Reset" value="Clear">
				</td>
			</tr>
		</table>
	</fieldset>

	<fieldset>
		<legend>Import Company Type List:</legend>
		<table id ="tableid" class="display" align="center" width="50%" border="1">
		<thead align="center">
			<tr>
				<th>Import Company Type ID</th>
				<th>Import Company type</th><br>
			</tr>
		</thead>
		<tbody>
			<?php 
			$Select_ImportCompanyType="SELECT * FROM ImportCompanyType";
			$ImportCompanyType_Query=mysqli_query($connect,$Select_ImportCompanyType);
			$ImportCompanyType_Count=mysqli_num_rows($ImportCompanyType_Query);

			for ($i=0; $i <$ImportCompanyType_Count ; $i++) 
			{ 
				$rows=mysqli_fetch_array($ImportCompanyType_Query);
				$ImportCompanyTypeID=$rows['ImportCompanyTypeID'];

				echo "<tr align='center'>";
					echo "<td>$ImportCompanyTypeID</td>";
					echo "<td>" . $rows['ImportCompanyType']."</td>";
					echo "<td>
				<a href='ImportCompanyTypeUpdate.php?ImportCompanyTypeID=$ImportCompanyTypeID'>Update</a> |
				 <a href='ImportCompanyTypeDelete.php?ImportCompanyTypeID=$ImportCompanyTypeID'>Delete</a>
				  </td>";
				  echo"</tr>";
			}
			 ?>
		</tbody>
	</table>
	</fieldset>
</form>
 </body>
 </html>