-- USE ShinyHunt


DROP TABLE IF EXISTS Hunts;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Pokemons;



CREATE TABLE Users 
(
	iduser    INTEGER     AUTO_INCREMENT PRIMARY KEY,
	loginuser VARCHAR(50) NOT NULL   UNIQUE,
	mailuser  VARCHAR(50) NOT NULL   UNIQUE,
	pwduser   VARCHAR(50) NOT NULL
);

INSERT INTO Users (iduser, loginuser, mailuser, pwduser) VALUES (1, 'Ottirate', 'ezezezez', 'shiny');



CREATE TABLE Pokemons
(
	numpokedex  INTEGER      PRIMARY KEY,
	nompokemon  VARCHAR(30)  NOT NULL   ,
	generation  INTEGER      NOT NULL   ,
	imgnonshiny VARCHAR(255) NOT NULL   ,
	imgshiny    VARCHAR(255) NOT NULL   
);


CREATE TABLE Hunts 
(
	idchasse    INTEGER AUTO_INCREMENT PRIMARY KEY                 ,
	idpokemon   INTEGER NOT NULL    REFERENCES Pokemons(numpokedex),
	nbrencontre INTEGER DEFAULT 0                                  ,
	estfinit    BOOLEAN DEFAULT FALSE                              ,
	iduser      INTEGER REFERENCES Users(iduser)
);