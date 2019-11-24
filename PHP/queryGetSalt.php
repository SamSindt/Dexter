<?php

	require_once ('basicErrorHandling.php');
	function queryGetSalt($dbh, $user)
	{
		$retVal = "NONE";
		
		$sth = $dbh -> prepare("SELECT Salt FROM Users WHERE
				 	UserName = :user");
		$sth -> bindValue(":user", $user);
		$sth -> execute();
		
		if (1 == $sth -> rowCount())
		{
			$row = ($sth->fetch());
			$retVal = $row[0];
		}
		return $retVal;
	}

?>