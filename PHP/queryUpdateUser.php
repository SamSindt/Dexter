<?php

	require_once ('basicErrorHandling.php');
	
	function queryUpdateUser($dbh, $userID)
	{
		$sth = $dbh->prepare("UPDATE Users SET Admin = 1 WHERE
					UID = :userIDNum");
		$sth->bindValue(":userIDNum", $userID);
		$sth->execute();
	}
	
?>