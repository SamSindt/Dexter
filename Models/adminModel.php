<?php
    require_once __DIR__ . "/../Helpers/connDB.php";

    class AdminModel {
        public $users;

        public function __construct () {
            if(!isset($_SESSION)) { 
                session_start(); 
            } 
            $dbh = db_connect_ro ();
                $this->users = $this->getUsers ($dbh);
            db_close($dbh);
        }

        private function getUsers ($dbh) {
            $rows = array ();
            
            $sth = $dbh -> prepare ("SELECT UID, UserName FROM Users
            WHERE Admin = 0");
            
            $sth -> execute ();
            
            while ($row = $sth -> fetch ()) {
                $rows[] = $row;
            }
            
            return $rows;
        }
    }