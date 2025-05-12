<?php 
session_start();
include('BrowsingFunction.php');
include('Connect.php');
include('AutoID_Functions.php');
recordBrowse("http://localhost:70/Final Year Project File/History.php");

// if (isset($_POST['btnSubmit'])) 
// {
// 	$QuestionID = $_POST['txtQuestionID'];
// 	$CustomerID = $_POST['txtCustomerID'];
// 	$CustomerName = $_POST['txtCustomerName'];
// 	$QuestionDate = $_POST['txtQuestionDate'];
// 	$Question = $_POST['txtQuestion'];

// 	$Insert_Question = "INSERT INTO `frequentaskedquestionsandanswers`(`QuestionID`, `Question`, `QuestionDate`, `CustomerName`, `CustomerID`) VALUES ('$QuestionID','$Question','$QuestionDate','$CustomerName','$CustomerID')";
// 	$Insert_Query = mysqli_query($connect,$Insert_Question);

// 	if ($Insert_Query) 
// 	{
// 		echo "<script>window.alert('Your question has been submit. You will get the reply from the admin soon. Thank you!!!')</script> ";
// 		echo "<script>window.location = 'QuestionsAndAnswers.php'</script>";
// 	}
// 	else
// 	{
// 		echo "<p>window.alert('Unexpected error has occurred. Please try again')".mysqli_error($connect)."</p>";
// 	}
// }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Ask Question</title>
 </head>
 <body>
 	<form action="QuestionsAndAnswers.php" method="Post">
 		<h2>Ask Question</h2>
 		<h4>Ask Your Question Here!</h4>
 		<table>
 			<tr>
 				<td>Customer ID</td>
 				<td>
 					<input type="text" name="txtCustomerID" value="<?php echo $_SESSION['CustomerID'] ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Customer Name</td>
 				<td>
 					<input type="text" name="txtCustomerName" value="<?php echo $_SESSION['CustomerName'] ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Question ID</td>
 				<td>
 					<input type="text" name="txtQuestionID" value="<?php echo AutoID('frequentaskedquestionsandanswers','QuestionID','Q-',6) ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Question Date</td>
 				<td>
 					<input type="text" name="txtDate" value="<?php echo date("Y-m-d") ?>" readonly>
 				</td>
 			</tr>

 			<tr>
 				<td>Ask Question</td>
 				<td>
 					<textarea name="txtAsk" required></textarea>
 				</td>
 			</tr>

 			<tr>
 				<td colspan="2">
 					<input type="Submit" name="btnAsk" value="Ask Question">
 				</td>
 			</tr>
 		</table>
 	</form>
 </body>
 </html>