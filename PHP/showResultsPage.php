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
		<link href="showResultsPageStyles.css" rel="stylesheet">
		<title>Search Results</title>
	</head>
		
	<body>
		<div class="topBar">
			<div class="title"><b>Pokedex</b></div>
			<ul class="nav">
				<li class="navItem"><a>Home</a></li>
				<li class="navItem"><a>Search</a></li>
				<li class="navItem"><a>Team</a></li>
				<li class="navItem"><a>Favorites</a></li>
				<li class="navItem"><a>Login</a></li>
			</ul>
		</div>
		
		<div class="results">
			<ul>
				<?php
					$searchData = searchPokemon($dbh, $_POST);
					
					foreach ($searchData as $data) {
						print "<li><a href='showPokemon.php?pkid=" . $data['PKID'] . "'>" . $data['Name'] . "</a></li>";
					}
				?>
			</ul>
		</div>
	</body>
</html>

<?php
	db_close($dbh);
?>