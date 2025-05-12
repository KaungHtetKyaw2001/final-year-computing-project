<?php 
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnRegister'])) 
{
	$StaffID = $_POST['txtStaffID'];
	$StaffName = $_POST['txtStaffName'];
	$Age = $_POST['txtAge'];
	$Gender = $_POST['cboGender'];
	$Role = $_POST['cboRole'];
	$Dob =$_POST['txtDateOfBirth'];
	$Address = $_POST['txtAddress'];
	$Email = $_POST['txtEmail'];
	$NRCNumber = $_POST['txtNRCNumber'];
	$PhoneNumber = $_POST['txtPhoneNumber'];
	$Username = $_POST['txtStaffUsername'];
	$Password = $_POST['txtPassword'];

	$Image=$_FILES['txtImage']['name'];
	$StaffImage='StaffImage/';
	if ($StaffImage) 
	{
		$filename=$StaffImage."_".$Image;
 			$Copied=copy($_FILES['txtImage']['tmp_name'],$filename);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}

	//For Email Address checking
	$Select_Email = "SELECT * FROM staff WHERE Email = '$Email'";
	$Query_Email = mysqli_query($connect,$Select_Email);
	$Email_Count = mysqli_num_rows($Query_Email);
	if ($Email_Count > 0) 
	{
		echo "<script>window.alert('Your Staff Email of $txtEmail already exists! You should try with the another')</script>";
		echo "<script>window.location = 'StaffRegister.php'</script>";
		exit();
	}
	$Select_Username = "SELECT * FROM staff WHERE Username = '$StaffUsername'";
	$Query_Username = mysqli_query($connect,$Select_Username);
	$Username_Count = mysqli_num_rows($Query_Username);
	if ($Username_Count > 0) 
	{
		echo "<script>window.alert('Your Staff Username of $txtStaffUsername already exists! You should try with the another')</script>";
		echo "<script>window.location = 'StaffRegister.php'</script>";
		exit();
	}
	//For Username checking

	$Insert_Staff = "INSERT INTO `staff`(`StaffID`,`StaffName`,`Age`,`Gender`,`Role`,`DateOfBirth`,`Address`,`Email`,`NRCNumber`,`PhoneNumber`,`StaffUsername`,`StaffPassword`,`StaffImage`) VALUES ('$StaffID','$StaffName','$Age','$Gender','$Role','$Dob','$Address','$Email','$NRCNumber','$PhoneNumber','$Username','$Password','$filename')";
	$Insert_Query = mysqli_query($connect,$Insert_Staff);
	echo $Insert_Query;

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Staff Account Registration Completed. Welcome!!!')</script>";
		echo "<script>window.location = 'StaffLogin.php'</script>";
	}
	else 
	{
		echo "<p>Staff Account Registration Failed! Please check your information and data.".mysqli_error($connect)."</p>";
		echo "<script>window.location = 'StaffRegister.php'</script>";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Staff Register</title>
 	<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
</head>
 <body>
 	<form action="StaffRegister.php" method="Post" enctype="multipart/form-data">
 		<fieldset>
 			<legend>Staff Register</legend>
 			<h1 align="center">Register your account here</h1>
 			<table align="center">
 				<tr>
 					<td>Staff ID</td>
 					<td>
 						<input type="text" name="txtStaffID" value="<?php echo AutoID('staff','StaffID','S-',6) ?>" readonly>
 					</td>
 				</tr>

 				<tr>
 					<td>Staff Name</td>
 					<td>
 						<input type="text" name="txtStaffName" placeholder="Staff Name" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Age</td>
 					<td>
 						<input type="text" name="txtAge" placeholder="Age" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Gender</td>
 					<td>
 						<select name="cboGender" placeholder = "Add your Gender" required>
 							<option>Male</option>
 							<option>Female</option>
 						</select>
 					</td>
 				</tr>

 				<tr>
 					<td>Role</td>
 					<td>
 						<select name="cboRole" placeholder ="Add your Role" required>
 							<option>Game Sales Staff</option>
 							<option>Accessories Retail Sales Staff</option>
 						</select>
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
 						<input type="text" name="txtAddress" placeholder="Add your Address" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Email</td>
 					<td>
 						<input type="text" name="txtEmail" placeholder="Add your Email" required>
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
 						<input type="text" name="txtUsername" placeholder="Your Username" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Password</td>
 					<td>
 						<input type="text" name="txtPassword" placeholder="Your Password" required>
 					</td>
 				</tr>

 				<tr>
 					<td>Staff Profile Image</td>
 					<td>
 						<input type="file" name="txtImage" required>
 					</td>
 				</tr>

 				<tr>
 					<td>
 						<input type="Submit" name="btnRegister" value="Register">
 						<input type="Reset" value="Clear">
 					</td>
 				</tr>
 			</table>
 		</fieldset>
 	</form>
 </body>
 </html>