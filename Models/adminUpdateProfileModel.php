<?php
    require_once __DIR__ . "/../Helpers/connDB.php";

    class AdminUpdateProfileModel {
        public $unusedColors = array();
        public $unusedAnalogs = array();

        public function __construct($pokemonID)
        {
            $dbh = db_connect_ro();

            $this->unusedColors = $this->getUnusedColors($dbh, $pokemonID);
            $this->unusedAnalogs = $this->getUnusedAnalogs($dbh, $pokemonID);
        }


        private function getUnusedColors ($dbh, $pokemonID) {
            $rows = array();

            $sth = $dbh -> prepare("SELECT ColorID, ColorName 
                                    FROM Colors
                                    WHERE NOT EXISTS (
                                        SELECT *
                                        FROM HasColors
                                        WHERE PokemonID = :pokemonID AND HasColors.ColorID = Colors.ColorID)");

            $sth->bindValue(":pokemonID", $pokemonID);
            $sth -> execute();
            
            while ($row = $sth -> fetch())
            {
                $rows[] = $row;
            }

            return $rows;
        }

        private function getUnusedAnalogs ($dbh, $pokemonID){
            $rows = array();

            $sth = $dbh -> prepare("SELECT AnalogID, AnalogName 
                                    FROM Analogs
                                    WHERE NOT EXISTS (
                                        SELECT *
                                        FROM HasAnalogs
                                        WHERE PokemonID = :pokemonID AND HasAnalogs.AnalogID = Analogs.AnalogID)");
            $sth->bindValue(":pokemonID", $pokemonID);
            $sth -> execute();
            
            while ($row = $sth -> fetch())
            {
                $rows[] = $row;
            }

            return $rows;
        }
    }
?>