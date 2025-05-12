<?php 

function AddProductToShoppingCart($ProductID,$Quantity)
{
	include ('Connect.php');
	$Select = "SELECT * FROM product WHERE ProductID = '$ProductID'";
	$Select_query = mysqli_query($connect,$Select);
	$Select_Count = mysqli_num_rows($Select_query);
	$Select_Rows  = mysqli_fetch_array($Select_query);

	if ($Select_Count < 1 ) 
	{
		echo "<p> No product data found!</p>";
		exit();
	}
	if ($Quantity < 1)
	{
		echo "<p>Please Enter your quantity.</p>";
		exit();
	}
	if (isset($_SESSION['ShoppingCartFunctions'])) 
	{
		$Index = IndexOf($ProductID);
		if ($Index == -1) 
		{
			$Size = Count($_SESSION['ShoppingCartFunctions']);
			$_SESSION['ShoppingCartFunctions'][$Size]['ProductID'] = $ProductID;
			$_SESSION['ShoppingCartFunctions'][$Size]['ProductName'] = $ProductName;
			$_SESSION['ShoppingCartFunctions'][$Size]['Logo'] = $Logo;
			$_SESSION['ShoppingCartFunctions'][$Size]['Quantity'] = $Quantity;
			$_SESSION['ShoppingCartFunctions'][$Size]['Price'] = $Price;
			$_SESSION['ShoppingCartFunctions'][$Size]['ProductImage1'] = $ProductImage1;
		}
		else
		{
			$_SESSION['ShoppingCartFunctions'][$Index]['Quantity'] += $Quantity;
		}
	}
	else
	{
		$_SESSION['ShoppingCartFunctions'] = Array();
		$_SESSION['ShoppingCartFunctions'][0]['ProductID'] = $ProductID;
		$_SESSION['ShoppingCartFunctions'][0]['ProductName'] = $Select_Rows['ProductName'];
		$_SESSION['ShoppingCartFunctions'][0]['Logo'] = $Select_Rows['Logo'];
		$_SESSION['ShoppingCartFunctions'][0]['Quantity'] = $Select_Rows['Quantity'];
		$_SESSION['ShoppingCartFunctions'][0]['Price'] = $Select_Rows['Price'];
		$_SESSION['ShoppingCartFunctions'][0]['ProductImage1'] = $Select_Rows['ProductImage1'];
	}
	echo "<script>window.location = 'ShoppingCartFunctions.php'</script>";

}

Function RemoveProduct($ProductID)
{
	$Index = IndexOf($ProductID);
	unset($_SESSION['ShoppingCartFunctions'][$Index]);
	$_SESSION['ShoppingCartFunctions'] = array_values($_SESSION['ShoppingCartFunctions']);
	echo "<script>window.location = 'ShoppingCart.php'";
}

Function ClearAll()
{
	unset($_SESSION['ShoppingCartFunctions']);
	echo "<script>window.location = 'ShoppingCart.php'</script>";
}

Function TotalAmount()
{
	$TotalAmount = 0;
	$Size = count($_SESSION['ShoppingCartFunctions']);
	for ($i=0; $i < $Size ; $i++) 
	{ 
		$Price = $_SESSION['ShoppingCartFunctions'][$i]['Price'];
		$Quantity = $_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$TotalAmount += ($Price * $Quantity);
	}
	return $TotalAmount;
}

Function TotalQuantity()
{
	$TotalQuantity = 0;
	$Size = Count($_SESSION['ShoppingCartFunctions']);
	for ($i=0; $i < $Size ; $i++) 
	{ 
		$Quantity = $_SESSION['ShoppingCartFunctions'][$i]['Quantity'];
		$TotalQuantity += $Quantity;
	}
	return $TotalQuantity;
}

Function TaxAmount()
{
	$TaxAmount = 0;
	$TaxAmount = TotalAmount() * 0.05;
	return $TaxAmount;
}

Function IndexOf($ProductID)
{

	if (isset($_SESSION['ShoppingCartFunctions'])) 
	{
		return -1;
	}
	$Size = Count($_SESSION['ShoppingCartFunctions']);
	if ($Size < 1) 
	{
		return -1;
	}
	for ($i=0; $i < $Size ; $i++) 
	{ 
		if ($ProductID == $_SESSION['ShoppingCartFunctions'][$i]['ProductID']) {
			return $i;
	}
	
}
}
?>