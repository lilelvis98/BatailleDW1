<?php /*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
session_start(); ?>

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
			require_once('./fonctions_partie2.php');
			require_once('./fonctions_accueil.php');
		?>
		<h1>A l'abordage maintenant!</h1>
		<div id="boutons_accueil">
			<?php
				CreationGrilleperso();
				Creationtirsadv();
				CreationGrilleadv();
				Creationtirsperso();
				getadv();
				FinJeu();
				getActionTour();
				if($_POST['cliquevalider'] == "Feu !!!")
				{
					header("Location: ./partie2.php");
				}
			?>
			<table id="tab_contacts">
					<th id="th_contact">Contacts</th>
					<tr id="marge_avant_contacts"></tr>
					<?php
						getamis(); 
					?>
			</table>
			<div id="boitegrilleadv"> <!-- div de la grille perso et ennemie-->
				<?php
					CreationGrilleadv();
					GrilleAdvHTML();
				?>
			</div>
			<br/>
			<div id="boitegrilleperso">
				<?php 
					GrillePersoHTML();
				?>
			</div>
			<div id="bouton_deco">
			<form method='POST' action='./index.php'>
				<input id="clidec" name="cliqueDeconnexion" type="submit" value="Deconnexion" class="deconnexion"/>
			</form>
			</div>
	</body>
</html>
