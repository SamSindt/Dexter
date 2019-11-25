<?php

function getUnusedAnalog ($dbh, $pkid) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT AnalogID, AnalogName 
								FROM Analogs
								WHERE NOT EXISTS (
									SELECT *
									FROM HasAnalogs
									WHERE PokemonID = " . $pkid . " AND HasAnalogs.AnalogID = Analogs.AnalogID)");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
?>