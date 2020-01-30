<?php
    require_once __DIR__ . "/../Models/adminModel.php";
    require_once __DIR__ . "/../Views/adminView.php";
    require_once __DIR__ . "/../Helpers/connDB.php";

    class AdminController {
        public function show () {
            $model = new AdminModel;
            $view = new AdminView ($model);
            $view->output();
        }

        public function deactivate ($userID) {
            $dbh = db_connect_w();
            
            $sth = $dbh->prepare("DELETE FROM Users
                                    WHERE UID = :UserID");
            $sth->bindValue (":UserID", $userID);                     
            $sth->execute();
            db_close($dbh);
        }

        public function makeadmin ($userID) {
            $dbh = db_connect_w();
            $sth = $dbh->prepare("UPDATE Users SET Admin = 1
                                  WHERE UID = :UserIDNum");
            $sth->bindValue(":UserIDNum", $userID);
            $sth->execute();
            db_close($dbh);
        }
    }