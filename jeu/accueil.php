<!DOCTYPE html>
<html>
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">
		<title>La Bataille Navale</title>
		<?php
			require_once('./fonctions.php');
		?>

	</head>
	<body>

		<h1>Bonjour et bienvenue, matelot !</h1>

		<div id="boiteconnexion">
			<form method='POST' action='./accueil.php'>
				<label for="nomB">connexion</label>
				<input id="pseudoJ" name="pseudoJoueur" type="text" placeholder="Pseudo" />
				<input id="mdp" name="motDePasse" type="password" placeholder="Mot de Passe" />
				<input id="clico" name="cliqueconnexion" type="submit" value="Se Connecter" />
			</form>
		</div>
		
	</body>
</html>
