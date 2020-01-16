<!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<style>
            <?php
                include __DIR__ . "/../Styles/navigationStyles.css";
                include __DIR__ . "/../Styles/loginStyles.css";
            ?>
        </style>
		<title>Login Screen</title>
	</head>
	
	<body>
		<div class="topBar">
			<div class="title"><b>Pokedex</b></div>
			<ul class="nav">
				<li class="navItem"><a href="showPokemonSearch.php">Home</a></li>
			</ul>
		</div>
		
		<div class="wrapper">
			<div class="inner">
				<h1>Login</h1>
				
				<form method="post" name="formLogin" action="userAuth.php">
					<div class="item">Username:<input name="txtUser" size="15" type="text"><br></div>
					<div class="item">Password:<input name="txtPassword" size="15" type="password"><br></div>
					
					<input class="item" id="submit" TYPE="submit" NAME="btnLogin" VALUE="Login">
				</form>
				<a href="showAddUser.php">Create an Account</a>
			</div>
		</div>
	</body>
</html>