<?php

function getUnusedColors ($dbh, $pkid) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT ColorID, ColorName 
								FROM Colors
								WHERE NOT EXISTS (
									SELECT *
									FROM HasColors
									WHERE PokemonID = " . $pkid . " AND HasColors.ColorID = Colors.ColorID)");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
?>