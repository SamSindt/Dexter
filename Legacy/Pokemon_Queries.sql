#List all Pokemon
SELECT PKID, DexNumber, Name, Type, Image
FROM Pokemon, PokemonSprites
WHERE Pokemon.SID=PokemonSprites.SID;

#List all users
SELECT UID, UserName, Type, Image
FROM Users, UserImages
WHERE Users.UIID=UserImages.UIID;

#List all types and matchups
SELECT attk.TypeName as "AttackingType", def.TypeName as "DefendingType", Multiplier
FROM Types as attk
JOIN TypeMatchups ON AttackingTypeID = attk.TypeID
JOIN Types as def ON DefendingTypeID = def.TypeID
JOIN DmgMods ON TypeMatchups.DmgID=DmgMods.DmgID;

#List available analogs
SELECT AnalogID, AnalogName
FROM Analogs;

#List most favorited Pokemon
SELECT FavCount, Pokemon.PKID, DexNumber, Name, Type, Image
FROM Pokemon
JOIN PokemonSprites ON Pokemon.SID=PokemonSprites.SID
JOIN 
(
	SELECT PKID, COUNT(*) as FavCount
	FROM HasFavorite
	GROUP BY PKID
	ORDER BY FavCount DESC
	LIMIT 10
) AS Favs ON Favs.PKID = Pokemon.PKID;

