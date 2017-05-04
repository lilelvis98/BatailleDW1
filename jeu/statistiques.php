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
			require_once('./fonctions_statistiques.php');
		?>
		<h1> Admirez-donc vos statistiques, matelot ! </h1><br />

		<div id= "boitestatistiques">
			<br/><br/>
			<?php
				get_statistiques(); 
			?>
		</div>

		<div id="bouton_deco">
			<form method='POST' action='./index.php'>
				<input id="clidec" name="cliqueDeconnexion" type="submit" value="Deconnexion" class="deconnexion"/>
			</form>
		</div>
		<div id="bouton_retour">
			<form method='POST' action='./accueil.php'>
				<input id="cliret" name="cliqueRetour" type="submit" value="Retour à l'accueil"/>
			</form>
		</div>
	</body>
</html>

