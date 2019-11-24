<?php 
		function getTopPokemon ($dbh, $top) {
		$rows = array();

		$sth = $dbh -> prepare("SELECT FavCount, Pokemon.PKID, DexNumber, Name, Type, Image
														FROM Pokemon
														JOIN PokemonSprites ON Pokemon.SID=PokemonSprites.SID
														JOIN 
														(
															SELECT PKID, COUNT(*) as FavCount
															FROM HasFavorite
															GROUP BY PKID
															ORDER BY FavCount DESC
															LIMIT " . $top . "
														) AS Favs ON Favs.PKID = Pokemon.PKID;");
		$sth -> execute();
		
		while ($row = $sth -> fetch())
		{
			$rows[] = $row;
		}

		return $rows;
	}
 ?>