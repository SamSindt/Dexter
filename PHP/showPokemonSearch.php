<?php
 	require_once __DIR__ . '/basicErrorHandling.php';
	require_once __DIR__ . '/connDB.php';
	require_once __DIR__ . '/querySearchParams.php';
	
	session_start();

	 $dbh = db_connect_ro();
?>

<html>

	<head>
		<title></title>
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
	
	<form method="post" action="showResultsPage.php">

	Name:
	<input TYPE="search" NAME="NameLike">
	<p>

	ID:
	<input TYPE="number" NAME="PKID"
		<?php
			print " MIN=\"" . getLowestPKID($dbh) . "\" MAX=\"" . getHighestPKID($dbh) . "\">";
		?>
	<p>
	
	Type:
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
	<p>
	
	Analog:
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
	<p>
	
	Color:
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
	<p>
	
	Egg Group:
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
	<p>
	
	<input TYPE="submit" NAME="Request" VALUE="Search" />
		
	</body>
</form>

</html>

<?php
	db_close($dbh);
?>