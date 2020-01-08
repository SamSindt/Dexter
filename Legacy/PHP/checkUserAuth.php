<?php 

	require_once('basicErrorHandling.php');
	session_start();

	function checkUserAuth () {
		if (!isset($_SESSION['VALID']) || $_SESSION['VALID'] != 1) {
			header('Location: showLogin.php');		
		}
	}

?>