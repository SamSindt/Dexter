<?php

	function db_connect_ro () {
	 $dbh = new PDO("mysql:host=127.0.0.1;dbname=Pokedex_DB", 
		"dex_user_ro", "ro_password");
		
	 $dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 return ($dbh);
	}
	 
	 function db_connect_w () {
		$dbh = new PDO("mysql:host=127.0.0.1;dbname=Pokedex_DB", 
		"dex_user_w", "w_password");
		$dbh->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		return ($dbh);
	}

	function db_close (&$dbh) {
		$dbh = NULL;
	}
	 
?>