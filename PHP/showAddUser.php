<?php

 	/*require_once('basicErrorHandling.php');
	require_once ('connDB.php');
	
	session_start();
	$dbh = db_connect_ro();*/
?>

<!doctype html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Create an Account</title>
	</head>
	
	<body>
	<h1>Create an Account</h1>
		
		<form method="post" action="addUser.php">
		
		Username:
		<input name="user" size="15" type="text" ><br>
		Password:
		<input name="pass" size="15" type="password" ><br>
		
		<input TYPE="submit" NAME="btnRegister" VALUE="Register">
		
		</form>
	</body>

</html>

<?php
	//db_close($dbh);
?>