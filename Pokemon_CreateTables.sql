DROP TABLE IF EXISTS 
	InEggGroup,
	EggGroups,
	HasTypes,
	TypeMatchups,
	DmgMods,
	Types,
	TypeImages,
	HasColors,
	Colors,
	HasAnalogs,
	Analogs,
	Evolutions,
	HasFavorite,
	HasTeamMember,
	Users,
	UserImages,
	Pokemon,
	PokemonSprites,
	PokemonImages;


#### Pokemon ####
CREATE TABLE PokemonImages (
	IID INT NOT NULL AUTO_INCREMENT,
	Type VARCHAR(50),
	Image MEDIUMBLOB NOT NULL,
	CONSTRAINT PokemonImages_IID_PK PRIMARY KEY (IID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE PokemonImages;

CREATE TABLE PokemonSprites (
	SID INT NOT NULL AUTO_INCREMENT,
	Type VARCHAR(50),
	Image MEDIUMBLOB NOT NULL,
	CONSTRAINT PokemonSprites_SID_PK PRIMARY KEY (SID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE PokemonSprites;

CREATE TABLE Pokemon (
	PKID INT NOT NULL AUTO_INCREMENT,
	DexNumber INT NOT NULL,
	Name VARCHAR(50),
	HP INT NOT NULL,
	Attack INT NOT NULL,
	Defense INT NOT NULL,
	SpAttack INT NOT NULL,
	SpDefense INT NOT NULL,
	Speed INT NOT NULL,
	IID INT NOT NULL,
	SID INT NOT NULL,
	CONSTRAINT Pokemon_PKID_PK PRIMARY KEY (PKID),
	CONSTRAINT Pokemon_IID_FK FOREIGN KEY (IID)
	REFERENCES PokemonImages (IID), 
	CONSTRAINT Pokeomon_SID_FK FOREIGN KEY (SID)
	REFERENCES PokemonSprites (SID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE Pokemon;


#### Users ####
CREATE TABLE UserImages (
	UIID INT NOT NULL AUTO_INCREMENT,
	Type VARCHAR (255) NOT NULL,
	Image MEDIUMBLOB NOT NULL,
	CONSTRAINT UserImages_UIID_PK PRIMARY KEY (UIID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE UserImages;

CREATE TABLE Users (
	UID INT NOT NULL AUTO_INCREMENT,
	UserName VARBINARY(50),
	Password VARBINARY(150),
	Salt VARBINARY(50),
	Admin BIT DEFAULT 0,
	UIID INT NOT NULL DEFAULT 1,
	CONSTRAINT Users_UID_PK PRIMARY KEY (UID),
	CONSTRAINT Users_UIID_FK FOREIGN KEY (UIID)
	REFERENCES UserImages (UIID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE Users;

CREATE TABLE HasTeamMember (
	UID INT NOT NULL,
	PKID INT NOT NULL,
	TeamOrder INT NOT NULL,
	CONSTRAINT HasTeamMember_PK PRIMARY KEY (UID, PKID),
	CONSTRAINT HasTeamMember_UID_FK FOREIGN KEY (UID)
	REFERENCES Users (UID) ON DELETE CASCADE,
	CONSTRAINT HasTeamMember_PKID_FK FOREIGN KEY (PKID)
	REFERENCES Pokemon (PKID) ON DELETE CASCADE
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE HasTeamMember;

CREATE TABLE HasFavorite (
	UID INT NOT NULL,
	PKID INT NOT NULL,
	CONSTRAINT HasFavorite_PK PRIMARY KEY (UID, PKID),
	CONSTRAINT HasFavorite_UID_FK FOREIGN KEY (UID)
	REFERENCES Users (UID) ON DELETE CASCADE,
	CONSTRAINT HasFavorite_PKID_FK FOREIGN KEY (PKID)
	REFERENCES Pokemon (PKID) ON DELETE CASCADE
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE HasFavorite;


#### Evolution ####
CREATE TABLE Evolutions (
	EvolvesTo INT NOT NULL,
	EvolvesFrom INT NOT NULL,
	CONSTRAINT Evolutions_PK PRIMARY KEY (EvolvesTo, EvolvesFrom),
	CONSTRAINT Evolutions_EvolvesTo_FK FOREIGN KEY (EvolvesTo)
	REFERENCES Pokemon (PKID),
	CONSTRAINT Evolutions_EvolvesFrom_FK FOREIGN KEY (EvolvesFrom)
	REFERENCES Pokemon (PKID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE Evolutions;


#### Analogue ####
CREATE TABLE Analogs
( 
	AnalogID INT NOT NULL AUTO_INCREMENT,
	AnalogName VARCHARACTER(25) DEFAULT NULL,
	
	CONSTRAINT Analogs_PK PRIMARY KEY (AnalogID)
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE Analogs;

CREATE TABLE HasAnalogs
( 
	PokemonID INT NOT NULL,
	AnalogID INT NOT NULL,
	
	CONSTRAINT HasAnalogs_PK PRIMARY KEY (PokemonID, AnalogID),
	INDEX HasAnalogs_AnalogID_IDX (AnalogID),
	INDEX HasAnalogs_PokemonID_IDX (PokemonID),
	CONSTRAINT HasAnalogs_PokemonID_FK FOREIGN KEY (PokemonID)
		REFERENCES Pokemon (PKID) ON DELETE CASCADE,
	CONSTRAINT HasAnalogs_AnalogID_FK FOREIGN KEY (AnalogID)
		REFERENCES Analogs (AnalogID) ON DELETE CASCADE
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE HasAnalogs;


#### Color ####
CREATE TABLE Colors
( 
	ColorID INT NOT NULL AUTO_INCREMENT,
	ColorName VARCHARACTER(25) DEFAULT NULL,
	CONSTRAINT Colors_PK PRIMARY KEY (ColorID)
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE Colors;

CREATE TABLE HasColors
( 
	PokemonID INT NOT NULL,
	ColorID INT NOT NULL,
	
	CONSTRAINT HasColors_PK PRIMARY KEY (PokemonID, ColorID),
	INDEX HasColors_PokemonID_IDX (PokemonID), 
	INDEX HasColors_ColorID_IDX (ColorID),
	CONSTRAINT HasColors_PokemonID_FK FOREIGN KEY (PokemonID)
		REFERENCES Pokemon (PKID) ON DELETE CASCADE,
	CONSTRAINT HasColors_ColorID_FK FOREIGN KEY (ColorID)
		REFERENCES Colors (ColorID) ON DELETE CASCADE
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE HasColors;


#### Type ####
CREATE TABLE TypeImages
(
	TypeImageID INT NOT NULL AUTO_INCREMENT,
	Type VARCHAR(50),
	Image MEDIUMBLOB NOT NULL,
	CONSTRAINT TypeImages_TypeImageID_PK PRIMARY KEY (TypeImageID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE TypeImages;

CREATE TABLE Types
( 
	TypeID INT NOT NULL AUTO_INCREMENT,
	TypeName VARCHARACTER(25) DEFAULT NULL,
	TypeImageID INT NOT NULL,
	CONSTRAINT Types_PK PRIMARY KEY (TypeID),
	CONSTRAINT Types_TypeImageID_FK FOREIGN KEY (TypeImageID)
		REFERENCES TypeImages (TypeImageID)
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE Types;

CREATE TABLE DmgMods
(
	DmgID INT NOT NULL AUTO_INCREMENT,
	Multiplier FLOAT4 NOT NULL,
	CONSTRAINT DmgMods_DmgID_PK PRIMARY KEY (DmgID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE DmgMods;

CREATE TABLE TypeMatchups
( 
	AttackingTypeID INT NOT NULL,
	DefendingTypeID INT NOT NULL,
	DmgID INT NOT NULL,
	CONSTRAINT TypeMatchups_PK PRIMARY KEY (AttackingTypeID, DefendingTypeID),
	CONSTRAINT TypeMatchups_AttackingTypeID_FK FOREIGN KEY (AttackingTypeID)
		REFERENCES Types (TypeID),
	CONSTRAINT TypeMatchups_DefendingTypeID_FK FOREIGN KEY (DefendingTypeID)
		REFERENCES Types (TypeID),
	CONSTRAINT TypeMatchups_DmgID_FK FOREIGN KEY (DmgID)
		REFERENCES DmgMods (DmgID)
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE TypeMatchups;

CREATE TABLE HasTypes
( 
	PokemonID INT NOT NULL,
	TypeID INT NOT NULL,	
	CONSTRAINT HasTypes_PK PRIMARY KEY (PokemonID, TypeID),
	INDEX HasTypes_PokemonID_IDX (PokemonID), 
	INDEX HasTypes_TypeID_IDX (TypeID),
	CONSTRAINT HasTypes_PokemonID_FK FOREIGN KEY (PokemonID)
		REFERENCES Pokemon (PKID) ON DELETE CASCADE,
	CONSTRAINT HasTypes_TypeID_FK FOREIGN KEY (TypeID)
		REFERENCES Types (TypeID) ON DELETE CASCADE
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE HasTypes;


#### Egg Group ####
CREATE TABLE EggGroups
(
	EggGroupID INT NOT NULL AUTO_INCREMENT,
	GroupName VARCHAR(50),
	CONSTRAINT EggGroups_EggGroupID_PK PRIMARY KEY (EggGroupID)
) Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE EggGroups;

CREATE TABLE InEggGroup
( 
	PokemonID INT NOT NULL,
	EggGroupID INT NOT NULL,	
	CONSTRAINT InEggGroup_PK PRIMARY KEY (PokemonID, EggGroupID),
	INDEX InEggGroup_PokemonID_IDX (PokemonID), 
	INDEX InEggGroup_EggGroupID_IDX (EggGroupID),
	CONSTRAINT InEggGroup_PokemonID_FK FOREIGN KEY (PokemonID)
		REFERENCES Pokemon (PKID) ON DELETE CASCADE,
	CONSTRAINT InEggGroup_EggGroupID_FK FOREIGN KEY (EggGroupID)
		REFERENCES EggGroups (EggGroupID) ON DELETE CASCADE
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;
TRUNCATE TABLE InEggGroup;
