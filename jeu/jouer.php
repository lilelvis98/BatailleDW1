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
						<input id="pseudoInv" name="pseudoInvitation" type="text" placeholder="Pseudo" />
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
	</body>
</html>
