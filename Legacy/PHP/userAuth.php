<?php

	require_once (__DIR__ . '/connDB.php');
	require_once (__DIR__ . '/basicErrorHandling.php');
	require_once (__DIR__ . '/queryValidateUser.php');
	require_once (__DIR__ . '/queryGetAdminStatus.php');
	require_once (__DIR__ . '/queryGetUserID.php');
	session_start();

	$_SESSION['VALID'] = 0;

	if (isset($_POST['txtUser']) && isset($_POST['txtPassword'])) {
		$userID = $_POST['txtUser'];
		$passwd = $_POST['txtPassword'];
		
		$dbh = db_connect_ro();
				
		$result = queryValidateUser($dbh, $userID, $passwd);
				
		if (TRUE == $result) {
			$_SESSION['VALID'] = 1;
			$_SESSION['userID'] = (int) getUserID($dbh, $userID);
			$_SESSION['isAdmin'] = getAdminStatus($dbh, $userID);
			//redirect to homepage
			header('Location: showPokemonSearch.php');
		}
		else {
			print "\nfail";
			header('Location: showLogin.php');
		}
	}
?>