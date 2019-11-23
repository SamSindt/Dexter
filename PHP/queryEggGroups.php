<?php
	require_once('basicErrorHandling.php');

	function getEggGroupName($dbh, $pkid) {
		
		$rows = array ();

		$sth = $dbh -> prepare("SELECT GroupName
                                FROM InEggGroup, EggGroups
                                WHERE PokemonID=" . $pkid . 
								" AND InEggGroup.EggGroupID=EggGroups.EggGroupID");
		$sth -> execute();
		
		while ($row = $sth -> fetch ()) {
			$rows[] = $row;
		}
		return $rows;
	}
	
?>