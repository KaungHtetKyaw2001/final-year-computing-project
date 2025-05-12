<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnSearch'])) 
{
	$searchType = $_POST['rdoSearchType'];

	if ($searchType == 1) 
	{
		$cboPurchaseID = $_POST['cboPurchaseID'];

		$SearchQuery = "SELECT * FROM purchase
						WHERE PurchaseID = '$cboPurchaseID'";
		$result = mysqli_query($connect,$SearchQuery);
		$size =mysqli_Num_rows($result); 	
	}
	elseif ($searchType == 2) 
	{
		$From = date('Y-m-d',strtotime($_POST['txtFromDate']));
		$To = date('Y-m-d',strtotime($_POST['txtToDate']));

		$SearchQuery = "SELECT * FROM purchase
						WHERE PurchaseDate BETWEEN '$From' AND '$To'";
		$result = mysqli_query($connect,$SearchQuery);
		$size = mysqli_Num_rows($result);	
	}
}
	elseif (isset($_POST['btnShowAll'])) 
	{
		$SearchQuery = "SELECT * FROM purchase";
		$result = mysqli_query($connect,$SearchQuery);
		$size = mysqli_Num_rows($result);
	}
	else
	{
		$today = date('Y-m-d');

		$SearchQuery = "SELECT * FROM purchase
						WHERE PurchaseDate = '$today'";
		$result = mysqli_query($connect,$SearchQuery);
		$size = mysqli_Num_rows($result);
	}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Import Purchase Search and Report</title>
 <script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css" />

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

<form action='ImportPurchaseSearch.php' method="post">
	<fieldset>
		<legend>Import Purchase Search and Report</legend>
		<table width="100%">
			<tr>
				<td>
					<input type="radio" name="rdoSearchType" value="1" checked> Search by Import Purchase ID
				<br/>
				<select name="cboPurchaseID">
					<option>-Select Import Purchase ID</option>
					<?php 
					$Purchase_query = "SELECT * FROM purchase";
					$result2 = mysqli_query($connect,$Purchase_query);
					$count = mysqli_Num_rows($result2);

				for ($i=0; $i < $count ; $i++) 
				{ 
					$rows1 = mysqli_Num_rows($result2);
					$PurchaseID = $rows1['PurchaseID'];
					echo "<option value = '$PurchaseID'>$PurchaseID </option>";
				}
					 ?>
				</select>
				</td>

				<td>
		<input type="radio" name="rdoSearchType" value="2" />Search by Date <br/>
		From <input type="text" name="txtFromDate" value="<?php echo date('Y-m-d') ?>" onClick="showCalender(calender,this)" />
		To <input type="text" name="txtToDate" value="<?php echo date('Y-m-d') ?>" onClick="showCalender(calender,this)" />
				</td>

		<td>
			<br>
			<input type="submit" name="btnSearch" value="Search Now">
			<input type="submit" name="btnShowAll" value="Show All">
			<input type="reset" name="Cancel">
		</td>
	</tr>
	</table>
	<hr/>

<?php 
 if ($size < 1) 
 {
 	echo "<p>No Import Purchase Record Found...</p>";
 }
 else
 {
 	?>
 	<table id="tableid" class="display">
 		<thead>
 			<tr>
 				<th>No.</th>
 				<th>Import Purchase ID</th>
 				<th>Purchase Date</th>
 				<th>Purchase</th>
 				<th>Quantity</th>
 				<th>Purchase Amount</th>
 				<th>Description</th>
 				<th>Import Company ID</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php 
 			for ($i=0; $i <$size ; $i++) 
 			{ 
 				$rows2 = mysqli_fetch_array($result);
 				$PurchaseID=$rows2['PurchaseID'];

 				echo "<tr>";
 				echo "<td>".($i+1)."</td>";
 				echo "<td>".$rows2['PurchaseDate']."</td>";
 				echo "<td>".$rows2['Purchase']."</td>";
 				echo "<td>".$rows2['Quantity']."</td>";
 				echo "<td>".$rows2['Purchase_Amount']."</td>";
 				echo "<td>".$rows2['Description']."</td>";
 				echo "<td>".$rows2['importcompanyID']."</td>";
 				echo "<td>
				  <a href='ImportPurchaseUpdate.php?PurchaseID=$PurchaseID'>Update</a> |
				  <a href='ImportPurchaseDetails.php?PurchaseID=$PurchaseID'>Details</a> 
				  </td>";
		echo "</tr>";
 			}
 			 ?>
 		</tbody>
 	</table>
 	<?php
 }  
?>
	</fieldset>
</form>
 </body>
 </html>