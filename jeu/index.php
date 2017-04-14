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

			//connexion à la base de données
			connexion_bd();
		?>

		<h1>Bonjour et bienvenue, matelot !</h1><br />

		<!-- Formulaire de connexion -->
		<div id="boiteconnexion">
			<div id="centrer">
				<p>Connexion</p>
				<form method='POST' action='./connexion.php'>
					<p>
						<input id="pseudoJ" name="pseudoJoueur" type="text" placeholder="Pseudo" />
					</p>
					<p>
						<input id="mdp" name="motDePasse" type="password" placeholder="Mot de Passe" />
					</p>
					<p>
						<input id="clico" name="cliqueconnexion" type="submit" value="Se Connecter" class="connexion"/>
					</p>
				</form>
			</div>
		</div>

<!-- Div d'erreur de co -->

		<!-- Formulaire d'inscription -->
		<div id="boiteinscription">
			<div id="centrer">
				<p>
					<form method='POST' action='./inscription.php'>
						<p>
							<input id="clici" name="cliqueinscription" type="submit" value="S'inscrire" class="inscription"/>
						</p>
					</form>
				</p>
			</div>
		</div>
	</body>
</html>

