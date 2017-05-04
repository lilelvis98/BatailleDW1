<?php
	/*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
	if ($_SESSION["erreur_inscription"] === null){
		$erreur_inscription = "erreur -inconnue";
	}
	$inscription_faite = false;

	//Fonction d'inscription au site
	function inscription_site($nom_insc, $prenom_insc, $sexe_insc, $date_naiss_insc, 			  	 	 						  $ville_res_insc, $pseudo_insc, $mdp_insc, $mdp_conf_insc){

		global $inscription_faite;
		$connexion = $_SESSION["connexion"];
		//On check si tous les champs obligatoires sont entrés --Vishnu pardonne-moi pour cette horreur de if
		//Note : on a pas trop le temps d'essayer d'empêcher les injections SQL, on a plus qu'à prier pour que les gens ne soient pas des saligauds
		if (ctype_space($nom_insc) || $nom_insc == ''){
			$erreur_inscription = "Veuillez entrer votre Nom.";
		}
		else if (ctype_space($prenom_insc) || $prenom_insc == ''){
			$erreur_inscription = "Veuillez entrer votre Prenom.";
		}
		else if (ctype_space($date_naiss_insc) || $date_naiss_insc == '' || !(preg_match("/^[0-9]{4}\/(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])$/",$date_naiss_insc))){
			$erreur_inscription = "Veuillez entrer votre Date de Naissance correctement : AAAA/MM/JJ";
		}
		else if (ctype_space($pseudo_insc) || $pseudo_insc == ''){
			$erreur_inscription = "Veuillez entrer votre Pseudo.";
		}
		else if (ctype_space($mdp_insc) || $mdp_insc == '' || strlen($mdp_insc) < 5){
			$erreur_inscription = "Veuillez entrer votre Mot de Passe (minimum 5 caractères).";
		}
		else if (ctype_space($mdp_conf_insc) || $mdp_conf_insc == ''){
			$erreur_inscription = "Veuillez confirmer votre Mot de Passe.";
		}
		else if (!($mdp_insc === $mdp_conf_insc)){
			$erreur_inscription = "Le Mot de Passe et le Mot de Passe confirmé ne sont pas identiques.";
		}
		else{
			global $connexion;
			$sql = "SELECT Pseudo FROM Joueur WHERE Pseudo = '$pseudo_insc'";
			$resultat = $connexion->query($sql);

			//On vérifie que son Pseudo n'existe pas déjà
			if ($resultat->num_rows > 0){
					$erreur_inscription = "Ce Pseudo est déjà pris.";
			}
			else{
				//On inscrit l'utilisateur !

				//On commence par déterminer le plus gros Id des Joueurs de la base de donnée et on y ajoute 1. Ce sera l'id du nouvel inscrit
				$sql = "SELECT MAX(Id_Joueur) AS id FROM Joueur";
				$resultat = mysqli_query($connexion, $sql);
				$id_insc_arr = mysqli_fetch_assoc($resultat);
				$id_insc = $id_insc_arr["id"];
				if ($id_insc === null){$id_insc = 1;}
				else{$id_insc++;}

				//On hache le mdp du nouvel inscrit
				$mdp_hache = password_hash($mdp_insc, PASSWORD_DEFAULT);
				$erreur_inscription = "  ";
				
				//On insère le tuple dans la base de données
				$sql = "INSERT INTO Joueur(Id_Joueur, Nom_Joueur, Prenom_Joueur, Sexe, Date_Naissance, Ville_Residence, Pseudo, Mdp) VALUES ($id_insc, '$nom_insc', '$prenom_insc', $sexe_insc, '$date_naiss_insc', '$ville_res_insc', '$pseudo_insc', '$mdp_hache')";
				$resultat = mysqli_query($connexion, $sql);
				if ($resultat) {
					$inscription_faite = true;

					//On passe le Joueur en ligne
					$sql_co = "UPDATE Joueur SET Online = 1 WHERE Id_Joueur = $id_joueur";
					$resultat_co = mysqli_query($connexion, $sql_co);
					if (!$resultat_co){echo "Woops";}

					$_SESSION["id_joueur"] = $id_insc;
				} else {
    			echo "Error: " . $sql . "<br>" . $connexion->error;
				}
			}
		}
		$_SESSION["erreur_inscription"] = $erreur_inscription;
	}
?>

