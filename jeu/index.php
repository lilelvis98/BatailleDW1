<?php /*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">

		<title>La Bataille Navale</title>
	</head>

	<body>
		<?php
			require_once('./fonctions.php');
			require_once('./fonctions_index.php');
		?>

		<h1>Bonjour et bienvenue, matelot !</h1><br />

		<!-- Formulaire de connexion -->
		<div id="boiteconnexion">
			<div id="centrer">
				<p>Connexion</p>
				<form method='POST' action='./index.php'>
					<p>
						<input id="pseudoJ" name="pseudoJoueur" type="text" placeholder="Pseudo" />
					</p>
					<p>
						<input id="mdpJ" name="motDePasse" type="password" placeholder="Mot de Passe" />
					</p>
					<div id="erreur"><!--div de connexion -->
						<?php
							if(isset($_POST["pseudoJoueur"]) && isset($_POST["motDePasse"]))
							{
								connexion_site($_POST['pseudoJoueur'], $_POST['motDePasse']);

								global $est_connecte;
								if ($est_connecte){
									global $connexion;
									$_SESSION['pseudo_joueur'] = $_POST['pseudoJoueur'];
									$_SESSION['connexion'] = $connexion;
									//^Si la connexion est faite, on garde le pseudo et la connexion^
									header("Location: accueil.php");
								}else{echo "Identifiant ou Mot de Passe incorrect.";}
							}
						?>
					</div>
					<p>
						<input id="clico" name="cliqueconnexion" type="submit" value="Se Connecter" class="connexion"/>
					</p>
				</form>
			</div>
		</div>

		<!-- Formulaire d'inscription -->
		<div id="centrer">
			<div id="boiteinscription">
				<p>
					<form method='POST' action='./inscription.php'>
						<p>
							<input id="clici" name="cliqueinscription" type="submit" value="S'inscrire" class="inscription"/>
						</p>
					</form>
				</p>
			</div>

				<?php 
					if(isset($_POST["cliqueDeconnexion"])){
						deconnexion_site();
					}
				?>
		</div>
		<div id="github_lien">
			<a href="http://github.com/lilelvis98/BatailleDW1"><i class="fa fa-github"></i> GitHub</a>
		</div>
		<div id="bdw_lien">
			<a href="http://liris.cnrs.fr/nicolas.lumineau/"><i class="fa fa-university"></i> LIFBDW1</a>
		</div>
		<div id="wikipedia_lien">
			<a href="https://fr.wikipedia.org/wiki/Bataille_navale_(jeu)"><i class="fa fa-wikipedia-w" aria-hidden="true"></i></i> Règles et Principes du Jeu</a>
		</div>
	</body>
</html>

