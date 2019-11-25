<?php
	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
	
	if(isset($_POST['ColorID']) && isset($_POST['pkid'])) {
		$dbh = db_connect_w();
		
		$sth = $dbh->prepare("INSERT INTO HasColors (PokemonID, ColorID)
							  VALUES (" . $_POST['pkid'] . ", " . $_POST['ColorID'] . ")");
		$sth->execute();
		db_close($dbh);
	}
	header ("Location: showPokemon.php?pkid=" . $_POST['pkid']);
?> 