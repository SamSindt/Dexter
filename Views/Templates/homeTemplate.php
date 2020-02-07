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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>

	<body>
	
		<div class="topBar">
			<div class="title"><b>Dexter</b></div>
				<ul class="nav">
					<?php 
						if ($isAdmin) {
							print '<li id="admin" class="navItem"><a href="/Dexter/admin/show">Admin</a></li>';
						}
					?>
					<li class="navItem"><a href="/Dexter/home">Home</a></li>
					<li class="navItem">
						<?php
							if ($isLoggedIn) {
								print '<a id="favorites" href="/Dexter/favorites/show">Favorites</a>';
							}
							else {
								print '<a id="favorites" href="/Dexter/login/show" id="login">Favorites</a>';
							}
						?>
					</li>
					<li class="navItem">
						<?php
							if ($isLoggedIn) {
								print '<a href="#" id="logout">Logout</a>';
							}
							else {
								print '<a href="/Dexter/login/show" id="login">Login</a>';
							}
						?>
					</li>
				</ul>
			</div>
		</div>
		
		<h1>Search Pokémon</h1>
	
		<div class="wrapper">
	
		<form method="post" action="home/redirect">
		
		<div class="formField">Name:
			<input TYPE="search" name="NameLike">
		</div>
		

			<div class="formField">ID:
					<?php
						print '<input type="number" name="PKID" min=\"" . $lowestPKID . "\" max=\"" . $highestPKID . "\">';
					?>
			</div>
			
			<div class="formField">Type:
				<select name="TypeID">
					<option value=0></option>
					<?php
						foreach ( $types as $type ) {
							print '<option value=' . $type[0] . '> ' . $type[1] . '</option>';
						}
					?>
				</select>
			</div>

			<div class="formField">Analog:
				<select name="AnalogID">
					<option value=0></option>
					<?php
						foreach ( $analogs as $analog ) {
							print '<option value=' . $analog[0] . '> ' . $analog[1] . '</option>';
						}
					?>
				</select>
			</div>

			
			<div class="formField">Color:
				<select name="ColorID">
					<option value=0></option>
					<?php
						
						foreach ( $colors as $color ) {
							print '<option value=' . $color[0] . '> ' . $color[1] . '</option>';
						}
					?>
				</select>
			</div>
			
			<div class="formField">Egg Group:
				<select name="EggGroupID">
					<option value=0></option>
					<?php
						
						foreach ( $eggGroups as $eggGroup ) {
							print '<option value=' . $eggGroup[0] . '> ' . $eggGroup[1] . '</option>';
						}
					?>
				</select>
			</div>
			
				<input id="search" class="formField" type="submit" name="Request" value="Search">
			</form>
		</div>
	</body>
	<?php 
		print "<script>";
		include __DIR__ . "/../Scripts/logout.js";
		print "addLogoutAndStayListener ();</script>";
	?>
</html>