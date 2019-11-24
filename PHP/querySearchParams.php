<?php
	require_once('basicErrorHandling.php');
	
	// MIN ID
	function getLowestPKID ($dbh) {

		$sth = $dbh -> prepare("SELECT Pokemon.PKID 
														FROM Pokemon
														ORDER BY Pokemon.PKID ASC
														LIMIT 1");
		$sth -> execute();

		return ($sth -> fetch())['PKID'];
	}

	// MAX ID
	function getHighestPKID ($dbh) {

		$sth = $dbh -> prepare("SELECT Pokemon.PKID 
														FROM Pokemon
														ORDER BY Pokemon.PKID DESC
														LIMIT 1");
		$sth -> execute();

		return ($sth -> fetch())['PKID'];
	}
	
	// Colors
	function getColors ($dbh) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT ColorID, ColorName 
														FROM Colors");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
	
	// Type
	function getTypes ($dbh) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT TypeID, TypeName 
														FROM Types");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
	
	// EggGroup
	function getEggGroups ($dbh) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT EggGroupID, GroupName 
														FROM EggGroups");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
	
	// Analog
	function getAnalogs ($dbh) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT AnalogID, AnalogName 
														FROM Analogs");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
	
?>