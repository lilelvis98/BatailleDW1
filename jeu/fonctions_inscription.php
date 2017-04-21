<?php
	$erreur_inscription = null;

	//Fonction d'inscription au site
	function inscription_site($pseudo_inscription, $mdp_inscription){
		global $connexion;
		$sql = "SELECT Pseudo FROM Joueur WHERE Pseudo = '$pseudo_inscription'";
		$resultat = $connexion->query($sql);

		//On vérifie que son Pseudo n'existe pas déjà
		if ($resultat->num_rows > 0){
				//TODO TODO TODO TODO TODO
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

