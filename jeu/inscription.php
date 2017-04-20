<!DOCTYPE html>
<html>
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">
		<title>La Bataille Navale</title>
		<?php
			session_start();
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
					<form method='POST' action='./accueil.php'>
					<br/>
					<p>
						<div id="ChampsObligatoires">*<input id="Nom_Joueur" name="Nom" type="text" size= 20 maxlength=20 placeholder="Nom" /></div>
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="Prenom" name="Prenom" type="text" size= 20 maxlength=20 placeholder="Prenom" /></div>
					</p>
					<label>F<input type="radio" name="sexe" id="homme" value="Homme"></label>
					<label>H<input type="radio" name="sexe" id="femme" value="Femme"></label>
					<p>
						<div id="ChampsObligatoires">*<input id="Date_Naiss" name="DateNaissance" type="text" size= 20 maxlength=20 placeholder="Date de Naissance" value="AAAA/MM/JJ" /></div>
					</p>
					<p>
						<div id="ChampsObligatoires"></div><input id="Ville_Res" name="VilleResidence" type="text" size= 20 maxlength=20 placeholder="Ville de résidence" />
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="Pseudo" name="Pseudo" type="text" size=20 maxlength=15 placeholder="Pseudo"/></div>
					</p>
					<p>
						<div id="ChampsObligatoires">*<input id="mdp" name="motDePasse" size=20 maxlength=20 type="password" placeholder="Mot de Passe" /></div>
					</p>
					<br/>
					<p>
						<input id="cliva" name="cliquevalider" type="submit" value="S'inscrire" class="inscription"/>
					</p>

					</form>
				</p>
				<div id="erreur"><!--div de connexion -->
					<?php
						if(isset($_POST["cliquevalider"]))
						{
							inscription_site($_POST['pseudoJoueur'], $_POST['motDePasse']);

							global $est_connecte;
							if ($est_connecte){
								$_SESSION['pseudo_joueur'] = $_POST['pseudoJoueur'];

								header("Location: http://localhost/BatailleDW1/jeu/accueil.php");
							}else{echo "Identifiant ou Mot de Passe incorrect.";}
						}
					?>
				</div>
			</div>
		</div>


		<!-- Div d'erreur de co -->
		
	</body>
</html>

