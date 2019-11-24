<?php
 	require_once __DIR__ . '/basicErrorHandling.php';
	require_once __DIR__ . '/connDB.php';
	require_once __DIR__ . '/querySearchParams.php';
	
	session_start();

	$dbh = db_connect_ro();
?>

<!doctype html>
<html lang="en-us">

	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<link href="navigationStyles.css" rel="stylesheet">
		<link href="showPokemonSearchStyles.css" rel="stylesheet">
	</head>

	<body>
	
		<div class="topBar">
			<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem"><a href="showPokemonSearch.php">Home</a></li>
					<li class="navItem"><a>Team</a></li>
					<li class="navItem"><a>Favorites</a></li>
					<li class="navItem"><a>Login</a></li>
				</ul>
			</div>
		</div>
		
		<h1>Search Pokemon</h1>
	
		<div class="wrapper">
	
		<form method="get" action="showResultsPage.php">
		
		<div class="formField">Name:
			<input TYPE="search" NAME="NameLike">
		</div>
		

			<div class="formField">ID:
				<input TYPE="number" NAME="PKID"
					<?php
						print " MIN=\"" . getLowestPKID($dbh) . "	\" MAX=\"" . getHighestPKID($dbh) . "\">";
					?>
			</div>
			
			<div class="formField">Type:
				<select NAME="TypeID">
					<option VALUE=0></option>
					<?php
						$data = getTypes($dbh);
						
						foreach ( $data as $row )
						{
							print '<option VALUE=' . $row[0] . '> ' . $row[1] . '</option>';
						}
					?>
				</select>
			</div>

			<div class="formField">Analog:
				<select NAME="AnalogID">
					<option VALUE=0></option>
					<?php
						$data = getAnalogs($dbh);
						
						foreach ( $data as $row )
						{
							print '<option VALUE=' . $row[0] . '> ' . $row[1] . '</option>';
						}
					?>
				</select>
			</div>

			
			<div class="formField">Color:
				<select NAME="ColorID">
					<option VALUE=0></option>
					<?php
						$data = getColors($dbh);
						
						foreach ( $data as $row )
						{
						print '<option VALUE=' . $row[0] . '> ' . $row[1] . '</option>';
						}
					?>
				</select>
			</div>
			
			<div class="formField">Egg Group:
				<select NAME="EggGroupID">
					<option VALUE=0></option>
					<?php
						$data = getEggGroups($dbh);
						
						foreach ( $data as $row )
						{
						print '<option VALUE=' . $row[0] . '> ' . $row[1] . '</option>';
						}
					?>
				</select>
			</div>
			
				<input id="search" class="formField" TYPE="submit" NAME="Request" VALUE="Search">
			</form>
		</div>
	</body>
</html>

<?php
	db_close($dbh);
?>