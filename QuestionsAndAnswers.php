<?php 
session_start();
include('BrowsingFunction.php');
include('Connect.php');
include('AutoID_Functions.php');
recordBrowse("http://localhost:70/Final Year Project File/History.php");

if (isset($_REQUEST['btnAsk'])) 
{
	$CustomerID = $_REQUEST['txtCustomerID'];
	$CustomerName = $_REQUEST['txtCustomerName'];
	$Ask = $_REQUEST['txtAsk'];
	$QuestionDate = $_REQUEST['txtQuestionDate'];
	$QuestionID = $_SESSION['txtQuestionID'];
}

if (isset($_POST['btnAsk'])) 
{
	$QuestionID = $_POST['txtQuestionID'];
	$CustomerID = $_POST['txtCustomerID'];
	$CustomerName = $_POST['txtCustomerName'];
	$QuestionDate = $_POST['txtQuestionDate'];
	$Question = $_POST['txtQuestion'];

	$Insert_Question = "INSERT INTO `frequentaskedquestionsandanswers`(`QuestionID`, `Question`, `QuestionDate`, `CustomerName`, `CustomerID`) VALUES ('$QuestionID','$Question','$QuestionDate','$CustomerName','$CustomerID')";
	$Insert_Query = mysqli_query($connect,$Insert_Question);

	if ($Insert_Query) 
	{
		echo "<script>window.alert('Your question has been submit. You will get the reply from the admin soon. Thank you!!!')</script> ";
		echo "<script>window.location = 'QuestionsAndAnswers.php'</script>";
	}
}

$Select_Question = "SELECT * FROM frequentaskedquestionsandanswers";
$Select_Query = mysqli_query($connect,$Select_Query);
$Count = mysqli_num_rows($Select_Query);
?>

<form action="QuestionsAndAnswers.php" method="Post">
	<input type="hidden" name="txtCID"value="<?php echo $CustomerID ?>">
	<input type="hidden" name="txtCName" value="<?php echo $CustomerName ?>">
	<input type="hidden" name="txtCDate" value="<?php echo $QuestionDate ?>">
	<input type="hidden" name="txtCAsk" value="<?php echo $Ask ?>">
	<input type="hidden" name="txtQID" value="<?php echo $QuestionID ?>">

	<?php 
	for ($i=0; $i < $Count ; $i++) 
	{ 
		$Row = mysqli_fetch_array($Select_Query);
		?>
		<h2>Frequent Asked Questions and Answers</h2>
		<div>
			<b>Question <?php echo $i ?>:</b>
			<?php echo $Row['Question'] ?>
		</div>

		<div>
			<b>Answer <?php echo $i ?>:</b>
			<?php echo $Row['Answer'] ?>
		</div>
		<?php  
	}
	 ?>
</form>