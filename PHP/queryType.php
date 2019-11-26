<?php
	require_once('basicErrorHandling.php');

	function getTypeImageIDByPokemon($dbh, $pokemonID) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT TypeImageID
                                FROM HasTypes, Types
                                WHERE PokemonID = " . $pokemonID . " AND HasTypes.TypeID = Types.TypeID" );
		// run the query
		$sth -> execute();
		
		while ($row = $sth -> fetch ()) {
			$rows[] = $row;
		}
		return $rows;
	}
?>	