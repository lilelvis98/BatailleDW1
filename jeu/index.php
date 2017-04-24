<?php session_start(); 
?>

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
									header("Location: http://bdw1.univ-lyon1.fr/p1507338/projet/jeu/accueil.php");
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

