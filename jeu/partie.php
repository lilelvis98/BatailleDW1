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
			require_once('./fonctions_partie.php');
		?>
		<h1><?php echo $_SESSION['pseudo_joueur']; ?> vous attaque, aux abris moussaillon !</h1><br/>
		<div id="boutons_accueil">
			<div id="boiteconsignes"> <!-- div d'action (placement des bâteaux/pioche des cartes etc...) -->
				<form method='POST' action='./partie.php'>
						<label><input type="radio" name="orientation" id="H" value="horizontal" <?php if( $_POST["orientation"] == "horizontal") { echo "CHECKED"; } ?>> Horizontal</label> <br/>
						<label><input type="radio" name="orientation" id="V" value="vertical" <?php if( $_POST["orientation"] == "vertical") { echo "CHECKED"; } ?>> Vertical</label> <br/>

				<br/>
						<label><input type="radio" name="bateau" id="1" value="Porte-avion" <?php if( $_POST["bateau"] == "Porte_avion") { echo "CHECKED"; } ?>>Porte-avion</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="Croiseur" <?php if( $_POST["bateau"] == "Croiseur") { echo "CHECKED"; } ?>>Croiseur</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="Contre-torpilleur" <?php if( $_POST["bateau"] == "Contre-torpilleur") { echo "CHECKED"; } ?>>Contre-torpilleur</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="Sous-marin" <?php if( $_POST["bateau"] == "Sous-marin") { echo "CHECKED"; } ?>>Sous-marin</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="Torpilleur" <?php if( $_POST["bateau"] == "Torpilleur") { echo "CHECKED"; } ?>>Torpilleur</label> <br/>
		        <br/>
						<input id="cliva" name="cliquevalider" type="Submit" value="Actualiser"/>
				</form>
		        <br/>
				<?php echo "Apperçu du ".$_POST["bateau"]." ".$_POST["orientation"]; ?>
			</div>
			<div id="boitecarte"> <!-- div des dernières cartes jouées -->
				Ceci sont des cartes métales
			</div>
			<div id="boitegrilles"> <!-- div de la grille perso -->
				<?php getGrillePerso(); ?>
			</div>
			<br/>
			<div id="boitegrilles"> <!-- div de la grille ennemie -->
				<?php getGrilleEnnemie(); ?>
			</div>
		</div>
	</body>
</html>
