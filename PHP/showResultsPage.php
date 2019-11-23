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
		<link href="showPokemonStyles.css" rel="stylesheet">
		<title>Search Results</title>
	</head>
		
	<body>
		<ul>
			<?php
				$searchData = searchPokemon($dbh, $_POST);
				
				foreach ($searchData as $data) {
					print "<li><a href='showPokemon.php?pkid=" . $data['PKID'] . "'>" . $data['Name'] . "</a></li>";
				}
			?>
		</ul>
	</body>
</html>

<?php
	db_close($dbh);
?>