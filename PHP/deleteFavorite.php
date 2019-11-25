<?php
	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
	
	session_start();
	
	if(isset($_SESSION['userID']) && isset($_POST['pkid'])) {
		$dbh = db_connect_w();
		
		$sth = $dbh->prepare("DELETE FROM HasFavorite
							  WHERE UID = " . $_SESSION['userID']
							  . " AND PKID = " . $_POST['pkid']);
		$sth->execute();
		db_close($dbh);
		
	}
	//replace for async
	//header('Location: showFavorites.php');
?>