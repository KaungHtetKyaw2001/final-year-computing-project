<?php 
include('Connect.php');
include('AutoID_Functions.php');

if (isset($_POST['btnSendFeedback']))
{
	$FeedbackID = $_POST['txtFeedbackID'];
	$FeedbackDate = $_POST['txtFeedbackDate'];
	$Comment = $_POST['txtComment'];
	$CustomerID = $_POST['txtCustomerID'];

	$Insert_Feedback = "INSERT INTO `feedback`(`FeedbackID`, `FeedbackDate`, `Comment`, `CustomerID`) VALUES ('$FeedbackID','$FeedbackDate','$Comment','$CustomerID')";
	$Insert_Query = mysqli_query($connect,$Insert_Feedback);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Your feedback has been successfully sent. Thanks for commenting our website and we will get better our website'</script>";
	}
	else
	{
		echo "<p>window.alert('An error has occurred. Please try again later.!)".mysqli_error($connect)."</p>";
	}
}	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Customer Feedback</title>
 </head>
 <body>
 	<form action='CustomerFeedback.php' method="Post">
 		<h1>Customer Feedback</h1>
 		<h3>Please Leave your feedback here!</h3><br><br>
 		<input type="hidden" name="txtFeedbackID" value="<?php echo AutoID('Feedback','FeedbackID','FB-',6) ?>">
 		Customer ID
 		<input type="text" name="txtCustomerID" required><br><br>
 		Feedback Date
 		<input type="Date" name="txtFeedbackdate" required><br><br>
 		Comment
 		<input type="text" name="txtComment"><br><br>
 		<input type="Submit" name="btnSendFeedback" value="Send Feedback">

 	</form>
 </body>
 </html>