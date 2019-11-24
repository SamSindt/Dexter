<?php

 	/*require_once('basicErrorHandling.php');
	require_once ('connDB.php');
	
	session_start();

	$dbh = db_connect_ro();*/
?>

<!doctype html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Login Screen</title>
	</head>
	
	<body>
		<h1>Login</h1>
		
		<form method="post" name="formLogin" action="userAuth.php">
		Username:
		<input name="txtUser" size="15" type="text"><br>
		Password:
		<input name="txtPassword" size="15" type="password"><br>
		
		<input TYPE="submit" NAME="btnLogin" VALUE="Login">
		
		</form>
	</body>

</html>

<?php
	/*db_close($dbh);*/
?>