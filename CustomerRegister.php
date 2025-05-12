<?php 
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$CustomerID = $_POST['txtCustomerID'];
	$CustomerName = $_POST['txtCustomerName'];
	$Age = $_POST['txtAge'];
	$Dob = $_POST['txtDateOfBirth'];
	$Address = $_POST['txtAddresss'];
	$Gender = $_POST['cboGender'];
	$Email = $_POST['txtEmail'];
	$NRCNumber = $_POST['txtNRCNumber'];
	$PhoneNumber = $_POST['txtPhoneNumber'];
	$Username = $_POST['txtUsername'];
	$Password = $_POST['txtPassword'];

	$Image=$_FILES['txtImage']['name'];
	$CustomerImage='CustomerImage/';
	if ($CustomerImage) 
	{
		$filename=$imagefolder."_".$Image;
 			$Copied=copy($_FILES['txtImage']['tmp_name'],$filename);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}

	//For Email Address checking
	$Select_Email = "SELECT * FROM customer WHERE Email = '$Email'";
	$Query_Email = mysqli_query($connect,$Select_Email);
	$Email_Count = mysqli_num_rows($Query_Email);
	if ($Email_Count > 0) 
	{
		echo "<script>window.alert('Your Customer Email of $txtEmail already exists! You should try with the another')</script>";
		echo "<script>window.location = 'CustomerRegister.php'</script>";
		exit();
	}

	//For Customer Username checking 
	$Select_Username = "SELECT * FROM customer WHERE Username = '$Username'";
	$Query_Username = mysqli_query($connect,$Select_Username);
	$Username_Count = mysqli_num_rows($Query_Username);
	if ($Username_Count > 0) 
	{
		echo "<script>window.alert('Your Customer Username of $txtUsername already exists! You should try with the another')</script>";
		echo "<script>window.location = 'CustomerRegister.php'</script>";
		exit();
	}

	//For inserting data
	$Insert_Customer = "INSERT INTO `customer`(`CustomerID`, `CustomerName`, `Age`, `DateOfBirth`, `Address`, `Gender`, `Email`, `NRCNumber`, `PhoneNumber`, `CustomerUsername`, `CustomerPassword`, `CustomerImage`) VALUES ('$CustomerID','$CustomerName','$Age','$Dob','$Address','$Gender','$Email','$NRCNumber','$PhoneNumber','$Username','$Password','$filename')";
	$Insert_Query = mysqli_query($connect,$Insert_Customer);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Customer Account Registration is completed.Welcome!!!')</script>";
		echo "<script>window.location = 'CustomerLogin.php'</script>";
	}
	else
	{
		echo "<p>Customer Account Registration has failed! Please check your information and data.". mysqli_error($connect)."</p>";
		echo "<script>window.locaton='CustomerRegister.php'</script>";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Customer Register</title>
 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
 </head>
 <body>
  <form action="CustomerRegister.php" method="Post" enctype="multipart/form-data">
  	<fieldset>
  		<legend>Customer Register</legend>
  		<h1 align="center">Register your account here</h1>
  		<table align="center">
  			
  			<tr>
  				<td>Customer ID</td>
  				<td>
  					<input type="text" name="txtCustomerID" value="<?php echo AutoID('Customer','CustomerID','C-',6) ?>" readonly >
  				</td>
  			</tr>

  			<tr>
  				<td>Customer Name</td>
  				<td>
  					<input type="text" name="txtCustomerName" placeholder="Your Name" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Age</td>
  				<td>
  					<input type="text" name="txtAge" placeholder="Age" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Date Of Birth</td>
  				<td>
  					<input type="Date" name="txtDateOfBirth" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Address</td>
  				<td>
  					<input type="text" name="txtAddress" placeholder ="Your living address" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Gender</td>
  				<td>
  					<select name="cboGender" required placeholer ='Gender'>
  						<option>Male</option>
  						<option>Female</option>
  					</select>
  				</td>
  			</tr>

  			<tr>
  				<td>Email</td>
  				<td>
  					<input type="text" name="txtEmail" placeholder="Your Email" required>
  				</td>
  			</tr>

  			<tr>
  				<td>NRC Number</td>
  				<td>
  					<input type="text" name="txtNRCNumber" placeholder="Your NRC Number" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Phone Number</td>
  				<td>
  					<input type="text" name="txtPhoneNumber" placeholder="Your Phone Number" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Username</td>
  				<td>
  					<input type="text" name="txtUsername" placeholder="Your Account Username" required>;
  				</td>
  			</tr>

  			<tr>
  				<td>Password</td>
  				<td>
  					<input type="text" name="txtPassword" placeholder="Your Account Password" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Profile Image</td>
  				<td>
  					<input type="file" name="txtImage" required>
  				</td>
  			</tr>
  			<tr>
  				<td>
  					<input type="Submit" name="btnRegister" value="Register">
  					<input type="Reset" name="Clear">
  				</td>

  			</tr>
  		</table>
  	</fieldset>
  </form>
 </body>
 </html>