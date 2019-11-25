<?php 

	require_once (__DIR__ . '/basicErrorHandling.php');
	require_once (__DIR__ . '/connDB.php');
	require_once ('queryUpdateUser.php');
	require_once ('checkUserAuth.php');
	
	checkUserAuth();
	
	if (isset($_POST['txtUserID']) && 
			TRUE == $_SESSION['isAdmin'])
	{
		$userID = $_POST['txtUserID'];
		
		$dbh = db_connect_w();
		
		queryUpdateUser($dbh, $userID);
		
		db_close($dbh);
		
		header('Location: showAdminPage.php');
	}
	else
	{
		header('Location: showPokemonSearch.php');
	}

 ?>