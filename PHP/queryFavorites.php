<?php
	require_once('basicErrorHandling.php');
	
	function getUserFavorites ($dbh) {
		$rows = array();
		if (isset ($_SESSION['userID'])) {
			$uid = $_SESSION['userID'];
			
			
			
			$sth = $dbh -> prepare("SELECT Name, Pokemon.PKID
									FROM HasFavorite, Pokemon  
									WHERE UID = " . $uid
									. " AND HasFavorite.PKID = Pokemon.PKID");
		
			$sth -> execute();
			
			while ($row = $sth -> fetch ()) {
				$rows[] = $row;
			}
			
		}
		return $rows;
	}