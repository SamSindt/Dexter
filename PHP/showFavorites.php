<?php

	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
	require_once (__DIR__ . '/queryFavorites.php');

    session_start();

    $dbh = db_connect_ro();
	
?>

<!doctype html>
<html lang="en-us">

	<head>
		<meta charset="utf-8">
		<title>Favorites</title>
		<link href="navigationStyles.css" rel="stylesheet">
		<link href="showResultsPageStyles.css" rel="stylesheet">
		<link href="showFavoritesStyles.css" rel="stylesheet">
		<script src="logout.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
	<body>
		<div class="topBar">
			<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem"><a href="showPokemonSearch.php">Home</a></li>
					<li class="navItem"><a>Team</a></li>
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
		</div>
		
		<div class="results">
			<h1>Favorites</h1>
			<ul>
				<?php
					if (isset($_SESSION['VALID']) && 1 == $_SESSION['VALID']) {
						$favoritesData = getUserFavorites($dbh);
						foreach ($favoritesData as $favorite) {
							print "<li><img src='queryPokemonSprites.php?id=" 
								. $favorite['PKID'] . "'><a href='showPokemon.php?pkid=" 
								. $favorite['PKID'] . "'>" . $favorite['Name']
								. "</a><form action='deleteFavorite.php' method='post'>
								<button type='submit' name='pkid' value='". $favorite['PKID']
								. "' class='close'>X</button></form></li>";
						}
						
					}
					else {
						print "<h2 style='text-align: center'>Login to view your favorites</h2>";
					}
				?>
			</ul>
		</div>
	</body>
</html>