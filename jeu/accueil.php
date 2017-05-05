<?php /*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
session_start(); ?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">
		
		<title>La Bataille Navale</title>
		<?php
			require_once('./fonctions.php');			
			require_once('./fonctions_accueil.php');
		?>
	</head>

	<body>
		<h1>Bienvenue, <?php echo $_SESSION['pseudo_joueur'];?> !</h1>
		<div id="boutons_accueil">
			<div id="boiteconsignes_stats">
			<form id="bouton_stats" action='statistiques.php'>
				<button id="bouton_stats" type="submit">STATISTIQUES</button>
			</form>
			</div>
			<table id="tab_contacts">
				<th id="th_contact">Contacts</th>
				<tr id="marge_avant_contacts"></tr>
				<?php
					getamis(); 
				?>
			</table>
			<div id="boitejouer">
			<form id="bouton_jouer" action='jouer.php'>
				<button id="bouton_jouer" type="submit">JOUER</button>
				
			</form>
			</div>

		<div id="bouton_deco">
			<form method='POST' action='./index.php'>
				<input id="clidec" name="cliqueDeconnexion" type="submit" value="Deconnexion" class="deconnexion"/>
			</form>
		</div>
	</body>
</html>
