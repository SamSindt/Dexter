<?php

 	require_once('basicErrorHandling.php');
	require_once ('connDB.php');
	
	session_start();

	$dbh = db_connect_ro();
?>

<!doctype html>
<html>

	<head>
		<title>logInUser</title>
	</head>

	<body>
		<form method="post" name="formLogin" action=
		"userAuth.php">
		
		Username:
		<input name="txtUser" size="15" type="text"><br/>
		Password:
		<input name="txtPassword" size="15" type="password"><br/>
		
		<input type="submit" name="btnLogin" value="Login">
		
		</form>
	</body>

</html>

<?php
	db_close($dbh);
?>