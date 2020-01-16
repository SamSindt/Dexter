<!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<link href="showPokemonStyles.css" rel="stylesheet">
        <style>
            <?php
                include __DIR__ . "/../Styles/navigationStyles.css";
                include __DIR__ . "/../Styles/profileStyles.css";
            ?>
        </style>
        <title><?php $pokemonName?></title>
    <head>

		<body>
			<div class="topBar">
				<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem"><!--Admin--></li>
					<li class="navItem"><a href="/Pokedex/home">Home</a></li>
					<li class="navItem"><a href=#><!--Favorites--></a></li>
					<li class="navItem"><a href="/Pokedex/login/show">Login</a></li>
				</ul>
			</div>
			
			<div class="wrapper">
				<div class="card">
					<div class="header">
						<h1 id="pkName"><?php $pokemonName ?></h1><!--Favoriting--></div>
					
					<img src=<?php print "'data:" . $profileImage["Type"] . ";base64, " . base64_encode($profileImage["Image"]) ."'";?> id="pkImage";></br>
					
					<div id="numAndTypes">
					
						<h4 id="pkNumber"><?php print 'Pokedex # ' . $dexNumber ?></h4>
						
						<div id="pkTypes">
							<h4>Type: </h4>
							<?php 
								foreach ($typeImages as $typeImage) {
                                    print "<img src='data:" . $typeImage["Type"] . ";base64, " . base64_encode($typeImage["Image"]) . "'>";
								}
							?>
						
						</div>
					</div>
					
					<div id="pkEvol">
						<?php
							
							if (!empty($evolvesFrom)) {
								 print "<h4 id='evolFr'>Evolves From: <a href='/Pokedex/Profile/Show/" . $evolvesFrom["EvolvesFrom"] . "/'>" 
									. $evolvesFrom["Name"] . "</a></h4>";
							}
							
							
							if (!empty($evolvesTo)) {
								print "<h4 id='evolTo'>Evolves To: <a href='/Pokedex/Profile/Show/" . $evolvesTo["EvolvesTo"] . "'>"
									. $evolvesTo["Name"] . "</a></h4>";
							}
						?>
					</div>
					
					<div id="pkStats">
					
					<h4><u>Base Stats</u></h4>
					<table>
						<tr>
							<th>HP</th><th><?php print $HP ?></th>
						</tr>
						<tr>
							<th>Attack</th><th><?php print $attack ?></th>
						</tr>
						<tr>
							<th>Defense</th><th><?php print $defense ?></th>
						</tr>
						<tr>
							<th>Special Attack</th><th><?php print $spAttack ?></th>
						</tr>
						<tr>
							<th>Special Defense</th><th><?php print $spDefense ?></th>
						</tr>
						<tr>
							<th>Speed</th><th><?php print $speed ?></th>
						</tr>
					</table>
				</div>
				
				<div id="pkEggs">
					<?php
						if (!empty($eggGroups)) {
							$eggNamesStr = "";
							
							foreach ($eggGroups as $eggGroup) {
								$eggNamesStr = $eggNamesStr . $eggGrou['GroupName'];
								if ($eggGrou != end ($eggGroups)) {
									$eggNamesStr = $eggNamesStr . " and ";
								}
							}
							
							print "<h4>Egg Group: " . $eggNamesStr . "</h4>";
						}
					?>
				</div>
				<div class="adminChanges">
				</div>
				
			</div>
		</di>
    </body>
</html>