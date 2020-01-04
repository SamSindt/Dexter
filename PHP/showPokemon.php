<?php

	require_once (__DIR__ . '/basicErrorHandling.php');
    require_once (__DIR__ . '/connDB.php');
    require_once (__DIR__ . '/queryPokemon.php');
	require_once (__DIR__ . '/queryType.php');
	require_once (__DIR__ . '/queryType.php');
	require_once (__DIR__ . '/queryEvolutions.php');
	require_once (__DIR__ . '/queryEggGroups.php');
	require_once (__DIR__ . '/queryFavorites.php');
	require_once (__DIR__ . '/queryColors.php');
	require_once (__DIR__ . '/queryAnalog.php');
	
	if(isset($_GET['pkid'])) {
		$pkid = $_GET['pkid'];
	}
	else {
		$pkid = 0;
		header("Location: showPokemonSearch.php");
	}
		
    //session_start();

    $dbh = db_connect_ro();
	
	$pkData = getPokemon ($dbh, $pkid);
	
?>
		
<!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<link href="showPokemonStyles.css" rel="stylesheet">
		<link href="navigationStyles.css" rel="stylesheet">
		<script src="logout.js"></script>
		<script src="favoriting.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title><?php print $pkData['Name']?></title>
    <head>

		<body>
			<div class="topBar">
				<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem">
						<?php 
							if (isset($_SESSION['isAdmin'])) {
								if (TRUE == $_SESSION['isAdmin']) {
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
			
			<div class="wrapper">
				<div class="card">
					<div class="header">
						<h1 id="pkName"><?php print $pkData['Name'] ?></h1>
						<?php 
							if (isset($_SESSION['VALID']) && 1 == $_SESSION['VALID']) {
								if (checkIfFavorite($dbh, $pkData['PKID'])) {
									print "<h1 class='fave' id='faved' onclick='unfavorite(this, " . $pkData['PKID'] . ")'>★</h1> ";
								}
								else {
									print "<h1 class='fave' id='unfaved' onclick='favorite(this, " . $pkData['PKID'] . ")'>☆</h1>";
								}
							}
							else {
								print "<h1 class='fave' id='unfaved'><a href='showLogin.php'>☆</a></h1>";
							}
						?>
					</div>
					
					<img src="queryPokemonImage.php?id=<?php print $pkid ?>" id="pkImage"></br>
					
					<div id="numAndTypes">
					
						<h4 id="pkNumber"><?php print 'Pokedex # ' . $pkData['DexNumber'] ?></h4>
						
						<div id="pkTypes">
							<h4>Type: </h4>
							<?php 
								$typeData = getTypeImageIDByPokemon($dbh, $pkid);
								foreach ($typeData as $row) {
									print "<img src=queryTypeImage.php?id=" . $row['TypeImageID'] . ">";
								}
							?>
						
						</div>
					</div>
					
					<div id="pkEvol">
						<?php
							$evFromData = getEvolvesFrom($dbh, $pkid);
							if ($evFromData) {
								 $evFromPKData = getPokemon ($dbh, $evFromData['EvolvesFrom']);
								 print "<h4 id='evolFr'>Evolves From: <a href='showPokemon.php?pkid=" . $evFromPKData['PKID'] . "'>" 
									. $evFromPKData['Name'] . "</a></h4>";
							}
							
							$evToData = getEvolvesTo($dbh, $pkid);
							if ($evToData) {
								$evToPKData = getPokemon($dbh, $evToData['EvolvesTo']);
								print "<h4 id='evolTo'>Evolves To: <a href='showPokemon.php?pkid=" . $evToPKData['PKID'] . "'>"
									. $evToPKData['Name'] . "</a></h4>";
							}
						?>
					</div>
					
					<div id="pkStats">
					
					<h4><u>Base Stats</u></h4>
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
				</div>
				
				<div id="pkEggs">
					<?php
						$eggData = getEggGroupName($dbh, $pkid);
						if ($eggData) {
							$eggNamesStr = "";
							
							foreach ($eggData as $eggRow) {
								$eggNamesStr = $eggNamesStr . $eggRow['GroupName'];
								if ($eggRow != end ($eggData)) {
									$eggNamesStr = $eggNamesStr . " and ";
								}
							}
							
							print "<h4>Egg Group: " . $eggNamesStr . "</h4>";
						}
					?>
				</div>
				<div class="adminChanges">
					<?php 
						if (isset($_SESSION['VALID']) && 1 == $_SESSION['VALID'] && $_SESSION['isAdmin']) {
							//Colors
							print "<form method='post' action='addColor.php'>
								<input type='hidden' name='pkid' value='" . $pkData['PKID'] . "'><select name='ColorID'>";
			
							$colorData = getUnusedColors($dbh, $pkData['PKID']);
							
							foreach ( $colorData as $row ) {
								print '<option value=' . $row[0] . '> ' . $row[1] . '</option>';
							}
				
							print "</select><input TYPE='submit' NAME='btn' VALUE='Add Color'></form>";
							
							//Anologs
							print "<form method='post' action='addAnalog.php'>
								<input type='hidden' name='pkid' value='" . $pkData['PKID'] . "'><select name='AnalogID'>";
								
							$anologData = getUnusedAnalog($dbh, $pkData['PKID']);
							
							foreach ($anologData as $row) {
								print "<option value=" . $row[0] . ">" . $row[1] . "</option>";
							}
							
							print "</select><input TYPE='submit' NAME='btn' VALUE='Add Analog'></form>";
								
						}
					?>
				</div>
				
			</div>
		</di>
    </body>
</html>

<?php
	db_close($dbh);
?>