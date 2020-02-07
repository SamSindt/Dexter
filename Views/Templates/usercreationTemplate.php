<!doctype html>
<html>

	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Create an Account</title>
        <?php 
            print "<style>";
            include __DIR__ . "/../Styles/navigationStyles.css";
            include __DIR__ . "/../Styles/loginStyles.css";
            print "</style>";
		?>
	</head>
	
	<body>
	<div class="topBar">
		<div class="title"><b>Dexter</b></div>
			<ul class="nav">
				<li class="navItem"><a href="/Dexter/home">Home</a></li>
			</ul>
		</div>
	</div>
		<h1>Create an Account</h1>
		<div class="wrapper">
			<div class="inner">
				<form method="post" action="/Dexter/Usercreation/create">
					<div class="item">Username:<input name="userName" size="15" type="text" ><br></div>
					<div class="item">Password:<input name="password" size="15" type="password" ><br></div>
					<input class="item" type="submit" name="btnRegister" value="Register">
				
				</form>
				<?php
					if (true == $userTakenFlag) {
						print "<p>User Name is already taken. Try another.</p>";
					}
					else if (true == $userWSFlag) {
						print "<p>User Name must contain non-whitespace characters.</p>";
					}
				?>
			</div>
		</div>
	</body>
</html>