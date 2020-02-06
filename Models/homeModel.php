<?php
    require_once __DIR__ . "/../Helpers/connDB.php";

    class HomeModel {
        public $lowestPKID;
        public $highestPKID;
        public $types = array();
        public $analogs = array();
        public $colors = array();
        public $eggGroups = array();

        public function __construct() {
            $dbh = db_connect_ro();

            $this->lowestPKID = $this->getLowestPKID($dbh);
            $this->highestPKID = $this->getHighestPKID($dbh);
            $this->types = $this->getTypes($dbh);
            $this->analogs = $this->getAnalogs($dbh);
            $this->colors = $this->getColors($dbh);
            $this->eggGroups = $this->getEggGroups($dbh);

            db_close($dbh);
        }

        private function getLowestPKID ($dbh) {

            $sth = $dbh -> prepare("SELECT Pokemon.PKID 
                                    FROM Pokemon
                                    ORDER BY Pokemon.PKID ASC
                                    LIMIT 1");
            $sth -> execute();
    
            return ($sth -> fetch())['PKID'];
        }
        
        private function getHighestPKID ($dbh) {

            $sth = $dbh -> prepare("SELECT Pokemon.PKID 
                                    FROM Pokemon
                                    ORDER BY Pokemon.PKID DESC
                                    LIMIT 1");
            $sth -> execute();
    
            return ($sth -> fetch())['PKID'];
        }

        private function getTypes ($dbh) {
            $rows = array();
    
            $sth = $dbh -> prepare("SELECT TypeID, TypeName 
                                    FROM Types");
            $sth -> execute();
            
            while ($row = $sth -> fetch()) {
                $rows[] = $row;
            }
    
            return $rows;
        }

        private function getAnalogs ($dbh) {
            $rows = array();
    
            $sth = $dbh -> prepare("SELECT AnalogID, AnalogName 
                                    FROM Analogs");
            $sth -> execute();
            
            while ($row = $sth -> fetch()) {
                $rows[] = $row;
            }
    
            return $rows;
        }

        private function getColors ($dbh) {
            $rows = array();
    
            $sth = $dbh -> prepare("SELECT ColorID, ColorName 
                                    FROM Colors");
            $sth -> execute();
            
            while ($row = $sth -> fetch()) {
                $rows[] = $row;
            }
    
            return $rows;
        }

        private function getEggGroups ($dbh) {
            $rows = array();
    
            $sth = $dbh -> prepare("SELECT EggGroupID, GroupName 
                                    FROM EggGroups");
            $sth -> execute();
            
            while ($row = $sth -> fetch()) {
                $rows[] = $row;
            }
    
            return $rows;
        }
    }