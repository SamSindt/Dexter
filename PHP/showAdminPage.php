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
		<link href="showPokemonStyles.css" rel="stylesheet">
		<link href="navigationStyles.css" rel="stylesheet">
		<script src="logout.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Admin Page</title>
    </head>

		<body>
			<div class="topBar">
				<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem"><a href="showPokemonSearch.php">Home</a></li>
					<li class="navItem"><a>Team</a></li>
					<li class="navItem"><a>Favorites</a></li>
					<li class="navItem">
						<?php 
							if (isset($_SESSION['VALID']) && 1 == $_SESSION['VALID']) {
								print "<a href='#' onclick='logout(this)'>Logout</a>";
							}
							else {
								print "<a href='showLogin.php'>Login</a>";
							}
						?>
					</li>
					<li class="navItem">
						<?php 
							if (TRUE == $_SESSION['isAdmin'])
							{
								print "<a href='showAdminPage.php'>Admin</a>";
							}
						?>
					</li>
				</ul>
			</div>
			<h1>Welcome Admin</h1>
			<h3>All Non-Admin</h3>
			<div>
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
			<h3>Make Admin?</h3>
			<form method="post" action="showUpdateUser.php">
			
			<div>UserID of new Admin:	<input name="txtUserID" size="15" type="text"><br></div>
			<input TYPE="submit" NAME="btnUserUpdate" VALUE="Make Admin">
			
			</form>
		</body>
		
</html>
 
 <?php 
	db_close($dbh);
 ?>