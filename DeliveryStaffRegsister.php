<?php 
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$DeliveryStaffID = $_POST['txtDeliveryStaffID'];
	$DeliveryStaffName=$_POST['txtDeliveryStaffName'];
	$Age = $_POST['txtAge'];
	$dob = $_POST['txtDateOfBirth'];
	$Address = $_POST['txtAddress'];
	$Gender = $_POST['cboGender'];
	$Email = $_POST['txtEmail'];
	$NRCNumber = $_POST['txtNRCNumber'];
	$PhoneNumber = $_POST['txtPhoneNumber'];
	$Username = $_POST['txtDeliveryStaffUsername'];
	$Password = $_POST['txtPassword'];
	$Image=$_FILES['txtImage']['name'];
	$DeliveryStaffImage='DeliveryStaffImage/';
	if ($DeliveryStaffImage) 
	{
		$filename=$DeliveryStaffImage."_".$Image;
 			$Copied=copy($_FILES['txtImage']['tmp_name'],$filename);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}

	//For Email Address Checking
	$Select_Email = "SELECT * FROM deliverystaff WHERE Email = '$Email'";
	$Query_Email = mysqli_query($connect,$Select_Email);
	$Email_Count = mysqli_num_rows($Query_Email);
	if ($Email_Count > 0) 
	{
		echo "<script>window.alert('Your delivery staff email of $txtEmail already exists! You should try with the another...')</script>";
		echo "<script>window.location = 'DeliveryStaffRegister.php'</script>";
		exit();
	}

	//For Username Checking
	$Select_Username = "SELECT * FROM deliverystaff WHERE Username = '$Username'";
	$Username_Query = mysqli_query($connect,$Select_Username);
	$Username_Count = mysqli_num_rows($Username_Query);
	if ($Username_Count > 0) 
	{
		echo "<script>window.alert('Your delivery staff username of $txtDeliveryStaffUsername already exists! You should try with the another one...')</script>";
		echo "<script>window.location = 'DeliveryStaffRegister.php'</script>";
		exit();
	}

	$Insert_DeliveryStaff = "INSERT INTO `deliverystaff`(`DeliveryStaffID`, `DeliveryStaffName`, `Age`, `DateOfBirth`, `Gender`, `Email`, `NRCNumber`, `Address`, `PhoneNumber`, `DeliveryStaffUsername`, `DeliveryStaffPassword`, `DeliveryStaffImage`) VALUES ('$DeliveryStaffID','$DeliveryStaffName','$Age','$dob','$Gender','$Email','$NRCNumber','$Address','$PhoneNumber','$Username','$Password','$filename')";
	$Insert_Query = mysqli_query($connect,$Insert_DeliveryStaff);

	if ($Insert_Query) 
	{
		echo "<script> window.alert('Delivery Staff Account Registration completed. Welcome !!!')</script>";
		echo "<script>window.location = 'DeliveryStaffLogin.php'</script>";
	}
	else
	{
		echo "<p>Delivery Staff Account Registration Failed! Please check your information and data.".mysqli_error($connect)."</p>";
		echo "<script>window.location = 'DeliveryStaffRegister.php'</script>";
	}
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Delivery Staff Register</title>
 	<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 	<form action="DeliveryStaffRegister.php" method="Post" enctype="multipart/form-data">
 		<fieldset>
 			<legend>Delivery Staff Register</legend>
 			<h1 align="center">Register your account here</h1>
 			<table align="center">
 				
 				<tr>
 					<td>Delivery Staff ID</td>
 					<td>
 						<input type="text" name="txtDeliveryStaffID" value="<?php echo AutoID('deliverystaff','DeliveryStaffID','DS-',6) ?>" readonly>
 					</td>
 				</tr>

 				<tr>
 					<td>Delivery Staff Name</td>
 					<td>
 						<input type="text" name="txtDeliveryStaffName" placeholder="Your Full Name" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Age</td>
 					<td>
 						<input type="text" name="txtAge" placeholder="Your Age" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Date of Birth</td>
 					<td>
 						<input type="Date" name="txtDateOfBirth" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Address</td>
 					<td>
 						<input type="text" name="txtAddress" placeholder="Your Address" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Gender</td>
 					<td>
 						<select name ="cboGender" placeholder = "Add your Gender" required>
 						<option>Male</option>
 						<option>Female</option>
 					</select>
 					</td>
 				</tr>

 				<tr>
 					<td>Email</td>
 					<td>
 						<input type="Email" name="txtemail" placeholder="Your Email" required>
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
 						<input type="text" name="txtUsername" placeholder="Your staff username" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Password</td>
 					<td>
 						<input type="text" name="txtPassword" placeholder="Your password" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Delivery Staff Image</td>
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