<?php

	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
	require_once (__DIR__ . '/queryPokemon.php');
	
	 session_start();

    $dbh = db_connect_ro();
?>

<!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<link href="navigationStyles.css" rel="stylesheet">
		<link href="showResultsPageStyles.css" rel="stylesheet">
		<script src="logout.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<title>Search Results</title>
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
								print "<a href='#' onclick='logout(this)'>Logout</a>";
							}
							else {
								print "<a href='showLogin.php'>Login</a>";
							}
						?>
					</li>
				</ul>
		</div>
		
		<div class="results">
			<h1>Search Results</h1>
			<ul>
				<?php
					$searchData = searchPokemon($dbh, $_GET);
					
					foreach ($searchData as $data) {
						print "<li><img src='queryPokemonSprites.php?id=" . $data['PKID'] . "'><a href='showPokemon.php?pkid=" . $data['PKID'] . "'>" . $data['Name'] . "</a></li>";
					}
				?>
			</ul>
		</div>
	</body>
</html>

<?php
	db_close($dbh);
?>