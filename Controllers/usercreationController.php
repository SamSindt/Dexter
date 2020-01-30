<?php
    require_once __DIR__ . "/../Views/usercreationView.php";
    require_once __DIR__ . "/../Helpers/connDB.php";

    class UsercreationController {

        public function show () {
            $view = new UsercreationView ();
            $view->output ();
        }

        public function create () {
            if (isset ($_POST["userName"]) && isset ($_POST["password"])) {
                $userName = $_POST["userName"];
                $password = $_POST["password"];

                $salt = substr(hash("sha256",rand()), 0, 20);
		
                $dbh=db_connect_w();

                if ($this->userAlreadyExists ($dbh, $userName)) {
                    //print message on screen;
                    print "test";
                }
                else {
                    $sth = $dbh->prepare("INSERT INTO Users (UserName, Password, Salt) 
                    VALUES (:UserName,:Password,:Salt)");
                
                    $hashedPW = crypt($password . $salt, '$2y$07$8d88bb4a9916b302c1c68c$');
    
                    $sth->bindValue(":UserName",$userName);
                    $sth->bindValue(":Password",$hashedPW);
                    $sth->bindValue(":Salt",$salt);
                
                    $sth->execute();
                    
                    db_close($dbh);

                    header ("Location: /Pokedex/login/show");
                }             
            }               
        }

        private function userAlreadyExists ($dbh, $userName) {
            $sth = $dbh->prepare("SELECT UserName
                                  FROM Users
                                  WHERE UserName LIKE :UserName");
            $sth->bindValue(":UserName", $userName);
        
            $sth->execute ();

            return 0 < $sth->rowCount ();
        }
    }
?>