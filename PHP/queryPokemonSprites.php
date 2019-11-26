<?php
	require_once('connDB.php');
	require_once('basicErrorHandling.php');
	
	$dbh = db_connect_ro();

	if( isset($_GET['id']) ) {
	
		$id = $_GET['id'];
		
		$sth = $dbh->prepare("SELECT Image, Type
							  FROM PokemonSprites
							  WHERE SID = " . $id);
		
		$sth->execute();
	  
		$row = $sth->fetch();
		$data = $row['Image'];
		$type = $row['Type'];
		Header( "Content-type: $type");
		print $data;
	  
	}
	else{
	   print "FILE NOT FOUND";
	}
	
	db_close($dbh);
?>