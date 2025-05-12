<?php 
session_start();
include('Connect.php');
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Product Display</title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <form action="ProductDisplay.php" method="Post">
 	<h2 align="right">
 		WELCOME! <a href="CustomerUpdate.php?CustomerID = <?php echo $_SESSION['CustoemrID'] ?>">
 			<img src="<?php echo $_SESSION['CustomerImage'] ?>" width = "100px" height="100px"><b><?php echo $_SESSION['CustomerName']; ?></b>
 		</a>
 	</h2>

 <table width="100%">
 	<tr>
 		<td align="right">
 			<input type="text" name="txtData" placeholder="Search your product">
 			<input type="Submit" name="btnSearch" value="Search Now">
 		</td>
 	</tr>
 </table>

 <hr/>

 <table align="center" cellpadding="8px" cellspacing="8px">
<?php 
if (isset($_POST['btnSearch'])) 
{
	$txtData = $_POST['txtData'];
	$ProductSelect1 = "SELECT * FROM product WHERE 				 ProductName LIKE '%$txtData%' OR Price = '$txtData'";
	$Product_Query1 = mysqli_query($connect, $ProductSelect1);
	$Product_Count1 = mysqli_num_rows($Product_Query1);

	for ($i=0; $i < $count1 ; $i+=10) 
	{ 
		$Product_Select2 = "SELECT * FROM product WHERE ProductName LIKE '%$txtData%' OR Price = '$txtData' LIMIT $i,10";
		$Product_Query2 = mysqli_query($connection,$Product_Select2);
		$Product_Count2 = mysqli_num_rows($Product_Query2);

		echo "<tr>";
		for ($x=0; $x < $Product_Count2 ; $x++) 
		{ 
			$Number_of_Rows = mysqli_fetch_array($Product_Query1);
			$ProductID = $Number_of_Rows['ProductID'];
			$ProductName = $Number_of_Rows['ProductName'];
			$Logo = $Number_of_Rows['Logo'];
			$Price = $Number_of_Rows['Price'];
			$ProductImage1 = $Number_of_Rows['ProductImage1'];

			 list($Imagewidth,$Imageheight)=getimagesize($ProductImage1);
			 $width=$Imagewidth/2.5;
			 $height=$Imageheight/2.5;
			 ?>
			 <td>
			 	<tr>
			 		<img src="<?php echo $ProductImage1 ?>" width="480px" height="250px">
			 	</tr>
			 </td>
			 <td>
			 	<table>
			 		<tr>
			 		<hr/>
			 		<b><?php echo $ProductName ?></b>

			 		<hr/>
			 		<b><?php echo $Logo ?></b>

			 		<hr/>
			 		<b><?php echo $Price ?> MMK</b>
			 		</tr>
			 	</table>
			 	<hr/>
			 	<button><a href="ProductDetails.php?ProductID = <?php echo $ProductID ?>">Details</a></button>
			 </td>

			 <?php  
		}
		echo "</tr>";
	}
}
else
{
	$query1 = "SELECT * FROM product";
	$result1 = mysqli_query($connect,$query1);
	$count1 = mysqli_num_rows($result1);

	for ($i=0; $i < $count1 ; $i+=10) 
	{ 
		$query2 = "SELECT * FROM Product LIMT $i,4";
		$result2 = mysqli_query($connect,$query2);
		$count2 = mysqli_num_rows($result2);

		echo "<tr>";
		for ($x=0; $x < $count2 ; $x++) 
		{ 
			$row = mysqli_fetch_array($result1);

			$ProductID = $row['ProductID'];
			$ProductName = $row['ProductName'];
			$Logo = $row['Logo'];
			$Price = $row['Price'];
			$ProductImage1 = $row['ProductImage1'];

			 list($width,$height)=getimagesize($ProductImage1);
			 $width=$width/2.5;
			 $height=$height/2.5;
		?>
		<td>
			<img src="<?php echo $ProductImage1 ?>" width="480px" height="250px">
		</td>
		<td>
			<table>
				<tr>
					<hr/>

				<b>Product Name: <?php echo $ProductName ?></b>
				<hr/>
				<b>Logo: <?php echo $Logo ?></b>
				<hr/>
				<b>Price: <?php echo $Price ?> MMK</b>
				</tr>
			</table>
			<hr/>
			<button>
				<a href="ProductDetails.php?ProductID= <?php echo $ProductID ?>">Details</a>
			</button>
		</td>
		<?php  
		}
		echo "</tr>";
	}
}
 	 ?>
 </table>
 </form>
 </body>
 </html>