CREATE DATABASE Social_Network;

USE Social_Network;

CREATE TABLE  USERS (
  id int PRIMARY KEY AUTO_INCREMENT,
  pseudo varchar(255) UNIQUE,
  mail varchar(255) UNIQUE,
  password VARCHAR (255) ,
  Nom varchar(100),
  Prenom varchar(100),
  Civilite varchar(100),
  DN date,
  Ville varchar(100),
  Pays varchar(100),
  Code_Compte int NOT NULL);