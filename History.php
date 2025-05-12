<?php 
session_start();
include('Connect.php');
include('BrowsingFunction.php');
recordBrowse("http://localhost:70/Final Year Project File/History.php");

if (isset($_REQUEST['action'])) 
{
	unset($_SESSION['Browsing']);
}

if (isset($_SESSION['Browsing'])) 
{
	$Count = count($_SESSION['Browsing']);

	if ($Count==0) 
	{
		echo "<h2> No History </h2>";	
	}
	else
	{
		echo "<table border = '1'>";
		echo "<tr>
			  <th>URL</th>
			  <th>Date Time</th>
			  </tr>";
			 for ($i=0; $i < $Count ; $i++) 
			 { 
			 	echo "<tr>";
			 	echo "<td>".$_SESSION['Browsing'][$i]['PageName']."</td>";
			 	echo "<td>".$_SESSION['Browsing'][$i]['DateTime']."</td>";
			 	echo "</td>";
			 }
			 echo "</table>";
	}
}
else
{
	echo "<h2> No History </h2>";
}

 ?>

 <a href="History.php?action=clear">
 	Clear All History
 </a>