<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');


//Single Group------------------------------------

$query = "SELECT p.*,ic.ImportCompanyID,ic.ImportCompanyName
		  FROM purchase p, importcompany ic
		  WHERE p.ImportCompanyID = ic.ImportCompanyID";
$result = mysqli_query($connect,$query);
$row1   = mysqli_fetch_array($result);

$query2 = "SELECT * FROM purchase";
$result2= mysqli_query($connect,$query2);
$count  = mysqli_num_rows($result2);

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Import Company Purchase Details</title>
	<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
</head>
<body>
<form>
	<fieldset>
		<legend>Import Company Purchase Details for <?php echo $row1['ImportCompanyID'] ?></legend>
	<table align="center" border="1" cellpadding="5px" cellspacing="5px">
		
		<tr>
			<td>Import Company ID</td>
			<td colspan="100px">
				<b><?php echo $row1['ImportCompanyID']; ?></b>
			</td>
		</tr>

		<tr>
			<td>Purchase Date</td>
			<td colspan="100px">
				<b><?php echo $row1['PurchaseDate']; ?></b>
			</td>
		</tr>

		<tr>
			<td>Import Company Name</td>
			<td colspan="100px">
				<b><?php echo $row1['ImportCompanyName']; ?></b>
			</td>
		</tr>

		<tr>
			<td colspan="4">
				<table border="1" width="100%">
					<tr>
						<th>No</th>
						<th>PurchaseID</th>
						<th>Purchase</th>
						<th>Quantity</th>
						<th>Purchase Amount</th>
					</tr>

				<?php 
				$Quantity = null;
				$Purchase_Amount = null;

				for ($i=0; $i < $count ; $i++) 
				{ 
				$row1 = mysqli_fetch_array($result2);
				echo "<tr>";
				echo "<td>".($i + 1). "</td>";
				echo "<td>".$row1['PurchaseID']."</td>";
				echo "<td>".$row1['Purchase']."</td>";
				echo "<td>".$row1['Quantity']."</td>";
				echo "<td>".$row1['Purchase_Amount']."</td>";
				echo "<td>".$row1['PurchaseID']."</td>";
				}
				?>
			</tr>
				</table>
				<tr>
			<td colspan="4" align="right">
			<p>Total Quantity : <b><?php echo $TotalQuantity ?></b></p>
			<p>Total Amount : <b><?php echo $TotalPurchaseAmount ?></b> MMK</p>
					
			</td>
			</tr>
			<tr>
				<td colspan="4" align="right">
				
				<!---Print--->
	<script>var pfHeaderImgUrl = '';var pfHeaderTagline = 'Order%20Report';var pfdisableClickToDel = 0;var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfBtVersion='1';(function(){var js, pf;pf = document.createElement('script');pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();</script>
	<a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onClick="window.print();return false;" title="Printer Friendly and PDF"><img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/button-print-grnw20.png" alt="Print Friendly and PDF"/></a>
	<!---Print--->

				</td>
			</tr>
		</tr>

	</table>
		
	</fieldset>
</form>
</body>
</html>