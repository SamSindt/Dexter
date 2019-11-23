<?php

 	require_once('basicErrorHandling.php');
	require_once ('connDB.php');
	
	session_start();

	$dbh = db_connect_ro();
?>

<!doctype html>
<html>

	<head>
		<title>Create an Account</title>
	</head>

	<body>
		<form method="post" name="formRegister" action=
		"addUser.php">
		
		Username:
		<input name="user" size="15" type="text"><br/>
		Password:
		<input name="pass" size="15" type="password"><br/>
		
		<input type="submit" name="btnRegister" value="Register">
		
		</form>
	</body>

</html>

<?php
	db_close($dbh);
?>