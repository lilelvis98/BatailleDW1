<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">
		
		<title>La Bataille Navale</title>
	</head>

	<body>
		<h1>A l'abordage maintenant!</h1>
			<div id="boutons_accueil">
				Ici il y aura le dernière carte piochée et le Joueur qui est en train de faire son tour
			</div>
			<div id="boitegrilles"> <!-- div de la grille perso et ennemie-->
				<?php
					GrillePersoHTML();
				?>
			</div>
			<br/>
			<div id="boitegrilles">
				<?php getGrilleEnnemie(); ?>
			</div>
			<div id="boitecarte"> <!-- div des dernières cartes jouées -->
				Ici ce sont les dernières cartes piochées
			</div>
	</body>
</html>
