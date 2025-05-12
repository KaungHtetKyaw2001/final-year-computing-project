<?php 
session_start();
include('Connect.php');

if (isset($_REQUEST['StaffID'])) 
{
	$StaffID = $_REQUEST['StaffID'];
	$Select = "SELECT * FROM staff WHERE StaffID = '$StaffID'";
	$ret = mysqli_query($connect,$Select);
	$Req = mysqli_fetch_array($ret);

	$sid=$req['StaffID'];
	$sname=$req['StaffName'];
	$suname=$req['StaffUsername'];
	$Age=$req['Age'];
	$gen=$req['Gender'];
	$rol=$req['Role'];
	$date=$req['DateOfBirth'];
	$add=$req['Address'];
	$em=$req['Email'];
	$nrc=$req['NRCNumber'];
	$ph=$req['PhoneNumber'];
	$spw=$req['StaffPassword'];
	$simage=$req['StaffImage'];
}

if (isset($_POST['btnUpdate']))
{
	$StaffID=$_POST['txtStaffID'];
	$staffname=$_POST['txtStaffname'];
	$age=$_POST['txtAge'];
	$gender=$_POST['cboGender'];
	$role=$_POST['cboRole'];
	$dob=$_POST['txtDateOfBirth'];
	$address=$_POST['txtAddress'];
	$email=$_POST['txtemail'];
	$NRCnumber=$_POST['txtNRCNumber'];
	$phonenumber=$_POST['txtPhoneNumber'];
	$StaffUsername=$_POST['txtStaffUsername'];
	$Password=$_POST['txtPassword'];
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

	$UpdateStaff = "UPDATE staff
					SET `StaffName`='$staffname',
						`Age`='$age',
						`Gender`='$gender',
						`Role`='$role',
						`DateOfBirth`='$dob',
						`Address`='$address',
						`Email`='$email',
						`NRCnumber`='$NRCnumber',
						`PhoneNumber`='$phonenumber',
						`StaffUsername`='$StaffUsername',
						`StaffPassword`='$Password',
						`StaffImage`='$Image'
					WHERE `StaffID` = '$StaffID'";
	$Query_Update = mysqli_query($connect,$UpdateStaff);

	if ($Query_Update)
	{
		echo "<script>window.alert('Staff Account Successfully Updated!')</script>";
		echo "<script>window.location='StaffAdministration.php'</script>";
	}
	else
	{
		echo "<p>Cannot update the information. Please check your information" . mysqli_error($connect) . "</p>";
	}

if(isset($_GET['StaffID'])) 
{
	$StaffID=$_SESSION['StaffID'];

	$query="SELECT * FROM staff WHERE StaffID='$StaffID'";
	$ret=mysqli_query($connect,$query);
	$Row=mysqli_fetch_array($ret);
	$rows1=mysqli_fetch_array($ret);
}
else
{
	$StaffID="";
	echo "<script>window.alert('An error has occured in the update.| StaffID not found')</script>";
	echo "<script>window.location='StaffAdministration.php'</script>";
	exit();
}
}
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Staff Update</title>

 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />

 </head>
 <body>
 <form action="StaffUpdate.php" method="Post" enctype="multipart/form-data">
 	<fieldset>
 		<legend>Update Staff</legend>
 	<h1 align="center">Update your staff account here!</h1>
 	<table align="center">
 		<tr>
 			<td>
 				<input type="hidden" name="txtStaffID" value="<?php echo $sid ?>">
 			</td>
 		</tr>

 		<tr>
 			<td>Staff Name</td>
 			<td>
 				<input type="text" name="txtStaffName" placeholder="Your Full Name" value="<?php echo $sname ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Age</td>
 			<td>
 				<input type="text" name="txtAge" placeholder="Age" value="<?php echo $Age ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Gender</td>
					<td>
						<select name = "cboGender" placeholder="Add your Gender" value="<?php echo $gen ?>" required>
							<option>Male</option>
							<option>Female</option>
						</select>
					</td>
 		</tr>

 		<tr>
 			<td>Role</td>
					<td>
						<select name = "cboRole" placeholder="Choose Role" value="<?php echo $role ?>" required>
							<option>Oil Staff</option>
							<option>Medicine Staff</option>
							<option>Stationary Item Staff</option>
							<option>Paper Staff</option>
						</select>
					</td>
 		</tr>

 		<tr>
 			<td>Date Of Birth</td>
 			<td>
 				<input type="Date" name="txtDateOfBirth" value="<?php echo $date ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Address</td>
 			<td>
 				<input type="text" name="txtAddress" value="<?php echo $add ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Email</td>
 			<td>
 				<input type="text" name="txtEmail" value="<?php echo $Email ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>NRC Number</td>
 			<td>
 				<input type="text" name="txtNRCNumber" value="<?php echo $nrc ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Phone Number</td>
 			<td>
 				<input type="text" name="txtPhoneNumber" value="<?php echo $ph ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Staff Username</td>
 			<td>
 				<input type="text" name="txtStaffUsername" value="<?php echo "$suname" ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Staff Password</td>
 			<td>
 				<input type="text" name="txtPassword" value="<?php echo "spw" ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>Staff Image</td>
 			<td>
 				<input type="text" name="txtImage" value="<?php echo $simage ?>" required>
 			</td>
 		</tr>

 		<tr>
 			<td>
 				<input type="Submit" name="btnUpdate" value="Update">
 				<input type="Reset" name="Clear">
 			</td>
 		</tr>
 		
 	</table>
 	</fieldset>
 </form>
 </body>
 </html>