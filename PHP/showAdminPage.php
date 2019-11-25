<?php 

	require_once (__DIR__ . '/basicErrorHandling.php');
	require_once (__DIR__ . '/connDB.php');
	require_once ('checkUserAuth.php');
	require_once ('queryGetUserInfo.php');
	
	checkUserAuth();
	
	$dbh = db_connect_w();

 ?>
 
 <!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<link href="navigationStyles.css" rel="stylesheet">
		<link href="showAdminPageStyles.css" rel="stylesheet">
		<script src="logout.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Admin</title>
    </head>

		<body>
			<div class="topBar">
				<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem">
						<?php 
							if (isset($_SESSION['isAdmin']))
							{
								if (TRUE == $_SESSION['isAdmin'])
								{
									print "<a href='showAdminPage.php'>Admin</a>";
								}
							}
						?>
					</li>
					<li class="navItem"><a href="showPokemonSearch.php">Home</a></li>
					<li class="navItem"><a href="showFavorites.php">Favorites</a></li>
					<li class="navItem">
						<?php 
							if (isset($_SESSION['VALID']) && 1 == $_SESSION['VALID']) {
								session_destroy();
								print "<a href='showPokemonSearch.php'>Logout</a>";
							}
							else {
								print "<a href='showLogin.php'>Login</a>";
							}
						?>
					</li>
				</ul>
			</div>
			<div class="wrapper">
				<form method="post" action="showUpdateUser.php">
			
					<div>UserID:<input name="txtUserID" size="15" type="text">
						<input TYPE="submit" NAME="btnUserUpdate" VALUE="Make Admin">
					</div>
				
				</form>
				<table>
					<tr><th>UserID</th><th>UserName</th></tr>
					<?php 
						$userData = queryGetUserInfo($dbh);
						foreach ($userData as $row)
						{
							print "<tr><th>" . $row[0] . "</th><th>" . $row[1] . "</th></tr>";
						}
					?>
				</table>
			</div>
		</body>
</html>
 
 <?php 
	db_close($dbh);
 ?>