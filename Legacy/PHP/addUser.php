<?php
	require_once ('connDB.php');
	require_once ('basicErrorHandling.php');
	session_start();

	if( (isset($_POST['user']) && isset($_POST['pass']))) {
		$user = $_POST['user'];
		$passwd = $_POST['pass'];
		
		$salt = substr(hash("sha256",rand()), 0, 20);
		
		$dbh=db_connect_w();
	
		try {
			$sth = $dbh->prepare("INSERT INTO Users (UserName, Password, Salt) 
			VALUES (:UserName,:Password,:Salt)");
		
			$hashedPW = crypt($passwd . $salt, '$2y$07$8d88bb4a9916b302c1c68c$');
	
			$sth->bindValue(":UserName",$user);
			$sth->bindValue(":Password",$hashedPW);
			$sth->bindValue(":Salt",$salt);
		
		
			$sth->execute();
		}
		catch (PDOException $e)  {
			printf ("The statement failed.\n");
			printf ("getCode: ". $e->getCode () . "\n");
			printf ("getMessage: ". $e->getMessage () . "\n");
		} 
		
		db_close($dbh);
		print "User " . $user ." added";
	}
	else {
	    print "No user to be added";
	}
?>

<!doctype html>
<html lang="en-us">

	<head>
	<meta http-equiv = "refresh" content = "0; url = ./showAddUser.php">
	</head>
	<body>
	<br>	
	</body>

</html>	