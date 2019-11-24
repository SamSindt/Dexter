<?php 

require_once('basicErrorHandling.php');

function checkUserAuth ()
{
	if (!isset($_SESSION['VALID']) ||
			$_SESSION['VALID'] != 1)
	{
		header('Location: showLogin.php');		
	}
}

?>