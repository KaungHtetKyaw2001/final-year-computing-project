<?php 

function recordBrowse($URL)
{
	if (isset($_SESSION['Browsing'])) 
	{
		$Count = count($_SESSION['Browsing']);

		if ($Count == 0) 
		{
			$_SESSION['Browsing'][0]['PageName']=$URL;
			$_SESSION['Browsing'][0]['DateTime']=date ('Y-m-d H:i:s');
		}
		else
		{
			$_SESSION['Browsing'][$Count]['PageName'] = $URL;
			$_SESSION['Browsing'][$Count]['DateTime'] = date ('Y-m-d H:i:s');
		}
	}
	else
	{
		$_SESSION['Browsing']=array();
	}
}
 ?>
