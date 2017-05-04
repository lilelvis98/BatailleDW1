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
		?>
		<h1>A l'abordage maintenant!</h1>
<div id="boutons_accueil">
			<div id="boiteconsignes">
				Ici il y aura la dernière carte piochée et le Joueur dont c'est le tour
			</div>
			<div id="boitecarte"> <!-- div des dernières cartes jouées -->
				Ici ce sont les dernières cartes piochées
			</div>
			<div id="boitegrilles"> <!-- div de la grille perso et ennemie-->
				<?php
					CreationGrilleperso();
					GrillePersoHTML();
				?>
			</div>
			<br/>
			<div id="boitegrilles">
				<?php 
					CreationGrilleadv();
					GrilleAdvHTML();
				?>
			</div>
</div>
	</body>
</html>
