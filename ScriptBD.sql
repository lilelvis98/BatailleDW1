--
--Création de la Table de Bateaux
--
CREATE TABLE `Bateau` (
 `Id_Bateau` int(11) DEFAULT NULL,
 `Id_Partie` int(11) DEFAULT NULL,
 `Id_Joueur` int(11) DEFAULT NULL,
 `Id_Type_Navire` int(11) DEFAULT NULL,
 `Coord_Y` int(11) DEFAULT NULL,
 `Coord_X` int(11) DEFAULT NULL,
 `Bool_Orientation` tinyint(1) DEFAULT NULL,
 `Bool_Etat` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Bateau` ADD PRIMARY KEY(`Id_Bateau`);

--
--Création de la Table de Cartes
--
CREATE TABLE `Carte` (
 `Id_Carte` int(11) DEFAULT NULL,
 `Nom_Carte` varchar(15) DEFAULT NULL,
 `Probabilite` int(11) DEFAULT NULL,
 `Image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
--Création de la Table d' Etat_Partie
--
CREATE TABLE `Etat_Partie` (
 `Id_Etat` int(11) DEFAULT NULL,
 `Libelle_Etat` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Etat_Partie` ADD PRIMARY KEY(`Id_Etat`);

INSERT INTO `Etat_Partie` (`Id_Etat`, `Libelle_Etat`) VALUES ('0', 'Aucun bateaux placés');
INSERT INTO `Etat_Partie` (`Id_Etat`, `Libelle_Etat`) VALUES ('1', 'En attente de confirmation');
INSERT INTO `Etat_Partie` (`Id_Etat`, `Libelle_Etat`) VALUES ('2', 'Partie terminée');
INSERT INTO `Etat_Partie` (`Id_Etat`, `Libelle_Etat`) VALUES ('3', 'Une flotte de bateaux placée');
INSERT INTO `Etat_Partie` (`Id_Etat`, `Libelle_Etat`) VALUES ('4', 'En cours de jeu');

--
--Création de la Table des utilisateurs
--
CREATE TABLE `Joueur` (
 `Id_Joueur` int(11) DEFAULT NULL,
 `Nom_Joueur` varchar(20) DEFAULT NULL,
 `Prenom_Joueur` varchar(20) DEFAULT NULL,
 `Date_Dernière_Co` datetime DEFAULT CURRENT_TIMESTAMP,
 `Sexe` tinyint(1) DEFAULT NULL,
 `Date_Naissance` date DEFAULT NULL,
 `Ville_Residence` varchar(20) DEFAULT NULL,
 `Pseudo` varchar(15) DEFAULT NULL,
 `Mdp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Joueur` ADD PRIMARY KEY(`Id_Joueur`);
ALTER TABLE `Joueur` ADD UNIQUE(`Pseudo`);

--Insertion de tupls (commande générée par phpMyAdmin)
INSERT INTO `Joueur` (`Id_Joueur`, `Nom_Joueur`, `Prenom_Joueur`, `Online`, `Sexe`, `Date_Naissance`, `Ville_Residence`, `Pseudo`, `Mdp`) VALUES
(1, 'Dupont', 'Jean', NULL, 1, '1995-06-24', 'Tachkamp', 'jdupont95', '$2y$10$I3b3EbPIUZ3gVBobSDikmedOlLsoOYq1Yz/Q5LPJAASF6PibnF23e'),
(2, 'Jones', 'Bob', 0, 0, '1986-06-12', 'Katmandou', 'bobjones86', '$2y$10$3Fzse6UfFoKnVQtVmmHhwexa9lwIW7EZtcvRGEy1f5kKA6kxWnQsq'),
(3, 'Lopez', 'Romain', 1, 0, '1997-07-29', 'Villeurbanne', 'Nosedoin', '$2y$10$LvyPolAvqYBknmCvY9uBreZ5HKLBJqVmKcLq0q2U9Ixp2bp.Q9IHi'),
(4, 'Villermet', 'Quentin', 1, 0, '1998-09-07', 'Caluire', 'lilelvis98', '$2y$10$fGx7/Dkg/LBEXCLC8GJ0IurJSwmCvhtQSh7R8SHdu2olfbPQhPZ9a');

--
--Création de la Table des Parties de jeu
--
CREATE TABLE `Partie` (
 `Id_Partie` int(11) DEFAULT NULL,
 `Id_Initiateur` int(11) DEFAULT NULL,
 `Id_Invite` int(11) DEFAULT NULL,
 `Id_Etat` int(11) DEFAULT NULL,
 `Id_Gagnant` int(11) DEFAULT NULL,
 `Date_Creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Partie` ADD PRIMARY KEY(`Id_Partie`);

--
--Création de la Table de Tirs
--
CREATE TABLE `Tir` (
 `Id_Tour` int(11) DEFAULT NULL,
 `Coord_Y` int(11) DEFAULT NULL,
 `Coord_X` int(11) DEFAULT NULL,
 `Bool_Touche` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Tir` ADD PRIMARY KEY(`Id_Tour`);

--
--Création de la Table de Tours
--
CREATE TABLE `Tour` (
 `Id_Partie` int(11) DEFAULT NULL,
 `Numero_Tour` int(11) DEFAULT NULL,
 `Id_Joueur` int(11) DEFAULT NULL,
 `Id_Carte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Tour` ADD PRIMARY KEY(`Id_Tour`);

--
--Création de la Table de Type de Navire
--
CREATE TABLE `Type_Navire` (
 `Id_Type_Navire` int(11) DEFAULT NULL,
 `Libelle_Navire` varchar(15) DEFAULT NULL,
 `Lien` varchar(50) DEFAULT NULL,
 `Nb_Cases` int(11) DEFAULT NULL,
 `Image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Type_Navire` ADD PRIMARY KEY(`Id_Type_Navire`);

--Insertion de tuples (commande générée par phpMyAdmin)
INSERT INTO `Type_Navire` (`Id_Type_Navire`, `Libelle_Navire`, `Lien`, `Nb_Cases`) VALUES
(0, 'porte-avion', 'https://fr.wikipedia.org/wiki/Porte-avions', 5),
(1, 'croiseur', 'https://fr.wikipedia.org/wiki/Croiseur', 4),
(2, 'destroyer', 'https://fr.wikipedia.org/wiki/Destroyer', 3),
(3, 'sous-marin', 'https://fr.wikipedia.org/wiki/Sous-marin', 3),
(4, 'torpilleur', 'https://fr.wikipedia.org/wiki/Torpilleur', 2);

--
--Création de la Table des Orientations de Bateaux
--
CREATE TABLE `Type_Orientation` (
 `Id_Orientation` tinyint(1) DEFAULT NULL,
 `Libelle_Orientation` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Type_Orientation` ADD PRIMARY KEY(`Id_Orientation`);

INSERT INTO `Type_Orientation` (`Id_Orientation`, `Libelle_Orientation`) VALUES
(0, 'Horizontal'),
(1, 'Vertical');

--Fin du script
