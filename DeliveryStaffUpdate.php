<?php 
session_start();
include('Connect.php');

if (isset($_REQUEST['DeliveryStaffID'])) 
{
	echo $DeliveryStaffID = $_REQUEST['DeliveryStaffID'];
	$Select = "SELECT * FROM deliverystaff WHERE DeliveryStaffID = '$DeliveryStaffID'";
	$ret=mysqli_query($connect,$select);
	$req=mysqli_fetch_array($ret);
	$dsid=$req['DeliveryStaffID'];
	$dsname=$req['DeliveryStaffName'];
	$dsuname=$req['DeliveryStaffUsername'];
	$Age=$req['Age'];
	$gen=$req['Gender'];
	$date=$req['DateOfBirth'];
	$add=$req['Address'];
	$em=$req['Email'];
	$nrc=$req['NRCNumber'];
	$ph=$req['PhoneNumber'];
	$spw=$req['DeliveryStaffPassword'];
	$simage=$req['DeliveryStaffImage'];
}

if (isset($_POST['btnUpdate'])) 
{
	$DeliveryStaffID=$_POST['txtDeliveryStaffID'];
	$DeliveryStaffname=$_POST['txtDeliveryStaffname'];
	$age=$_POST['txtAge'];
	$dob=$_POST['txtDateOfBirth'];
	$address=$_POST['txtAddress'];
	$gender=$_POST['cboGender'];
	$email=$_POST['txtemail'];
	$NRCnumber=$_POST['txtNRCNumber'];
	$phonenumber=$_POST['txtPhoneNumber'];
	$Username=$_POST['txtDeliveryStaffUsername'];
	$Password=$_POST['txtPassword'];

	$Image=$_FILES['txtImage']['name'];
	$DeliveryStaffImage='DeliveryStaffImage/';
	if ($DeliveryStaffImage) 
	{
		$filename=$imagefolder."_".$Image;
 			$Copied=copy($_FILES['txtImage']['tmp_name'],$filename);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}

	// For inserting data
	$Update_DeliveryStaff="UPDATE `deliverystaff` 
					  SET `DeliveryStaffName`='$DeliveryStaffname',
					      `Age`='$age',
					      `DateOfBirth`='$dob',
					      `Address`='$address',
					      `Gender`='$gender',
					      `Email`='$email',
					      `NRCNumber`='$NRCnumber',
					      `PhoneNumber`='$phonenumber',
					      `DeliveryStaffUsername`='$Username',
					      `DeliveryStaffPassword`='$Password',
					      `DeliveryStaffImage`='$filename'
					      WHERE `DeliveryStaffID`='$DeliveryStaffID'";
	$Update_Query=mysqli_query($connect,$Update_DeliveryStaff);

	if ($Update_Query) 
	{
		echo "<script>window.alert('Delivery Staff Account Update completed. Welcome!!!')</script>";
		echo "<script>window.location='Delivery.php'</script>";
	}
	else
	{
		echo "<p>Cannot update the information. Please check your information" . mysqli_error($connect) . "</p>";
	}
	if(isset($_GET['DeliveryStaffID'])) 
{
	$DeliveryStaffID=$_SESSION['DeliveryStaffID'];

	$query="SELECT * FROM deliverystaff WHERE DeliveryStaffID='$DeliveryStaffID'";
	$ret=mysqli_query($connect,$query);
	$Row=mysqli_fetch_array($ret);
	// $rows1=mysqli_fetch_array($ret);
}
else
{
	$DeliveryStaffID="";
	echo "<script>window.alert('An error has occured in the update.| DeliveryStaffID not found')</script>";
	echo "<script>window.location='DeliveryStaffUpdate.php'</script>";
	exit();
}
}

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Delivery Staff Update</title>

 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
 </head>
 <body>
 <form action="DeliveryStaffUpdate.php" method="Post" enctype="multipart/form-data">
 	<fieldset>
 		<legend>Delivery Staff Update</legend>
 		<h1 align="center">Delivery Staff Account Update</h1>
 		<table align="center">
 			<tr>
 				<td>
 					<input type="hidden" name="txtDeliveryStaffID" value="<?php echo $dsid ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Delivery Staff Name</td>
 				<td>
 					<input type="text" name="txtDeliveryStaffName" value="<?php echo $dsname ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Age</td>
 				<td>
 					<input type="text" name="txtAge" value="<?php echo $Age ?>" required>
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
 				<td>Date Of Birth</td>
 				<td>
 					<input type="Date" name="txtDateOfBirth" value="<?php echo $date ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Address</td>
 				<td>
 					<input type="text" name="txtAddress" value="<?php echo$add ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Email</td>
 				<td>
 					<input type="Email" name="txtEmail" value="<?php echo $em ?>" required>
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
 				<td>Username</td>
 				<td>
 					<input type="text" name="txtDeliveryStaffUsername" value="<?php echo $dsuname ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Password</td>
 				<td>
 					<input type="text" name="txtPassword" value="<?php echo $spw ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>Image</td>
 				<td>
 					<input type="file" name="txtImage" value="<?php echo $simage ?>" required>
 				</td>
 			</tr>

 			<tr>
 				<td>
 					<input type="Submit" name="btnUpdate" value="Update">
 					<a href="DeliveryStaffDelete.php">Delete</a>
 				</td>
 			</tr>
 		</table>
 	</fieldset>
 </form>
 </body>
 </html>