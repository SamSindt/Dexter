<!doctype html>
<html lang="en-us">
    <head>
		<meta charset="utf-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <title>Admin</title>
        <?php
			print "<style>";
                include __DIR__ . "/../Styles/navigationStyles.css";
                include __DIR__ ."/../Styles/adminStyles.css";
			print "</style>";
		?>
    </head>

		<body>
			<div class="topBar">
				<div class="title"><b>Pokedex</b></div>
				<ul class="nav">
					<li class="navItem">
						<?php /*
							if (isset($_SESSION['isAdmin'])) {
								if (TRUE == $_SESSION['isAdmin']) {
									print "<a href='showAdminPage.php'>Admin</a>";
								}
							}
						*/ ?>
					</li>
                    <li class="navItem"><a href="/Pokedex/home">Home</a></li>
                    <li class="navItem">
                    <?php
							if ($isLoggedIn) {
								print '<a id="favorites" href="/Pokedex/favorites/show">Favorites</a>';
							}
							else {
								print '<a id="favorites" href="/Pokedex/login/show" id="login">Favorites</a>';
							}
                    ?>
                    </li>
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
			<div class="wrapper">
                <ul>
                <?php
                    foreach ($users as $user) {
                        print "<li>" . $user['UserName'] . "</li>";
                    }
                ?>
                </ul>
			</div>
		</body>
</html>
 
 <?php 
	db_close($dbh);
 ?>