<?php
    require_once __DIR__ . "/Helpers/connDB.php";

    class ProfileModel {
        public $pokemonID;
        public $pokemonName;
        public $dexNumber;
        public $evolvesFrom = array();
        public $evolvesTo = array();
        public $HP;
        public $attack;
        public $defense;
        public $spAttack;
        public $spDefense;
        public $speed;
        public $eggGroups = array();
        public $typeImages = array();
        public $profileImage = array();

        public function __construct($pokemonID) {
            $dbh = db_connect_ro();

            $pokemonData = $this->getPokemonData ($dbh, $pokemonID);

            $this->pokemonID = $pokemonID;
            $this->pokemonName = $pokemonData["Name"];
            $this->dexNumber = $pokemonData["DexNumber"];
            $this->evolvesFrom = $this->getEvolvesFrom($dbh, $pokemonID);
            $this->evolvesTo = $this->getEvolvesTo($dbh, $pokemonID);
            $this->HP = $pokemonData["HP"];
            $this->attack = $pokemonData["Attack"];
            $this->defense = $pokemonData["Defense"];
            $this->spAttack = $pokemonData["SpAttack"];
            $this->spDefense = $pokemonData["SpDefense"];
            $this->speed = $pokemonData["Speed"];
            $this->typeImages = $this->getTypeImage($dbh, $pokemonID);
            $this->profileImage = $this->getProfileImage($dbh, $pokemonID);

            db_close($dbh);
        }

        private function getPokemonData ($dbh, $pokemonID) {

            $sth = $dbh -> prepare("SELECT *
                                    FROM Pokemon 
                                    WHERE PKID =" . $pokemonID );
            $sth -> execute();
    
            return $sth -> fetch();
        }

        private function getEvolvesTo($dbh, $evolvesFrom) {
            
            $sth = $dbh -> prepare("SELECT EvolvesTo, Name
                                    FROM Evolutions, Pokemon
                                    WHERE EvolvesFrom =" . $evolvesFrom . " AND EvolvesTo = PKID");
            $sth -> execute();
    
            return $sth -> fetch();
        }
        
        private function getEvolvesFrom($dbh, $evolvesTo) {
            $sth = $dbh -> prepare("SELECT EvolvesFrom, Name
                                    FROM Evolutions, Pokemon
                                    WHERE EvolvesTo =" . $evolvesTo . " AND EvolvesFrom = PKID");
            
            $sth -> execute ();
            
            return $sth -> fetch ();
        }	

        private function getTypeImage($dbh, $pokemonID) {
            $rows = array();
    
            $sth = $dbh -> prepare("SELECT Image, Type
                                    FROM HasTypes, Types, TypeImages
                                    WHERE PokemonID = " . $pokemonID . " AND HasTypes.TypeID = Types.TypeID
                                    AND Types.TypeID = TypeImages.TypeImageID" );
            $sth -> execute();
            
            while ($row = $sth -> fetch ()) {
                $rows[] = $row;
            }
            return $rows;
        
        }

        private function getProfileImage($dbh, $pokemonID) {

            $sth = $dbh->prepare("SELECT Image, Type
							  FROM PokemonImages
							  WHERE IID=:picid");
		    $sth->bindValue(":picid", $pokemonID);
		
		    $sth->execute();
	  
            return $sth->fetch();
            
        }

    }
?>