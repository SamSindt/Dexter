<?php
	require_once ('basicErrorHandling.php');
	
	function getAdminStatus($dbh, $userID)
	{
  	$isAdmin = FALSE;

  	$sth = $dbh->prepare("SELECT Admin FROM Users 
						WHERE UserName = :userID");
						
		$sth->bindValue(":userID", $userID);
		// run the query	
  	$sth->execute();
		
		$adminData = $sth -> fetch();
		
  	if (1 == $adminData['Admin'])
		{
			$isAdmin = TRUE;
		}
		return $isAdmin;
	}
  
  
?>