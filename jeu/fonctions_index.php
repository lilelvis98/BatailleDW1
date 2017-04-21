<?php
	//Pseudo du Joueur connecté
	$pseudo_joueur = null;

	$est_connecte = false;
	$erreur_connection = false;

	//Fonction de connexion au site
	function connexion_site($pseudo_donne, $mdp_donne){
		global $connexion;
		global $est_connecte;
		global $erreur_connexion;

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
				$erreur_connexion = true;
			}
		} 
		else{
			$est_connecte = false;
			$erreur_connexion = true;
		}
	}
?>

