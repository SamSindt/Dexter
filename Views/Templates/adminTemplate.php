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
            <div class="title"><b>Dexter</b></div>
            <ul class="nav">
                <li class="navItem"><a href="/Dexter/admin/show">Admin</a></li>
                <li class="navItem"><a href="/Dexter/home">Home</a></li>
                <li class="navItem"><a id="favorites" href="/Dexter/favorites/show">Favorites</a></li>
                <li class="navItem"><a id="logout" href="#">Logout</a></li>
            </ul>
        </div>
        <div class="wrapper">
            <h1 id="title">Users</h1>
            <ul id="list">
            <?php
                foreach ($users as $user) {
                    print "<li>" . $user['UserName'] . "<button class='makeAdmin' id='" . $user['UID'] . "'>Make Admin</button><button class='deactivate' id='" . $user['UID'] . "'>Deactive</button></li>";
                }
            ?>
            </ul>
        </div>
    </body>
    <?php
    print "<script>";
    include __DIR__ . "/../Scripts/logout.js";
    include __DIR__ . "/../Scripts/adminPageListeners.js";
    print "addLogoutAndRedirectListener (); addDeactivateListeners (); addMakeAdminListeners ();</script>";
    ?>
</html>