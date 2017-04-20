<?php
	//Variable globale de connexion à la BD
	$connexion = null;
	//Pseudo du Joueur connecté
	$pseudo_joueur = null;


	//Fonction de connexion à la BD
	function connexion_bd(){
		global $connexion;

		//Paramètres de la connexion
		$bd = "L2IF83_BD" ;
		$user = "L2IF83"  ;
		$passwd = "DHR2GVA"  ;
		$machine = "localhost" ;

		$connexion = mysqli_connect ( $machine , $user , $passwd , $bd ) ;

		//En cas d'erreur
		if(mysqli_connect_errno ()){
			printf( " Echec de la connexion : \%s " ,  mysqli_connect_error ( ) ) ;
		}
	}

	//Fonction de déconnexion à la BD
	function deconnexion_bd(){
		global $connexion;
		mysqli_close($connexion);
	}

?>

