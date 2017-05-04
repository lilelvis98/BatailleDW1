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
				getadv();
				getActionTour();
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
					Creationtirsperso();
					GrilleAdvHTML();
				?>
			</div>
			<br/>
			<div id="boitegrilleperso">
				<?php 
					CreationGrilleperso();
					Creationtirsadv();
					GrillePersoHTML();
				?>
			</div>
		</div>
	</body>
</html>
