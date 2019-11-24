<?php

	require_once ('queryGetSalt.php');
	
	function queryValidateUser($dbh, $user, $passwd)
	{
		$retVal = FALSE;
		$salt = queryGetSalt($dbh, $user);
		
		$hashedPW = crypt($passwd . $salt, 
			'2y$07$8d88bb4a9916b302c1c68c$');
			
		$sth = $dbh->prepare("SELECT * FROM Users WHERE
					UserName = :user and Password = :pass");
		$sth->bindValue(":user", $user);
		$sth->bindValue(":pass", $hashedPW);
		$sth->execute();
	
		if (1 == $sth -> rowCount())
		{
			print "Good User";
			$retVal = TRUE;
		}
		else
		{
			print "Bad user";
		}
		return $retVal;
	}

?>