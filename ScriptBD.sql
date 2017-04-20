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

CREATE TABLE `Carte` (
 `Id_Carte` int(11) DEFAULT NULL,
 `Nom_Carte` varchar(15) DEFAULT NULL,
 `Probabilite` int(11) DEFAULT NULL,
 `Image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Etat_Partie` (
 `Id_Etat` int(11) DEFAULT NULL,
 `Libelle_Etat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Joueur` (
 `Id_Joueur` int(11) DEFAULT NULL,
 `Nom_Joueur` varchar(20) DEFAULT NULL,
 `Prenom_Joueur` varchar(20) DEFAULT NULL,
 `Date_Dernière_Co` datetime DEFAULT CURRENT_TIMESTAMP,
 `Sexe` tinyint(1) DEFAULT NULL,
 `Date_Naissance` date DEFAULT NULL,
 `Ville_Residence` varchar(20) DEFAULT NULL,
 `Pseudo` varchar(15) DEFAULT NULL,
 `Mdp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Partie` (
 `Id_Partie` int(11) DEFAULT NULL,
 `Id_Initiateur` int(11) DEFAULT NULL,
 `Id_Invite` int(11) DEFAULT NULL,
 `Id_Etat` int(11) DEFAULT NULL,
 `Id_Gagnant` int(11) DEFAULT NULL,
 `Date_Creation` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Tir` (
 `Id_Tour` int(11) DEFAULT NULL,
 `Coord_Y` int(11) DEFAULT NULL,
 `Coord_X` int(11) DEFAULT NULL,
 `Bool_Touche` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Tour` (
 `Id_Partie` int(11) DEFAULT NULL,
 `Numero_Tour` int(11) DEFAULT NULL,
 `Id_Joueur` int(11) DEFAULT NULL,
 `Id_Carte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Type_Navire` (
 `Id_Type_Navire` int(11) DEFAULT NULL,
 `Libelle_Navire` varchar(15) DEFAULT NULL,
 `Lien` varchar(50) DEFAULT NULL,
 `Nb_Cases` int(11) DEFAULT NULL,
 `Image` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `Type_Orientation` (
 `Id_Orientation` tinyint(1) DEFAULT NULL,
 `Libelle_Orientation` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




