<?php
	//Variable globale de connexion à la BD
	$connexion = null;
	//Pseudo du Joueur connecté
	$pseudo_joueur = null;
	$est_connecte = false;

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

	//Fonction de connexion au site
	function connexion_site($pseudo_donne, $mdp_donne){
		global $connexion;
		global $est_connecte;

		$sql = "SELECT Mdp FROM Joueur WHERE Pseudo = '$pseudo_donne'";
		$resultat = $connexion->query($sql);

		//On vérifie que son Pseudo existe bien
		if ($resultat->num_rows > 0){
			$mdp_bd = mysqli_fetch_assoc($resultat);
			//On vérifie que le MDP est bon
			if (password_verify($mdp_donne, $mdp_bd["Mdp"])){
				$est_connecte = true;
				global $pseudo_joueur;
				$pseudo_joueur = $pseudo_donne;
			}
			else{
				$est_connecte = false;
			}
		} 
		else{
			$est_connecte = false;
		}
	}
?>

