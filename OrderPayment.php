<?php 
session_start();
include('Connect.php');
include('AutoID_Functions.php');
include('ShoppingCartFunctions.php');

if (isset($_POST['btnProceed'])) 
{
	$OrderID = $_POST['txtOrderID'];
	$OrderDate = $_POST['txtOrderDate'];
	$CustomerID = $_SESSION['CustomerID'];
	$PaymentID = $_POST['txtPaymentID'];
	$rdoAddress = $_POST['rdoAddress'];
	if ($rdoAddress == "SameAddress") 
	{
		$Address = $_SESSION['Address'];
		$PhoneNumber = $_SESSION['PhoneNumber'];
	}
	else
	{
		$Address = $_POST['txtAddress'];
		$PhoneNumber = $_POST['txtPhoneNumber'];
	}
	$PaymentAmount = TotalAmount();
	$TotalQuantity = TotalQuantity();
	$TaxAmount = TaxAmount();
	$TotalAmount = TotalAmount() + TaxAmount();

	$PaymentType = $_POST['rdoPaymentType'];
	$CardNumber = $_POST['txtCardNumber'];
	$Status = "Pending";

	$Insert_Order = "INSERT INTO `orders`(`OrderID`, `OrderDate`, `Quantity`, `Status`, `CustomerID`) VALUES ('$OrderID','$OrderDate','$Quantity','$Status','$CustomerID')";

	$Insert_Payment = "INSERT INTO `payment`(`PaymentID`, `PaymentType`, `CardNumber`, `Payment_Amount`, `TaxAmount`, `OrderID`) VALUES ('$PaymentID','$PaymentType','$CardNumber','$PaymentAmount','$TaxAmount','$OrderID')";

	$Insert_Query = mysqli_query($connect,$Insert_Order);
	$Insert_Query2 = mysqli_query($connect,$Insert_Payment);

	$Order_Size = Count($_SESSION['ShoppingCartFunctions']);

	for ($i=0; $i < $Order_Size ; $i++) 
	{ 
		$OrderID = $_POST['txtOrderID'];
		$ProductID = $_SESSION['ShoppingCartFunctions'][$i]['ProductID'];
		$Insert_OrderDetail = "INSERT INTO `orderdetails`(`OrderID`, `ProductID`) VALUES ('$OrderID','$ProductID')";
		$Insert_Query3 = mysqli_query($connect,$Insert_OrderDetail);
	}
	if ($Insert_Query) 
	{
		unset($_SESSION['ShoppingCartFunctions']);
		echo "<script>window.alert('Order and Payment Process Successfully Completed!')</script>";
		echo "<script>window.location = 'ProductDisplay.php'</script>";
	}
	else
	{
		echo "<p>Something went wrong in Order and Payment Process".mysqli_error($connect)."</p>";
	}
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Order and Payment</title>
 	<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

<script type="text/javascript">
function SameAddress()
{
	document.getElementById('SameAddress').style.display="block";
	document.getElementById('OtherAddress').style.display="none";
}
function OtherAddress()
{
	document.getElementById('SameAddress').style.display="none";
	document.getElementById('OtherAddress').style.display="block";
}
function COD()
{
	document.getElementById('KBZPay').style.display="none";
	document.getElementById('VISA').style.display="none";
}
function KBZPay()
{
	document.getElementById('KBZPay').style.display="block";
	document.getElementById('VISA').style.display="none";
}
function Master()
{
	document.getElementById('KBZPay').style.display="none";
	document.getElementById('Master').style.display="block";
}
</script>
 </head>
 <body>
 	<form action="OrderPayment.php" method="Post" align="left">
 		<fieldset>
 			<legend align="center">Order and Payment Details:</legend>
 			<?php 
 			if (!isset($_SESSION['ShoppingCartFunctions'])) 
 			{
 			 	echo "<p>Empty Cart!</p>";
 			 	echo "<a href = 'ProductDisplay.php'>Back to Product Display</a>";	
 			 }
 			 else
 			 {
			?>
			<table border="1" align="center">
				<tr>
					<th>Product ID</th>
					<th>Product Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Sub-Total</th>
					<th>Image</th>
				</tr>
				<?php 
				$Count = Count($_SESSION['ShoppingCartFunctions']);

				for ($i=0; $i < $Count ; $i++) 
				{ 
					$ProductID = $_SESSION['ShoppingCartFunctions'][$i]['ProductID'];
					$ProductImage1=$_SESSION['ShoppingCartFunctions'][$i]['ProductImage1'];
		$Price=$_SESSION['ShoppingCartFunctions'][$i]['Price']; 
		$Quantity=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$SubTotal=$Price * $Quantity;

		echo "<tr>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['ProductID'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['ProductName'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['Price'] . " MMK</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['Quantity'] . " pcs</td>";

			echo "<td>" . $SubTotal . " MMK </td>";

			echo "<td><img src='$ProductImage1' width='80px' height='100px' /></td>";
		echo "</tr>";
				}
				 ?>

			<tr>
				<td colspan="7" align="right">
					Total Quantity : <b><?php echo TotalQuantity() ?> pcs</b>
		<br/>
		Amount : <b><?php echo TotalAmount() ?> MMK</b>
		<br/>
		TaxAmount :  <b><?php echo TaxAmount() ?> MMK</b>
		<br/>
		Total Amount : <b><?php echo TotalAmount() + TaxAmount() ?> MMK</b>
				</td>
			</tr>
			</table>
			<?php  
 			 }
 			 ?>
 		</fieldset>
 		<fieldset>
 			<legend>Order and Payment</legend>
 			<table align="left">
 				<tr>
 					<tr>
					<td>Order ID</td>
					<td>
						<input type="text" name="txtOrderID" value="<?php echo AutoID('orders','OrderID','O-',6) ?>" readonly>
					</td>
				</tr>
				<tr>
					<td>Order Date</td>
					<td>
						<input type="text" name="txtOrderDate" value="<?php echo date('Y-m-d') ?>" readonly>
					</td>
					
				</tr>
				<tr>
				<td>Payment ID</td>
				<td><input type="text" name="txtPaymentID" value="<?php echo AutoID('payment','PaymentID','PA-',6) ?>"></td>	
				</tr>
<tr>
					<td colspan="2">
				<hr/>
				Payment Types <br/>
				
				<input type="radio" name="rdoPaymentType" value="CashOnDelivery" onclick="CashOnDelivery()">
				<img src="PaymentImage/OIP.jpg" width="80px" height="60px">

				<input type="radio" name="rdoPayment" value="KBZPay" onclick="KBZPay()">
				<img src="PaymentImage/KBZPay.png" width="80px" height="60px">

				<input type="radio" name="rdoPayment" value="Master" onclick="Master()">
				<img src="PaymentImage/mastercard.gif" width="80px" height="60px">
				<hr/>

				<div id="KBZPay" style="display: none;">
					<p><b>Scan this QR code to get proceed with KBZ Pay</b></p>
					<img src="PaymentImage/KBZQR.png" width="100px" height="100px">
					<hr/>
				</div>

				<div id="Master" style="display: none;">
					<p>Enter your credit card number</p>
					<input type="text" name="txtCardNumber" placeholder="XXXX XXXX XXXX XXXX">
					<p>Security Code</p>
					<input type="text" placeholder="XXXX">
					<hr/>
				</div>

			</td>
				</tr>
				</tr>
				<tr>
					<td colspan="2">
						<hr/>
						<input type="hidden" name="txtTotalAmount" id="txtTotalAmount" value="<?php echo TotalAmount() ?>">
						<input type="hidden" name="txtTaxAmount" id="txtTaxAmount" value="<?php echo TaxAmount() ?>">
					</td>
					<hr/>
					<input type="radio" name="rdoAddress" value="SameAddress" onclick="SameAddress()" checked="">Same Address
					<input type="radio" name="rdoAddress" value="OtherAddress" onclick="OtherAddress()" > Other Address

					<div id="SameAddress">
						<p>Address :
						<b><?php echo $_SESSION['Address'] ?></b></p>
						<p>Phone Number :
						<b><?php echo $_SESSION['PhoneNumber'] ?></b></p>
						<hr/>
					</div>

					<div id="OtherAddress" style="display: none">
						<p>Address :</p>
						<textarea name="txtAddress" cols="30"></textarea>
						<p>Phone Number :</p>
						<input type="text" name="txtPhoneNumber" placeholder="Your Phone Number">
						<hr/>
					</div>
				</tr>
 				</tr>
 			</table>
 		</fieldset>
 		<a href="ShoppingCart.php?action=clearall">Clear All</a> |
					<input type="submit" name="btnProceed" value="Proceed">
 	</form>
 </body>
 </html>