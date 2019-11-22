<?php
	
	function getPokemon ($dbh, $pkid) {

		$sth = $dbh -> prepare("SELECT *
                                FROM Pokemon 
                                WHERE PKID =" . $pkid );
		// run the query
		$sth -> execute();

		return $sth -> fetch();
	}
?>