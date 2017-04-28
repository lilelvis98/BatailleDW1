<?php session_start(); ?>

<!DOCTYPE html>
<html>
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">
		<title>La Bataille Navale</title>
		<?php
			require_once('./fonctions.php');
			require_once('./fonctions_inscription.php');
		?>

	</head>
	<body>
		<br/>
		<h1>Bienvenue et inscris-toi, matelot !</h1>
		<br/><br/>

		<!-- Formulaire d'inscription -->
		<div id="boiteinscription2">
			<div id="centrer">
				<p>

					<div>Formulaire d'inscription</div><br/>
					<div id="ChampsObligatoires">* Ces champs sont requis</div>
					<form method='POST' action='./inscription.php'>
					<br/>
					<p>
						<div id="ChampsObligatoires">*<input id="nomJ" name="nomJoueur" type="text" size= 20 maxlength=20 placeholder="Nom" /></div>
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="prenomJ" name="prenomJoueur" type="text" size= 20 maxlength=20 placeholder="Prenom" /></div>
					</p>
					<label>F<input type="radio" name="sexeJoueur" id="homme" value="Homme" CHECKED></label>
					<label>H<input type="radio" name="sexeJoueur" id="femme" value="Femme"></label>
					<p>
						<div id="ChampsObligatoires">*<input id="dateNaissJ" name="dateNaissanceJoueur" type="text" size= 20 maxlength=20 placeholder="Date de Naissance" value="AAAA/MM/JJ" /></div>
					</p>
					<p>
						<div id="ChampsObligatoires"></div><input id="villeResJ" name="villeResidenceJoueur" type="text" size= 20 maxlength=20 placeholder="Ville de résidence" />
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="pseudoJ" name="pseudoJoueur" type="text" size=20 maxlength=15 placeholder="Pseudo"/></div>
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="mdpJ" name="motDePasse" size=20 maxlength=20 type="password" placeholder="Mot de Passe" /></div>
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="mdpJCONF" name="motDePasseConf" size=20 maxlength=20 type="password" placeholder="Confirmez le MDP" /></div>
					</p>
					<br/>
					<p>
						<input id="cliva" name="cliquevalider" type="submit" value="S'inscrire" class="inscription"/>
					</p>

					</form>
				</p>
				<div id="erreur"><!--div d'inscription -->
					<?php
						//Quand les infos ont été entrées, on tente d'inscrire l'utilisateur
						if(isset($_POST["nomJoueur"]))
						{
							if ($_POST["sexeJoueur"] === "Homme"){$sexe = 1;}else{$sexe = 0;}
							inscription_site($_POST['nomJoueur'], $_POST['prenomJoueur'], $sexe, $_POST['dateNaissanceJoueur'], $_POST['villeResidenceJoueur'], $_POST['pseudoJoueur'], $_POST['motDePasse'], $_POST['motDePasseConf']);
							
							if ($inscription_faite){
								$_SESSION['pseudo_joueur'] = $_POST['pseudoJoueur'];
								header("Location: http://bdw1.univ-lyon1.fr/p1507338/projet/jeu/accueil.php");
							}
							else{echo $_SESSION['erreur_inscription'];}
						}
					?>
				</div>
			</div>
		</div>
		
	</body>
</html>

