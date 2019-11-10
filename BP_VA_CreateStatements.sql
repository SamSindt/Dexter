-- --------------------------------------------------------------------------
-- File Name: BP_VA_CreateStatements.sql
-- Author: Victor Anderson
-- Date: 11/10/19
-- Class: CS445
-- Assignment: Big Project - Group 1
-- Purpose: A set of create table statements for Pokedex database
-- --------------------------------------------------------------------------

CREATE TABLE Analogs
( 
	AnalogID INT NOT NULL AUTO_INCREMENT,
	AnalogName VARCHARACTER(25) DEFAULT NULL,
	
	CONSTRAINT Analogs_PK PRIMARY KEY (AnalogID)
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;


CREATE TABLE HasAnalogs
( 
	PokemonID INT NOT NULL,
	AnalogID INT NOT NULL,
	
	CONSTRAINT HasAnalogs_PK PRIMARY KEY (PokemonID, AnalogID),
	INDEX HasAnalogs_AnalogID_IDX (AnalogID),
	INDEX HasAnalogs_PokemonID_IDX (PokemonID),
	CONSTRAINT HasAnalogs_PokemonID_FK FOREIGN KEY (PokemonID)
		REFERENCES Pokemon (PokemonID) ON DELETE CASCADE,
	CONSTRAINT HasAnalogs_AnalogID_FK FOREIGN KEY (AnalogID)
		REFERENCES Analogs (AnalogID) ON DELETE CASCADE
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;

CREATE TABLE Colors
( 
	ColorID INT NOT NULL AUTO_INCREMENT,
	ColorName VARCHARACTER(25) DEFAULT NULL,
	
	CONSTRAINT Colors_PK PRIMARY KEY (ColorID)
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;

CREATE TABLE HasColors
( 
	PokemonID INT NOT NULL,
	ColorID INT NOT NULL,
	
	CONSTRAINT HasColors_PK PRIMARY KEY (PokemonID, ColorID),
	INDEX HasColors_PokemonID_IDX (PokemonID), 
	INDEX HasColors_ColorID_IDX (ColorID),
	CONSTRAINT HasColors_PokemonID_FK FOREIGN KEY (PokemonID)
		REFERENCES Pokemon (PokemonID) ON DELETE CASCADE,
	CONSTRAINT HasColors_ColorID_FK FOREIGN KEY (ColorID)
		REFERENCES Colors (ColorID) ON DELETE CASCADE
) Engine=InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;