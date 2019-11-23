<?php

session_start();
require_once 'connDB.php';
require_once 'queryValidateUser.php';

$_SESSION['VALID'] = 0;

if (	isset($_POST['txtUser']) &&
			isset($_POST['txtPassword']))
{
	$userID = $_POST['txtUser'];
	$passwd = $_POST['txtPassword'];
			
	$result = queryValidateUser($dbh, $userID, $passwd);
			
	if (TRUE == $result)
	{
		$_SESSION['VALID'] = 1;
		//redirect to homepage
	}
	else
	{
		
	}
}
?>