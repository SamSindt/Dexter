<!doctype html>
<html lang="en-us">

	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<?php
			print "<style>";
			include __DIR__ . "/../Styles/navigationStyles.css";
			include __DIR__ . "/../Styles/homeStyles.css";
			print "</style>";
		?>
	</head>

	<body>
	
		<div class="topBar">
			<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem"><!--Admin-->
					</li>
					<li class="navItem"><a href="/Pokedex/home">Home</a></li>
					<li class="navItem"><a href=#><!--Favorites--></a></li>
					<li class="navItem"><a href="/Pokedex/login/show">Login</a></li>
				</ul>
			</div>
		</div>
		
		<h1>Search Pokemon</h1>
	
		<div class="wrapper">
	
		<form method="post" action="home/redirect">
		
		<div class="formField">Name:
			<input TYPE="search" NAME="NameLike">
		</div>
		

			<div class="formField">ID:
				<input TYPE="number" NAME="PKID"
					<?php
						print " MIN=\"" . $lowestPKID . "\" MAX=\"" . $highestPKID . "\">";
					?>
			</div>
			
			<div class="formField">Type:
				<select NAME="TypeID">
					<option VALUE=0></option>
					<?php
						foreach ( $types as $type ) {
							print '<option VALUE=' . $type[0] . '> ' . $type[1] . '</option>';
						}
					?>
				</select>
			</div>

			<div class="formField">Analog:
				<select NAME="AnalogID">
					<option VALUE=0></option>
					<?php
						foreach ( $analogs as $analog ) {
							print '<option VALUE=' . $analog[0] . '> ' . $analog[1] . '</option>';
						}
					?>
				</select>
			</div>

			
			<div class="formField">Color:
				<select NAME="ColorID">
					<option VALUE=0></option>
					<?php
						
						foreach ( $colors as $color ) {
							print '<option VALUE=' . $color[0] . '> ' . $color[1] . '</option>';
						}
					?>
				</select>
			</div>
			
			<div class="formField">Egg Group:
				<select NAME="EggGroupID">
					<option VALUE=0></option>
					<?php
						
						foreach ( $eggGroups as $eggGroup ) {
							print '<option VALUE=' . $eggGroup[0] . '> ' . $eggGroup[1] . '</option>';
						}
					?>
				</select>
			</div>
			
				<input id="search" class="formField" TYPE="submit" NAME="Request" VALUE="Search">
			</form>
		</div>
	</body>
</html>