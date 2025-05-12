<?php 
session_start();
include('Connect.php');

if (isset($_POST['btnUpdate'])) 
{
	$CustomerID = $_POST['txtCustomerID'];	
	$Customername=$_POST['txtCustomername'];
	$age=$_POST['txtAge'];
	$gender=$_POST['cboGender'];
	$dob=$_POST['txtDateOfBirth'];
	$address=$_POST['txtAddress'];
	$email=$_POST['txtemail'];
	$NRCnumber=$_POST['txtNRCNumber'];
	$phonenumber=$_POST['txtPhoneNumber'];
	$CustomerUsername=$_POST['txtUsername'];
	$Password=$_POST['txtPassword'];

	$Image=$_FILES['txtImage']['name'];
	$CustomerImage='CustomerImage/';
	if ($CustomerImage) 
	{
		$filename=$CustomerImage."_".$Image;
 			$Copied=copy($_FILES['txtImage']['tmp_name'],$filename);
 			if (!$Copied) 
 			{
 				exit("Unexpected Error Occured. Cannot Upload Image");
 			}
	}

	$UpdateCustomer = "UPDATE customer
					SET `CustomerName`='$Customername',
						`Age`='$age',
						`Gender`='$gender',
						`DateOfBirth`='$dob',
						`Address`='$address',
						`Email`='$email',
						`NRCnumber`='$NRCnumber',
						`PhoneNumber`='$phonenumber',
						`CustomerUsername`='$Username',
						`CustomerPassword`='$Password',
						`CustomerImage`='$Image'
					WHERE `CustomerID` = '$CustomerID'";
	$Query_Update = mysqli_query($connect,$UpdateCustomer);

	if ($Query_Update)
	{
		echo "<script>window.alert('Customer Account Successfully Updated!')</script>";
		echo "<script>window.location='CustomerLogin.php'</script>";
	}
	else
	{
		echo "<p>Cannot update the information. Please check your information" . mysqli_error($connect) . "</p>";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Customer Update</title>

 <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css" />
 </head>
 <body>
 <form action="CustomerUpdate.php" method="Post" enctype="multipart/form-data">
  	<fieldset>
  		<legend>Customer Update</legend>
  		<h1 align="center">Update your account information here</h1>
  		<table align="center">
  			
  			<tr>
  				<td>Customer ID</td>
  				<td>
  					<input type="text" name="txtCustomerID" value="<?php echo $_SESSION['CustomerID'] ?>" readonly >
  				</td>
  			</tr>

  			<tr>
  				<td>Customer Name</td>
  				<td>
  					<input type="text" name="txtCustomerName" value="<?php echo $_SESSION['CustomerName'] ?>" placeholder="Your Name" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Age</td>
  				<td>
  					<input type="text" name="txtAge" value="<?php echo $_SESSION['Age'] ?>" placeholder="Age" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Date Of Birth</td>
  				<td>
  					<input type="Date" name="txtDateOfBirth" value="<?php echo $_SESSION['txtDateOfBirth'] ?>" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Address</td>
  				<td>
  					<input type="text" name="txtAddress" value="<?php echo $_SESSION['Address'] ?>" placeholder ="Your living address" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Gender</td>
  				<td>
  					<select name="cboGender" required placeholer ='Gender' value = "<?php echo $_SESSION['Gender'] ?>">
  						<option>Male</option>
  						<option>Female</option>
  					</select>
  				</td>
  			</tr>

  			<tr>
  				<td>Email</td>
  				<td>
  					<input type="text" name="txtEmail" placeholder="Your Email" value="<?php echo $_SESSION['Email'] ?>" required>
  				</td>
  			</tr>

  			<tr>
  				<td>NRC Number</td>
  				<td>
  					<input type="text" name="txtNRCNumber" placeholder="Your NRC Number" value="<?php echo $_SESSION['NRCNumber'] ?>" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Phone Number</td>
  				<td>
  					<input type="text" name="txtPhoneNumber" value="<?php echo $_SESSION['PhoneNumber'] ?>" placeholder="Your Phone Number" required>
  				</td>
  			</tr>

  			<tr>
  				<td>Username</td>
  				<td>
  					<input type="text" name="txtUsername" value="<?php echo $_SESSION['CustomerUsername'] ?>" placeholder="Your Account Username" required>;
  				</td>
  			</tr>

  			<tr>
  				<td>Password</td>
  				<td>
  					<input type="text" name="txtPassword" value="<?php echo $_SESSION['CustomerPassword'] ?>" placeholder="Your Account Password" required>
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
  					<input type="Reset" value="Clear">
  					<a href="CustomerDelete.php">Delete Your Account</a>
  				</td>

  			</tr>
  		</table>
  	</fieldset>
  </form>
 </body>
 </html>