<?php 
session_start();
include('Connect.php');
include('ShoppingCartFunctions.php');

if (isset($_GET['action'])) 
{
	$action = $_GET['action'];

	if ($action === "Cart") 
	{
		$ProductID = $_GET['ProductID'];
		$Quantity = $_GET['txtBuyQuantity'];
		AddProductToShoppingCart($ProductID,$Quantity);
	}
}
if (isset($_GET['ProceedAction'])) 
{
     $ProceedAction = $_GET['ProceedAction'];

     if ($ProceedAction === "remove") 
     {
     	$ProductID = $_GET['ProductID'];
     	RemoveProduct($ProductID);
     }
     elseif ($ProceedAction === "clearall") 
     {
     	ClearAll();
     }
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Shopping Cart</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <form>
 	<fieldset>
 		<legend>Shopped Product Details :</legend>
 		<?php 
 		if (isset($_SESSION['ShoppingCartFunctions'])) 
 		{
 			echo "<p>Empty Cart!</p>";
 			echo "<a href = 'ProductDisplay.php'>Back to Product Display</a>";
 		}
 		else
 		{
 		 ?>
 		<table border="1" align="center" width="100%">
 			<tr>
 				<th>Product ID</th>
 				<th>Product Name</th>
 				<th>Price</th>
 				<th>Quantity</th>
 				<th>Sub-Total</th>
 				<th>Product Image</th>
 				<th>Action</th>
 			</tr>
 			<?php 
 				$ProductCount = Count($_SESSION['ShoppingCartFunctions']);

 				for ($i=0; $i < $ProductCount ; $i++){ 
 					$ProductID=$_SESSION['ShoppingCartFunctions'][$i]['ProductID'];
		$ProductPrice=$_SESSION['ShoppingCartFunctions'][$i]['Price']; 
		$ProductQuantity=$_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$ProductImage=$_SESSION['ShoppingCartFunctions'][$i]['ProductImage1'];
		$SubTotal=$ProductPrice * $ProductQuantity;

					echo "<tr>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['ProductID'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['ProductName'] . "</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['Price'] . " MMK</td>";
			echo "<td>" . $_SESSION['ShoppingCartFunctions'][$i]['Quantity'] . " pcs</td>";

			echo "<td>" . $SubTotal . " MMK </td>";
			echo "<td><img src='$ProductImage' width='80px' height='100px' /></td>";
			echo "<td>
					<a href='ShoppingCart.php?Proceedaction=remove&ProductID=$ProductID'>Remove</a>
				  </td>";
 				}
 			 ?>
 			 <tr>
 			 	<td colspan="7" align="right">
 			 		Total Quantity : <b><?php echo TotalQuantity() ?> Pieces</b>
 			 		<br>
 			 		Total Amount : <b><?php echo TotalAmount() ?> MMK</b>
 			 		<br>
 			 		Government Tax Amount: <b><?php echo TaxAmount() ?> MMK</b>
 			 		<br>
 			 		Grand Total : <b><?php echo TotalAmount() + TaxAmount() ?> MMK</b>
 			 	</td>
 			 </tr>

 			 <tr>
 			 	<td colspan="7" align="right">
 			 		<a href="ProductDisplay.php">Continue Shopping</a>
 			 		|
 			 		<a href="ShoppingCart.php?ProceedAction = clearall">Clear All</a>
 			 		|
 			 		<a href="OrderPayment.php">Proceed</a>
 			 	</td>
 			 </tr>
 		</table>
 		<?php 
}
 		 ?>
 	</fieldset>
 </form>
 </body>
 </html>