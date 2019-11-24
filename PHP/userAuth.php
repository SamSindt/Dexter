<?php

require_once ('connDB.php');
require_once ('basicErrorHandling.php');
require_once ('queryValidateUser.php');
session_start();

$_SESSION['VALID'] = 0;

if (	isset($_POST['txtUser']) &&
			isset($_POST['txtPassword']))
{
	$userID = $_POST['txtUser'];
	$passwd = $_POST['txtPassword'];
	
	$dbh = db_connect_ro();
			
	$result = queryValidateUser($dbh, $userID, $passwd);
			
	if (TRUE == $result)
	{
		$_SESSION['VALID'] = 1;
		//redirect to homepage
		header('Location: showResultsPage.php');
	}
	else
	{
		header('Location: showLogin.php');
	}
}
?>