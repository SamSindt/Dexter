<?php
	require_once ('basicErrorHandling.php');
	
	function getUserID($dbh, $userID)
	{
  	$userIDNum = -1;

  	$sth = $dbh->prepare("SELECT * from Users 
						WHERE UserName = :userID");
						
		$sth->bindValue(":userID", $userID);
		// run the query	
  	$sth->execute();
		
		$userData = $sth -> fetch();
		
  	$userIDNum = $userData['UID'];
		
		return $userIDNum;
	}
  
  
?>