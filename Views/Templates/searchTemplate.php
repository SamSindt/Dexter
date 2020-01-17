<!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<title>Search Results</title>
		<?php
			print "<style>";
			include __DIR__ . "/../Styles/navigationStyles.css";
			include __DIR__ . "/../Styles/searchStyles.css";
			print "</style>";
		?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	</head>
		
	<body>
		<div class="topBar">
			<div class="title"><b>Pokedex</b></div>
			<ul class="nav">
					<li class="navItem"><!--Admin--></li>
					<li class="navItem"><a href="/Pokedex/home">Home</a></li>
					<li class="navItem"><a href=#><!--Favorites--></a></li>
					<li class="navItem">
						<?php
							if ($isLoggedIn) {
								print '<a href="#" id="logout">Logout</a>';
							}
							else {
								print '<a href="/Pokedex/login/show" id="login">Login</a>';
							}
						?>
					</li>
				</ul>
		</div>
		
		<div class="results">
			<h1>Search Results</h1>
			<ul>
				<?php
                    $spriteIterator = new ArrayIterator($spritesArray);
                    foreach ($pokemonArray as $pokemon) {
                        
                        print "<li><img src='data:" . $spriteIterator->current()["Type"] . ";base64, " . base64_encode($spriteIterator->current()["Image"]) . "'><a href='/Pokedex/Profile/Show/" . $pokemon['PKID'] . "/'>" . $pokemon['Name'] . "</a></li>";
                        $spriteIterator->next();
                    }
				?>
			</ul>
		</div>
	</body>
	<?php 
		print "<script>";
		include __DIR__ . "/../Scripts/logout.js";
		print "</script>";
	?>
</html>