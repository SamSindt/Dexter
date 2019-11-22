<?php

	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
    require_once (__DIR__ . '/querySpecificPokemon.php');
	
	if(isset($_GET['pkid'])) {
		$pkid = $_GET['pkid'];
	}
	else {
		$pkid = 0;
		//riderect to home page
	}
		
    session_start();

    $dbh = db_connect_ro();
	
	$data = getSpecificPokemon ($dbh, $pkid);
?>
		
<html>
    <head>
        <title><?php print $data['Name']?></title>
    <head>

    <body>
		<h1><?php print $data['Name'] ?></h1>
	
		<img src="queryPokemonImage.php?id=<?php print $pkid ?>"></br>
		
        <h3><?php print 'DexNumber: ' . $data['DexNumber'] ?></h3>
		
		<table>
			<tr>
				<th>HP</th><th><?php print $data['HP'] ?></th>
			</tr>
			<tr>
				<th>Attack</th><th><?php print $data['Attack'] ?></th>
			</tr>
			<tr>
				<th>Defense</th><th><?php print $data['Defense'] ?></th>
			</tr>
			<tr>
				<th>Special Attack</th><th><?php print $data['SpDefense'] ?></th>
			</tr>
			<tr>
				<th>Special Defense</th><th><?php print $data['SpAttack'] ?></th>
			</tr>
			<tr>
				<th>Speed</th><th><?php print $data['Speed'] ?></th>
			</tr>
		</table>
    </body>
</html>

<?php
	db_close($dbh);
?>