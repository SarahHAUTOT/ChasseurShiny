-- USE ShinyHunt


DROP TABLE IF EXISTS Hunts;
DROP TABLE IF EXISTS HuntsMethods;

DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Pokemons;
DROP TABLE IF EXISTS Games;



CREATE TABLE Users 
(
	iduser    INTEGER     AUTO_INCREMENT PRIMARY KEY,
	loginuser VARCHAR(50) NOT NULL   UNIQUE,
	mailuser  VARCHAR(50) NOT NULL   UNIQUE,
	pwduser   VARCHAR(50) NOT NULL         ,
	nivAcces  INTEGER     DEFAULT 0
);

INSERT INTO Users (iduser, loginuser, mailuser, pwduser) VALUES (1, 'Ottirate', 'ezezezez', 'shiny');



CREATE TABLE Pokemons
(
	numpokedex  INTEGER      PRIMARY KEY,
	nompokemon  VARCHAR(30)  NOT NULL   ,
	generation  INTEGER      NOT NULL   CHECK generation > 0,
	imgnonshiny VARCHAR(255) NOT NULL   ,
	imgshiny    VARCHAR(255) NOT NULL   
);

CREATE TABLE JeuxPokemon 
(
    nom        VARCHAR(60) PRIMARY KEY,
    generation INT  NOT NULL CHECK generation > 0,
    date       DATE NOT NULL
);



CREATE TABLE HuntsMethods
(
	nom    VARCHAR (30) NOT NULL,                          --Nom de la méthode
	jeux   VARCHAR (60) REFERENCES JeuxPokemon(jeux),      --Nom du jeu
	oddsSC FLOAT        CHECK BETWEEN 0 AND 1,             --Odds avec shiny charm
	odds   FLOAT        CHECK BETWEEN 0 AND 1,             --Odds sans
	PRIMARY KEY (nom, jeux)
);




CREATE TABLE Hunts 
(
	idchasse    INTEGER AUTO_INCREMENT PRIMARY KEY                 ,
	idpokemon   INTEGER NOT NULL    REFERENCES Pokemons(numpokedex),
	nbrencontre INTEGER DEFAULT 0                                  ,
	estfinit    BOOLEAN DEFAULT FALSE                              ,
	imgshiny    BOOLEAN DEFAULT TRUE                              ,
	iduser      INTEGER REFERENCES Users(iduser)
);

