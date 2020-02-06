<?php
    require_once __DIR__ . "/../Helpers/connDB.php";

    class SearchModel {
        const EMPTY = "NA";
        public $pokemonArray = array();
        public $spritesArray = array();

        public function __construct($pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID) {
            $dbh = db_connect_ro();

            $this->pokemonArray = $this->search($dbh, $pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID);
            $this->spritesArray = $this->getSprites($dbh);

            db_close($dbh);
        }

        private function search ($dbh, $pokemonID, $analogID, $namePart, $colorID, $typeID, $eggGroupID) {
            $sqlStatement = "SELECT Pokemon.PKID, Pokemon.Name ";
            $sqlFrom = "FROM Pokemon";
            $bIsSecond = false;
            $bUsingName = false;
            $bUsingID = false;
            $bUsingAnalog = false;
            $bUsingColor = false;
            $bUsingEggGroup = false;
            $bUsingType = false;
        
            $sqlWhere = "";
            
            //PKID
            if ($this::EMPTY != $pokemonID) {
                $sqlWhere .= "Pokemon.PKID = :pokemonID";
                
                $bIsSecond = true;
                $bUsingID = true;
            }
            
            //Analog
            if ($this::EMPTY != $analogID) {
                $sqlFrom .= ", HasAnalogs, Analogs";
                
                if ($bIsSecond) {
                    $sqlWhere .= " AND ";
                }
                else {
                    $bIsSecond = true;
                }
                
                $sqlWhere .= "Analogs.AnalogID = :analogID
                        AND Analogs.AnalogID = HasAnalogs.AnalogID
                        AND HasAnalogs.PokemonID = Pokemon.PKID";
                $bUsingAnalog = true;
            }
            
            //Name
            if ($this::EMPTY != $namePart) {
                if ($bIsSecond) {
                    $sqlWhere .= " AND ";
                }
                else {
                    $bIsSecond = True;
                }
                
                $sqlWhere .= "LOWER(Pokemon.Name) LIKE LOWER(:namePart)";
                $bUsingName = True;
                $namePart = '%' . $namePart . '%';
            }
            
            //ColorID
            if ($this::EMPTY != $colorID) {
                $sqlFrom .= ", HasColors, Colors";
                
                if ($bIsSecond) {
                    $sqlWhere .= " AND ";
                }
                else {
                    $bIsSecond = True;
                }
                
                $sqlWhere .= "Colors.ColorID = :colorID
                        AND Colors.ColorID = HasColors.ColorID
                        AND HasColors.PokemonID = Pokemon.PKID";

                $bUsingColor = true;
            }
            
            //TypeID
            if ($this::EMPTY != $typeID) {
                $sqlFrom .= ", HasTypes, Types";
                
                if ($bIsSecond) {
                    $sqlWhere .= " AND ";
                }
                else {
                    $bIsSecond = True;
                }
                
                $sqlWhere .= "Types.TypeID = :typeID
                        AND Types.TypeID = HasTypes.TypeID
                        AND HasTypes.PokemonID = Pokemon.PKID";

                $bUsingType = true;
            }
            
            //EggGroupID
            if ($this::EMPTY != $eggGroupID) {
                $sqlFrom .= ", InEggGroup, EggGroups";
                
                if ($bIsSecond) {
                    $sqlWhere .= " AND ";
                }
                else {
                    $bIsSecond = True;
                }
                
                $sqlWhere .= "EggGroups.EggGroupID = :eggGroupID
                        AND EggGroups.EggGroupID = InEggGroup.EggGroupID
                        AND InEggGroup.PokemonID = Pokemon.PKID";
                
                        $bUsingEggGroup = true;
            }
            
            $sqlStatement .= $sqlFrom;
            
            if ($bIsSecond) {
                $sqlWhere = " WHERE " . $sqlWhere;
            }
            $sqlStatement .= $sqlWhere;
            
            $rows = array();
            $sth = $dbh->prepare($sqlStatement);
            
            if ($bUsingName) {
                $sth->bindValue(":namePart", $namePart);
            }
            if ($bUsingID) {
                $sth->bindValue(":pokemonID", $pokemonID);
            }
            
            if ($bUsingAnalog) {
                $sth->bindValue(":analogID", $analogID);
            }
            
            if ($bUsingColor) {
                $sth->bindValue(":colorID", $colorID);
            }

            if ($bUsingType) {
                $sth->bindValue(":typeID", $typeID);
            }
            
            if ($bUsingEggGroup) {
                $sth->bindValue(":eggGroupID", $eggGroupID);
            }
            
            $sth->execute();
            
            while ($row = $sth -> fetch ()) {
                $rows[] = $row;
            }
           
            return $rows;

        }
        
        private function getSprites($dbh) {
            $rows = array();
            foreach ($this->pokemonArray as $pokemon) {
                $sth = $dbh->prepare("SELECT Image, Type
                                    FROM PokemonSprites
                                    WHERE SID = :pokemonID");
                $sth->bindValue(":pokemonID", $pokemon["PKID"]);
                $sth->execute();
                $rows[] = $sth -> fetch ();
            }

            return $rows;
        }
    }
?>