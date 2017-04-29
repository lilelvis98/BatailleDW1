<?php
	//variables utilitaires pour inviter_joueur
	$pseudo_incorrect = false;
	$id_invitant = null;
	$invitation_correcte = false;

	//Fonction d'invitation de Joueur
	function inviter_joueur($pseudo_invite){echo $pseudo_invite . "<br/>";
		global $connexion;
		$connexion = $_SESSION["connexion"];
		global $pseudo_incorrect;
		global $invitation_correcte;
		global $id_invitant;
		echo $id_invitant;

		$sql = "SELECT * FROM Joueur WHERE Pseudo = '$pseudo_invite'";
		$resultat = $connexion->query($sql) /*or die("echec critique2 <br/>".mysqli_error())*/;
		if (!$resultat){echo "MARCHE PO";}
		//On vérifie que son Pseudo existe
		if (!($resultat->num_rows > 0)){
				$pseudo_incorrect = true;
		}
		else{
			//Si le Pseudo existe, on vérifie que l'invitant et l'invité n'aient pas de partie en cours ou en attente

			//On récupère l'Id_Joueur du Pseudo entré
			$id_a_parser = mysqli_fetch_assoc($resultat);
			$id_invite = $id_a_parser["Id_Joueur"];

			if ($id_invite === $id_invitant){//On vérifie qu'il ne s'invite pas lui-même
				$pseudo_incorrect = true;
			}else{

				$sql = "SELECT * FROM Partie WHERE ((Id_Initiateur = $id_invitant AND Id_Invite = $id_invite) OR (Id_Initiateur = $id_invite AND ID_Invite = $id_invitant)) AND Id_Etat <> 2";
				$resultat = $connexion->query($sql);

				if ($resultat->num_rows == 0){
					//Les joueurs ont déjà une partie, on ne fait rien
				}
				else{
					//On invite l'autre joueur...

					//On commence par trouver le plus grand id de partie et y ajouter 1 -de façon similaire à l'inscription d'un joueur
					$sql = "SELECT MAX(Id_Partie) AS id FROM Partie";
					$resultat = mysqli_query($connexion, $sql);
					$id_partie_arr = mysqli_fetch_assoc($resultat);
					$id_partie = $id_partie_arr["id"];
					if ($id_partie === null){$id_partie = 1;}
					else{$id_partie++;}

					$temps = date("Y-m-d");
					//On crée la nouvelle partie en insérant le tuple
					$sql = "INSERT INTO Partie(Id_Partie, Id_Initiateur, Id_Invite, Id_Etat, Id_Gagnant, Date_Creation) VALUES ($id_partie, $id_invitant, $id_invite, 1, NULL, $temps)";
					$resultat = mysqli_query($connexion, $sql);
					if ($resultat) {
						$invitation_correcte = true;
					} else {
					echo "Error: " . $sql . "<br>" . $connexion->error;
					}
				}
			}
		}
	}
?>

