<?php

	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
    require_once (__DIR__ . '/queryPokemon.php');
	require_once (__DIR__ . '/queryType.php');
	require_once (__DIR__ . '/queryType.php');
	require_once (__DIR__ . '/queryEvolutions.php');
	
	if(isset($_GET['pkid'])) {
		$pkid = $_GET['pkid'];
	}
	else {
		$pkid = 0;
		//riderect to home page
	}
		
    session_start();

    $dbh = db_connect_ro();
	
	$pkData = getPokemon ($dbh, $pkid);
	
?>
		
<!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<link href="showPokemonStyles.css" rel="stylesheet">
        <title><?php print $pkData['Name']?></title>
    <head>

		<body>
			<h1 class="col" id="pkName"><?php print $pkData['Name'] ?></h1>
		
			<img src="queryPokemonImage.php?id=<?php print $pkid ?>"></br>
			
			<h3 class="col" id="pkNumber"><?php print 'Pokedex Number: ' . $pkData['DexNumber'] ?></h3>
		
			<?php 
				$typeData = getTypeImageIDByPokemon($dbh, $pkid);
				foreach ($typeData as $row) {
					print "<img src=queryTypeImage.php?id=" . $row['TypeImageID'] . ">";
				}
				
				$evFromData = getEvolvesFrom($dbh, $pkid);
				if ($evFromData) {
					 $evFromPKData = getPokemon ($dbh, $evFromData['EvolvesFrom']);
					 print "<h4> Evolves From: <a href='showPokemon.php?pkid=" . $evFromPKData['PKID'] . "'>" 
						. $evFromPKData['Name'] . "</a></h4>";
				}
				
				$evToData = getEvolvesTo($dbh, $pkid);
				if ($evToData) {
					$evToPKData = getPokemon($dbh, $evToData['EvolvesTo']);
					print "<h4> Evolves To: <a href='showPokemon.php?pkid=" . $evToPKData['PKID'] . "'>"
						. $evToPKData['Name'] . "</a></h4>";
				}
			?>
			
			<h3><u>Base Stats</u><h3>
			<table>
				<tr>
					<th>HP</th><th><?php print $pkData['HP'] ?></th>
				</tr>
				<tr>
					<th>Attack</th><th><?php print $pkData['Attack'] ?></th>
				</tr>
				<tr>
					<th>Defense</th><th><?php print $pkData['Defense'] ?></th>
				</tr>
				<tr>
					<th>Special Attack</th><th><?php print $pkData['SpDefense'] ?></th>
				</tr>
				<tr>
					<th>Special Defense</th><th><?php print $pkData['SpAttack'] ?></th>
				</tr>
				<tr>
					<th>Speed</th><th><?php print $pkData['Speed'] ?></th>
				</tr>
			</table>
			
			
			
    </body>
</html>

<?php
	db_close($dbh);
?>