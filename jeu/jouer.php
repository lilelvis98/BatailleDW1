<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">
		
		<title>La Bataille Navale</title>
	</head>

	<body>
		<?php
			require_once('./fonctions.php');
			require_once('./fonctions_jouer.php');
		?>
		<h1> Invitez un Joueur à une nouvelle partie ou reprenez une partie en cours ! </h1><br />

		<div id="boiteinvitation">
			<p>Invitez un Joueur en entrant son Pseudo</p>
			<form method='POST' action='./jouer.php'>
					<p>
						<input id="pseudoInv" name="pseudoInvitation" type="text" placeholder="Pseudo" maxlength=15/>
					</p>
					<p>
						<input id="clicinv" name="cliqueinvitation" type="submit" value="Inviter" class="invitation">
					</p>
					<div id="erreur"><!--div de recherche du Pseudo -->
						<?php
							if(isset($_POST["pseudoInvitation"]))
							{
								inviter_joueur($_POST['pseudoInvitation']);

								global $invitation_correcte;
								$pseudo_inv_string = $_POST['pseudoInvitation'];

								if ($invitation_correcte){
									echo "Le joueur $pseudo_inv_string a bien été invité.";
								}else if ($pseudo_incorrect){
									echo "Le Joueur recherché n'existe pas ou il s'agit de votre Pseudo.";
								}else{
									echo "Vous avez déjà une partie avec $pseudo_inv_string en cours ou en préparation.";
								}
							}
						?>
					</div>
				</form>
		</div>
		<div id= "boiteparties">
			<table id="tab_parties">
						<th id="th_partie">Parties</th>
						<tr id="marge_avant_contacts"></tr>
						<?php
							get_parties_joueur(); 

							echo "<div id='erreur'>";
							if(isset($_POST['pseudoAdversaire'])){//On stocke certaines variables en session
								$_SESSION['pseudo_adversaire'] = $_POST['pseudoAdversaire'];
								$pseudo_adversaire = $_SESSION['pseudo_adversaire']; //copie

								$sql = "SELECT Id_Joueur FROM Joueur WHERE Pseudo = '$pseudo_adversaire'";
								$resultat = mysqli_query($connexion, $sql);
								$resultat_array = mysqli_fetch_assoc($resultat);
								$id_adversaire = $resultat_array["Id_Joueur"];
								$_SESSION["id_adversaire"] = $id_adversaire; //On stocke en session

								$sql2 = "SELECT Id_Partie, Id_Etat FROM Partie WHERE ((Id_Initiateur = $id_invitant AND Id_Invite = $id_adversaire) OR (Id_Initiateur = $id_adversaire AND Id_Invite = $id_invitant)) AND Id_Etat <> 2";
								$resultat2 = $connexion->query($sql2);
								$resultat_array2 = mysqli_fetch_assoc($resultat2);
								$id_partie2 = $resultat_array2["Id_Partie"];
								$id_etat_partie = $resultat_array2["Id_Etat"];
								$_SESSION["id_partie"] = $id_partie2;

								if($id_etat_partie == 0){
									header("Location: partie.php");
								}else if ($id_etat_partie == 1){
									//Si la partie est en attente, on regarde si l'utilisateur est l'invité. Si oui, on lance la partie
									$sql3 = "SELECT Id_Invite FROM Partie WHERE Id_Initiateur = $id_adversaire AND Id_Etat = 1";
									$resultat3 = $connexion->query($sql3);
									if ($resultat3->num_rows === 0){
										echo "Vous avez invité $pseudo_adversaire, mais il n'a pas encore répondu...";
									}else{
										//On démarre leur partie
										$sql4 = "UPDATE Partie SET Id_Etat = 0 WHERE Partie.Id_Partie = $id_partie2";
										$resultat4 = mysqli_query($connexion, $sql4);
										if ($resultat4){
											header("Location: partie.php");
										}else{echo "Error: " . $sql . "<br>" . $connexion->error;}
									}
								}
							}
							echo "</div>";
						?>
			</table>
		</div>

		
	</body>
</html>
