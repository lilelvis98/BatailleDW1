<?php session_start(); ?>

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
			<form id="bouton_accueil" action='jouer.php'>
				<button id="bouton_stats" type="submit" formaction="statistiques.php">STATISTIQUES</button>
				<button id="bouton_jouer" type="submit">JOUER</button>
				<table id="tab_contacts">
					<th id="th_contact">Contacts</th>
					<tr id="marge_avant_contacts"></tr>
					<?php 
						getamis(); 
					?>
				</table>
			</form>
			
		</div>
	</body>
</html>
