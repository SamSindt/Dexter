<?php
	require_once('basicErrorHandling.php');
	
	function getPokemon ($dbh, $pkid) {

		$sth = $dbh -> prepare("SELECT *
                                FROM Pokemon 
                                WHERE PKID =" . $pkid );
		// run the query
		$sth -> execute();

		return $sth -> fetch();
	}
	
	function searchPokemon ($dbh, $searchParams) {
		$sqlStatement = "SELECT Pokemon.PKID, Pokemon.Name ";
		$sqlFrom = "FROM Pokemon";
		
		if (!empty ($searchParams)) {
			$sqlWhere = "";
			$bIsSecond = False;
			
			//PKID
			if (isset ($searchParams['PKID']) && !empty($searchParams['PKID'])) {
				$sqlWhere .= "Pokemon.PKID = " . $searchParams['PKID']; 
				$bIsSecond = True;
			}
			
			//Analog
			if (isset ($searchParams['AnalogID']) && $searchParams['AnalogID'] != 0) {
				$sqlFrom .= ", HasAnalogs, Analogs";
				
				if ($bIsSecond) {
					$sqlWhere .= " AND ";
				}
				else {
					$bIsSecond = True;
				}
				
				$sqlWhere .= "Analogs.AnalogID = " . $searchParams['AnalogID']
					. " AND Analogs.AnalogID = HasAnalogs.AnalogID
					 AND HasAnalogs.PokemonID = Pokemon.PKID";
			}
			
			//Name
			if (isset ($searchParams['NameLike']) && !empty($searchParams['NameLike'])) {
				if ($bIsSecond) {
					$sqlWhere .= " AND ";
				}
				else {
					$bIsSecond = True;
				}
				
				$sqlWhere .= "LOWER(Pokemon.Name) LIKE LOWER(\"%"
					. $searchParams['NameLike']
					. "%\")";
			}
			
			//ColorID
			if (isset ($searchParams['ColorID']) && $searchParams['ColorID'] != 0) {
				$sqlFrom .= ", HasColors, Colors";
				
				if ($bIsSecond) {
					$sqlWhere .= " AND ";
				}
				else {
					$bIsSecond = True;
				}
				
				$sqlWhere .= "Colors.ColorID = " . $searchParams['ColorID']
					. " AND Colors.ColorID = HasColors.ColorID
					 AND HasColors.PokemonID = Pokemon.PKID";
			}
			
			//TypeID
			if (isset ($searchParams['TypeID']) && $searchParams['TypeID'] != 0) {
				$sqlFrom .= ", HasTypes, Types";
				
				if ($bIsSecond) {
					$sqlWhere .= " AND ";
				}
				else {
					$bIsSecond = True;
				}
				
				$sqlWhere .= "Types.TypeID = " . $searchParams['TypeID']
					. " AND Types.TypeID = HasTypes.TypeID
					 AND HasTypes.PokemonID = Pokemon.PKID";
			}
			
			//EggGroupID
			if (isset ($searchParams['EggGroupID']) &&  $searchParams['EggGroupID'] != 0) {
				$sqlFrom .= ", InEggGroup, EggGroups";
				
				if ($bIsSecond) {
					$sqlWhere .= " AND ";
				}
				else {
					$bIsSecond = True;
				}
				
				$sqlWhere .= "EggGroups.EggGroupID = " . $searchParams['EggGroupID']
					. " AND EggGroups.EggGroupID = InEggGroup.EggGroupID
					 AND InEggGroup.PokemonID = Pokemon.PKID";
			}
		}
		
		$sqlStatement .= $sqlFrom;
		
		if ($bIsSecond) {
			$sqlWhere = " WHERE " . $sqlWhere;
		}
		
		if (!empty ($searchParams)) {
			$sqlStatement .= $sqlWhere;
		}
		
		$rows = array();

		$sth = $dbh -> prepare($sqlStatement);
		$sth -> execute();
		
		while ($row = $sth -> fetch ()) {
			$rows[] = $row;
		}
		return $rows;
	}
?>