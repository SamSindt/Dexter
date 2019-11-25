<?php

	require_once ('basicErrorHandling.php');
	
	function queryGetUserInfo($dbh)
	{
		$rows = array();
		
		$sth = $dbh -> prepare("SELECT UID, UserName FROM Users
		WHERE Admin = 0");
		
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}
		
		return $rows;
	}
	
?>