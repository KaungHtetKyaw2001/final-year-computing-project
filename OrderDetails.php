<?php 
session_start();
include('Connect.php');
include('ShoppingCartFunctions.php');
include('AutoID_Functions.php');

$OrderID = $_GET['OrderID'];

if (isset($_SESSION['CustomerID']))
{
	echo $CustomerID = $_SESSION['CustomerID'];

	$Order_Select = "SELECT o.*, c.*, p.*, pd.ProductID, pd.ProductName, pd.Price, od.*
					FROM orders o, customer c,payment p, orderdetails od, product pd
					WHERE o.OrderID = od.OrderID
					AND od.ProductID = pd.ProductID
					AND o.OrderID = p.OrderID 
					AND o.CustomerID = c.CustomerID
					AND o.CustomerID = '$CustomerID'";
	$OrderDetailQuery = mysqli_query($connect,$Order_Select);
	$ProductCount = mysqli_num_rows($OrderDetailQuery);

	$Order_Select1 = "SELECT o.*, c.*, p.*
					FROM orders o,customer c, payment p
					WHERE o.OrderID = p.OrderID
					AND o.CustomerID= c.CustomerID
					AND o.CustomerID= '$CustomerID'";
	$OrderDetailQuery1 = mysqli_query($connect,$Order_Select1);
	$Results1 = mysqli_fetch_array($OrderDetailQuery);
}
elseif(isset($_SESSION['StaffID'])) 
{
	$OrderDetail1="SELECT o.*, c.*,pa.*
			FROM orders o,customer c,payment pa
			WHERE o.CustomerID=c.CustomerID
			AND o.OrderID='$OrderID'
			";
	$OrderDetailQuery=mysqli_query($connect,$OrderDetail1);
	$Results1=mysqli_fetch_array($OrderDetailQuery);

	
	$OrderDetail2="SELECT o.*, od.*, p.ProductID,p.ProductName,p.Price,pa.*
			FROM orders o,orderdetails od,product p,payment pa
			WHERE o.OrderID=od.OrderID
			AND od.ProductID=p.ProductID
			AND pa.OrderID=o.OrderID
			AND od.OrderID='$OrderID'
			";
	$OrderDetailQuery2=mysqli_query($connect,$OrderDetail2);
	$ProductCount=mysqli_num_rows($OrderDetailQuery2);
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Customer Order Details:</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <form action="Order_Details.php" method="Post">
 	<fieldset>
 		<legend>Order Details For : <?php echo $OrderID ?></legend>
 		<table align="center" border="1" cellpadding="5px" cellspacing="5px">
<tr>
	<td>OrderID</td>
	<td>
		: <b><?php echo $OrderID  ?></b>
	</td>
	<td>Status</td>
	<td>
		: <b><?php echo $Results1['Status']  ?></b>
	</td>
</tr>
<tr>
	<td>Order Date</td>
	<td>
		: <b><?php echo $Results1['OrderDate']  ?></b>
	</td>
	<td>Report Date</td>
	<td>
		: <b><?php echo date('Y-m-d')  ?></b>
	</td>
</tr>
<tr>
	<td>Customer Name</td>
	<td>
		: <b><?php echo $Results1['CustomerName']  ?></b>
	</td>
	<td>Address and Phone Number</td>
	<td>
		: <b><?php echo $Results1['Address'] . ' | ' . $Results1['PhoneNumber']  ?></b>
	</td>
</tr>
<tr>
	<td colspan="4">
	<table border="1" width="100%">
	<tr>
		<th>No</th>
		<th>Product ID</th>
		<th>Product Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Sub-Total</th>
	</tr>
	<?php  
	for($i=0;$i<$ProductCount;$i++) 
	{ 
		$row2=mysqli_fetch_array($OrderDetailQuery2);

		echo "<tr>";	
		echo "<td>" . ($i+1) . "</td>";
		echo "<td>" . $row2['ProductID'] . "</td>";
		echo "<td>" . $row2['ProductName'] . "</td>";
		echo "<td>" . $row2['Price'] . "</td>";
		echo "<td>" . $row2['Quantity'] . "</td>";
		echo "<td>" . $row2['Price'] * $row2['Quantity'] . "</td>";
		echo "</tr>";	
	}
	?>
	</table>
	</td>
</tr>
<tr>
	<td colspan="4" align="right">

	<p>Total Quantity : <b><?php echo $row2['Quantity'] ?></b> pcs</p>
	<p>Total Amount : <b><?php echo $row2['Payment_Amount'] ?></b> MMK</p>
	<p>Tax Amount : <b><?php echo $row2['TaxAmount'] ?></b> MMK</p>
	<p>Total Amount with Tax : <b><?php echo $row2['TotalAmount'] ?></b> MMK</p>
	
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
</table>
 	</fieldset>
 </form>
 </body>
 </html>