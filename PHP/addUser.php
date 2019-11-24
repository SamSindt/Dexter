<?php
	require_once ('connDB.php');
	require_once ('basicErrorHandling.php');
	session_start();

	if( (isset($_POST['user']) &&
		isset($_POST['pass'])))
	{
  	$user = $_POST['user'];
		$passwd = $_POST['pass'];
		
		// http://stackoverflow.com/questions/853813/how-to-create-a-random-string-using-php
		// quick and very dirty.
		$salt = substr(hash("sha256",rand()), 0, 20);
		
		$dbh=db_connect_w();
		
		try
  	{
			$sth = $dbh->prepare("INSERT INTO Users (UserName, Password, Salt) 
			VALUES (:UserName,:Password,:Salt)");
		
			$hashedPW = crypt($passwd . $salt, '$2y$07$8d88bb4a9916b302c1c68c$');
	
			$sth->bindValue(":UserName",$user);
			$sth->bindValue(":Password",$hashedPW);
			$sth->bindValue(":Salt",$salt);
		
		
			$sth->execute();
		}
		catch (PDOException $e)
   {
     printf ("The statement failed.\n");
     printf ("getCode: ". $e->getCode () . "\n");
     printf ("getMessage: ". $e->getMessage () . "\n");
   } 
		
		db_close($dbh);
		print "User " . $user ." added";
	}
	else 
	{
		print "No user to be added";
	}
?>

<!doctype html>
<html lang="en-us">

	<head></head>
	<body>
	<br/>
		<ul>
			<li><a href="showPokemonSearch.php">Home</a></li>
			<li><a href="showLogin.php">Login</a></li>
		</ul>
	
	</body>

</html>