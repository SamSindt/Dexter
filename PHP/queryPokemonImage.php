<?php
	require_once 'connDB.php';
	
	$dbh = db_connect();

	if( isset($_GET['id']) ) {
	
		$id = $_GET['id'];
		
		//$sth->bindValue(":picid",$id);
		$sth = $dbh->prepare("SELECT Image, Type
							  FROM PokemonImages
							  WHERE IID=:picid");
		$sth->bindValue(":picid",$id);
		
	  $sth->execute();
	  
	  $row = $sth->fetch();
		$data = $row['Image'];
		$type = $row['Type'];
		var_dump($row);
	  Header( "Content-type: $type");
	  print $data;
	  
	}else{
	   print "FILE NOT FOUND";
	}
  db_close($dbh);
?>