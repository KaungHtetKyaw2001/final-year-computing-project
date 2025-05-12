<?php 
include('Connect.php');
include('BrowsingFunction.php');
include('AutoID_Functions.php');

if (isset($_REQUEST['QID'])) 
{
	$QuestionID = $_REQUEST['QID'];
	$Answer = "SELECT * FROM frequentaskedquestionsandanswers WHERE QuestionID = '$QuestionID'";
	$Run = mysqli_query($connect,$Answer);
	$Ret = mysqli_fetch_array($Run);
	$answer = $Ret['Answer'];
	$StaffID = $Ret['StaffID'];
}

if (isset($_POST['btnSubmit']))
{
	$Ans = $_POST['Answer'];
	$SID = $_POST['txtStaffID'];
	$ID = $_POST['txtID'];
	$Insert_Answer = "UPDATE frequentaskedquestionsandanswers SET Answer = '$Ans',
		StaffID = '$SID'
		WHERE QuestionID = '$ID'";
	$Run1 = mysqli_query($connect, $Insert_Answer);
	if ($Run1) 
	{
		echo "<script>window.alert('This question is now answered.')</script>";
		echo "<script>window.location = 'ViewQuestion.php'</script>";
	}
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Answer from Staff</title>
 </head>
 <body>
 	<form action="" method="Post">
 		<h2>Answer back the questions</h2>
 		<input type="hidden" name="txtID" value="<?php echo $QID ?>">
 		StaffID
 		<input name="txtStaffID" value="<?php echo $StaffID ?>"></input><br><br>
 		<label>Answer</label>
 		<textarea name="Answer" required><?php echo $Answer ?></textarea>
 		<br><input type="submit" name="btnSubmit" value="Submit">
 	</form>
 </body>
 </html>