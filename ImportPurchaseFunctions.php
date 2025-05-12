<?php 
function AddProduct($PurchaseID,$Price,$PurchaseQuantity)
{
	include('connect.php');

	$query = "SELECT * FROM purchase WHERE PurchaseID = '$PurchaseID'";
	$result = mysqli_query($connect,$query);
	$count = mysqli_num_rows($result);
	$rows = mysqli_fetch_array($result);

	if ($count < 1) 
	{
		echo "<p>No Product Information Found!</p>";
		exit();
	}

	if ($PurchaseQuantity < 1 ) 
	{
		echo "<p>Please Enter Correct quantity to purchase.</p>";
		exit();	
	}

	if (isset($_SESSION['ImportPurchaseFunctions'])) 
	{
		$index = IndexOf($ProductID);
		if ($index == -1) 
		{
			$size = count($_SESSION['ImportPurchaseFunctions']);

			$_SESSION['ImportPurchaseFunctions'][$size]['PurchaseID']=$PurchaseID;
			$_SESSION['ImportPurchaseFunctions'][$size]['Price']=$Price;
			$_SESSION['ImportPurchaseFunctions'][$size]['PurchaseQuantity']=$PurchaseQuantity;
		}
		else
		{
			$_SESSION['ImportPurchaseFunctions'][$index]['PurchaseQuantity']+=$PurchaseQuantity;
		}
	}
	else
	{
		//Condition 1

		$_SESSION['ImportPurchaseFunctions']=array();

		$_SESSION['ImportPurchaseFunctions'][0]['PurchaseID']=$PurchaseID;
		$_SESSION['ImportPurchaseFunctions'][0]['Price']=$Price;
		$_SESSION['ImportPurchaseFunctions'][0]['PurchaseQuantity']=$PurchaseQuantity;
	}

	echo "<script>window.location='ImportPurchase.php'</script>";
}

function TotalPurchaseAmount()
{
	$TotalAmount = 0;
	$size = count($_SESSION['ImportPurchaseFunctions']);

	for ($i=0; $i < $size ; $i++) 
	{
	$Price = $_SESSION['ImportPurchaseFunctions'][$i]['PaymentAmount'];
	$PurchaseQuantity=$_SESSION['ImportPurchaseFunctions'][$i]['Quantity'];
	$TotalAmount += ($Price * $PurchaseQuantity); 
	}
	return $TotalAmount;
}

function TotalQuantity()
{
	$TotalQuantity = 0;
	$size = count($_SESSION['ImportPurchaseFunctions']);
	for ($i=0; $i < $size ; $i++) 
	{ 
		$PurchaseQuantity = $_SESSION['ImportPurchaseFunctions'][$i]['Quantity'];
		$TotalQuantity += $PurchaseQuantity;
	}
	return $TotalQuantity;
} 
?>