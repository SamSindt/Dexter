<?php
	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
	
	if(isset($_POST['AnalogID']) && isset($_POST['pkid'])) {
		$dbh = db_connect_w();
		
		$sth = $dbh->prepare("INSERT INTO HasAnalogs (PokemonID, AnalogID)
							  VALUES (" . $_POST['pkid'] . ", " . $_POST['AnalogID'] . ")");
		print var_dump($sth);
		$sth->execute();
		db_close($dbh);
	}
	header ("Location: showPokemon.php?pkid=" . $_POST['pkid']);
?> 