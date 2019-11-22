<?php

	function getSpecificPokemon($dbh, $pkid)
	{
		$rows = array();

		$sth = $dbh -> prepare("SELECT DexNumber, Name, HP, Attack, Defense, SpAttack, SpDefense, Speed 
                                FROM Pokemon 
                                WHERE PKID =" . $pkid );
		// run the query
		$sth -> execute();

		return $sth -> fetch();
	}
?>