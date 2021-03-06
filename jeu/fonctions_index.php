<?php
	/*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
	//Pseudo du Joueur connecté
	$pseudo_joueur = null;

	$est_connecte = false;
	$erreur_connection = false;

	//Fonction de connexion au site
	function connexion_site($pseudo_donne, $mdp_donne){
		global $connexion;
		global $est_connecte;
		global $erreur_connexion;

		$sql = "SELECT Mdp, Id_Joueur FROM Joueur WHERE Pseudo = '$pseudo_donne'";
		$resultat = $connexion->query($sql);

		//On vérifie que son Pseudo existe bien
		if ($resultat->num_rows > 0){
			$mdp_bd = mysqli_fetch_assoc($resultat);
		
			//On stocke l'id pour après
			$id_joueur = $mdp_bd["Id_Joueur"];
			

			//On vérifie que le MDP est bon
			if (password_verify($mdp_donne, $mdp_bd["Mdp"])){
				$est_connecte = true;

				//On passe le Joueur en ligne
				$sql_co = "UPDATE Joueur SET Online = 1 WHERE Id_Joueur = $id_joueur";
				$resultat_co = mysqli_query($connexion, $sql_co);
				if (!$resultat_co){echo "Woops";}

				global $pseudo_joueur;
				$pseudo_joueur = $pseudo_donne;
				$_SESSION["id_joueur"] = $id_joueur;
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

	function deconnexion_site(){
		global $connexion;
		$id_j = $_SESSION['id_joueur'];
		
		//On déconnecte l'utilisateur dans la BD
		$sql_deco = "UPDATE Joueur SET Online = 0 WHERE Id_Joueur = $id_j";
		$resultat_deco = mysqli_query($connexion, $sql_deco);
		if (!$resultat_deco){echo "Déconnexion échouée :(";}
		else{echo "<br/><i class='fa fa-database'></i>" . " Déconnexion réussie...";}

		//On vide les variables en session...
		$_SESSION['id_joueur'] = null;
		$_SESSION['pseudo_joueur'] = null;
		$_SESSION['id_adversaire'] = null;
		$_SESSION['id_partie'] = null;

	}
?>

