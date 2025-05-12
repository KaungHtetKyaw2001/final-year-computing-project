<?php 
session_start();
include('Connect.php');

$ImportCompanyTypeID = $_GET['ImportCompanyTypeID'];
$ImportCompanyType_Delete = "DELETE FROM importcompanytype WHERE `ImportCompanyTypeID` = '$ImportCompanyTypeID'";
$result = mysqli_query($connect,$ImportCompanyType_Delete);
if ($result) 
{
	echo "<script>window.alert('This Import Company Type is successfully deleted!')</script>";
	echo "<script>window.location = 'ImportCompanyTypeRegistration.php'</script>";
}
else
{
	echo "<p>Someting went wrong in Import Company Type Deletion. Cannot operate the delete" . mysqli_error($connect)."</p>";
	echo "<script>window.location = 'ImportCompanyTypeRegistration.php'</script>";
}

 ?>