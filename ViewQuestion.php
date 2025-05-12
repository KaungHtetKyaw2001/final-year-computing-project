<?php 
include('Connect.php');

$Question = "SELECT * FROM frequentaskedquestionsandanswers";
$run = mysqli_query($connect,$Question);
$Count = mysqli_num_rows($run);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title>Frequent Asked Questions and Answers</title>
 </head>
 <body>
 	<form action="" method="Post">
 		<h1>Frequent Asked Questions and Answers</h1><br><br>
 		<table width="100%" border="1">
 			<th>Question ID</th>
 			<th>Question Date</th>
 			<th>Question</th>
 			<th>Customer Name</th>
 			<th>Customer ID</th>
 			<th>Answer</th>
 			<th>Action</th>

<?php 
		for ($i=0; $i < $Count ; $i++) 
		{ 
			$Ret = mysqli_fetch_array($run);
			echo "<tr>";
			echo "<td>".$Ret['QuestionID']."</td>";
			echo "<td>".$Ret['QuestionDate']."</td>";
			echo "<td>".$Ret['Question']."</td>";
			echo "<td>".$Ret['CustomerName']."</td>";
			echo "<td>".$Ret['CustomerID']."</td>";
			echo "<td>".$Ret['Answer']."</td>";
			echo "<td><a href = 'Answer.php?QID=".$Ret['QuestionID']."'>Answer</a></td>";
			echo "</tr>";
		}
 ?>
 		</table>
 	</form>
 </body>
 </html>