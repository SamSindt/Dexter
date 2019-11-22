<?php

	function getEvolvesTo($dbh, $evolvesFrom) {

		$sth = $dbh -> prepare("SELECT EvolvesTo
                                FROM Evolutions 
                                WHERE EvolvesFrom =" . $evolvesFrom);
		$sth -> execute();

		return $sth -> fetch();
	}
	
	function getEvolvesFrom($dbh, $evolvesTo) {
		$sth = $dbh -> prepare("SELECT EvolvesFrom
								FROM Evolutions
								WHERE EvolvesTo =" . $evolvesTo);
		$sth -> execute ();
		
		return $sth -> fetch ();
	}	
?>