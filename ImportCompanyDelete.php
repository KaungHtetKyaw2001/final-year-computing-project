<?php 
session_start();
include('Connect.php');

$ImportCompanyID = $_SESSION['ImportCompanyID'];
$ImportCompany_Delete = "DELETE FROM importcompany WHERE `ImportCompanyID` = '$ImportCompanyID'";
$Result = mysqli_query($connect,$ImportCompany_Delete);
if ($Result) 
{
	echo "<script>window.alert('Your Import Company Information has deleted!')</script>";
	echo "<script>window.location = 'ImportCompanyRegistration.php'</script>";
}
else
{
	echo "<p>Something went wrong in Import Company Delete. Cannot operate Delete.".mysqli_error($connect)."</p>";
	echo "<scirpt>window.location = 'ImportCompanyRegistration.php'</script>";
}

 ?>
