<?php
	//variables utilitaires pour inviter_joueur
	$pseudo_incorrect = false;
	$id_invitant = $_SESSION["id_joueur"];
	$invitation_correcte = false;

	//Fonction d'invitation de Joueur
	function inviter_joueur($pseudo_invite){
		global $connexion;
		$connexion = $_SESSION["connexion"];
		global $pseudo_incorrect;
		global $invitation_correcte;
		global $id_invitant;

		$sql = "SELECT * FROM Joueur WHERE Pseudo = '$pseudo_invite'";
		$resultat = $connexion->query($sql);

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

				if ($resultat->num_rows > 0){
					//Les joueurs ont déjà une partie, on ne fait rien
				}
				else{
					//On invite l'autre joueur...

					//On commence par trouver le plus grand id de partie et y ajouter 1 --de façon similaire à l'inscription d'un joueur--
					$sql = "SELECT MAX(Id_Partie) AS id FROM Partie";
					$resultat = mysqli_query($connexion, $sql);
					$id_partie_arr = mysqli_fetch_assoc($resultat);
					$id_partie = $id_partie_arr["id"];
					if ($id_partie === null){$id_partie = 1;}
					else{$id_partie++;}

					$temps = date("Y-m-d");

					//On crée la nouvelle partie en insérant le tuple
					$sql = "INSERT INTO Partie(Id_Partie, Id_Initiateur, Id_Invite, Id_Etat, Id_Gagnant, Date_Creation) VALUES ($id_partie, $id_invitant, $id_invite, 1, NULL, '$temps')";
					$resultat = mysqli_query($connexion, $sql);
					if ($resultat) {
						$invitation_correcte = true;
					} else {
						echo "Error: " . $sql . "<br>" . $connexion->error;
					}

					//On récupère le plus haut Id de Bateau... pareil que pour la partie
					$sql_id = "SELECT MAX(Id_Bateau) AS id FROM Bateau";
					$resultat = mysqli_query($connexion, $sql_id);
					$max_id_bateau_arr = mysqli_fetch_assoc($resultat);
					$max_id_bateau = $max_id_bateau_arr["id"];

					if ($max_id_bateau === null){$max_id_bateaue = 1;}
					else{$max_id_bateau++;}

					//On crée les bateaux de l'invitant
					for ($num_bateau = 0; $num_bateau <= 4; $num_bateau++) {
    					$sql_bateau = "INSERT INTO Bateau (Id_Bateau, Id_Partie, Id_Joueur, Id_Type_Navire, Coord_Y, Coord_X, Bool_Orientation, Bool_Etat) VALUES ($max_id_bateau, $id_partie, $id_invitant, $num_bateau, NULL, NULL, NULL, 0)";

						$resultat_bateau = mysqli_query($connexion, $sql_bateau);
						if (!$resultat_bateau) {
							echo "Error: " . $sql . "<br>" . $connexion->error;
						}

						$max_id_bateau++;
					}

					$max_id_bateau++;

					//On crée les bateaux de l'invité
					for ($num_bateau = 0; $num_bateau <= 4; $num_bateau++) {
    					$sql_bateau = "INSERT INTO Bateau (Id_Bateau, Id_Partie, Id_Joueur, Id_Type_Navire, Coord_Y, Coord_X, Bool_Orientation, Bool_Etat) VALUES ($max_id_bateau, $id_partie, $id_invite, $num_bateau, NULL, NULL, NULL, 0)";

						$resultat_bateau = mysqli_query($connexion, $sql_bateau);
						if (!$resultat_bateau) {
							echo "Error: " . $sql . "<br>" . $connexion->error;
						}

						$max_id_bateau++;
					}
				}
			}
		}
	}

	function get_parties_joueur(){
		global $connexion;
		$connexion = $_SESSION["connexion"];
		global $id_invitant; //Assimilé à id_joueur

		$sql = "SELECT Id_Invite AS id_j, Date_Creation, Id_Etat AS id_p FROM Partie WHERE Id_Initiateur = $id_invitant UNION SELECT Id_Initiateur AS id_j, Date_Creation, Id_Etat AS id_p FROM Partie WHERE Id_Invite = $id_invitant";
		$resultat = $connexion->query($sql);
		if (!($resultat->num_rows > 0)){
			echo "Vous n'avez pas de partie en cours ! \nInvitez un Joueur pour en démarrer une.";
		}else{

			while($data = mysqli_fetch_assoc($resultat)){
				$id_adversaire = $data['id_j'];	
				$date_cre = $data['Date_Creation'];
				$id_etat = $data['id_p'];

				$sql2 = "SELECT Pseudo FROM Joueur WHERE Id_Joueur = $id_adversaire";
				$resultat2 = $connexion->query($sql2);
				$data2 = mysqli_fetch_assoc($resultat2);
				$pseudo_adversaire = $data2['Pseudo'];

				echo '<tr id="contact">';
				echo "   <td id='Pseudo_contact'><form method='POST' action='./jouer.php'>"."<input id='pseudoadv' name='pseudoAdversaire' type='text' value='$pseudo_adversaire' readonly/>"."</td>";

				echo "   <td> <input id='clicpa' name='cliquepartie' type='submit' value='Jouer' class='reprendrepartie'></form></td>";
				echo '</tr>';
				echo '<tr>';
				echo '   <td id="contact_last_game">';
				if ($id_etat == 0)
				{
					echo "Partie en cours, débutée le ".$max_date_data;
				}
				else if ($id_etat == 1)
				{
					echo "En Attente depuis le ".$date_cre;
				}
				else
				{
					echo "Aucune partie, dernière commencée le ".$date_cre;
				}
				echo '   </td>';
				echo '</tr>';
			}
		}
	}
?>

