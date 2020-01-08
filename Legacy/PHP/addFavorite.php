<?php 
	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
	
	session_start();
	
	if(isset($_SESSION['userID']) && isset($_POST['pkid'])) {
		$dbh = db_connect_w();
		
		$sth = $dbh->prepare("INSERT INTO HasFavorite (UID, PKID)
							  VALUES (" . $_SESSION['userID'] . ", " . $_POST['pkid'] . ")");
		$sth->execute();
		db_close($dbh);
		
	}
?>