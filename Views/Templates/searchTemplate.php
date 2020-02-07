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
		
		<div class="results">
			<h1>Search Results</h1>
			<ul>
				<?php
                    $spriteIterator = new ArrayIterator($spritesArray);
                    foreach ($pokemonArray as $pokemon) {
                        
                        print "<li><img src='data:" . $spriteIterator->current()["Type"] . ";base64, " . base64_encode($spriteIterator->current()["Image"]) . "'><a href='/Dexter/Profile/Show/" . $pokemon['PKID'] . "/'>" . $pokemon['Name'] . "</a></li>";
                        $spriteIterator->next();
                    }
				?>
			</ul>
		</div>
	</body>
	<?php 
		print "<script>";
		include __DIR__ . "/../Scripts/logout.js";
		print "addLogoutAndStayListener ();</script>";
	?>
</html>