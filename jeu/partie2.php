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
			require_once('./fonctions_partie2.php');
			require_once('./fonctions_accueil.php');
		?>
		<h1>A l'abordage maintenant!</h1>
<div id="boutons_accueil">
			<div id="boiteconsignes">
				<form method='POST' action='./partie2.php'>
					Capitaine, quels sont vos ordres de tir ? <br/><br/>
					<select name="lettre">
					  <option value="1">A</option>
					  <option value="2">B</option>
					  <option value="3">C</option>
					  <option value="4">D</option>
					  <option value="5">E</option>
					  <option value="6">F</option>
					  <option value="7">G</option>
					  <option value="8">H</option>
					  <option value="9">I</option>
					  <option value="10">J</option>
					</select>
					<select name="chiffre">
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					  <option value="6">6</option>
					  <option value="7">7</option>
					  <option value="8">8</option>
					  <option value="9">9</option>
					  <option value="10">10</option>
					</select>
					<br/>
					<br/>
					<input id="valider_tir" name="cliquevalider" type="Submit" value="Feu !!!"/>
				</form>
				
			</div>
			<table id="tab_contacts">
					<th id="th_contact">Contacts</th>
					<tr id="marge_avant_contacts"></tr>
					<?php
						getamis(); 
					?>
			</table>
			<div id="boitegrilleadv"> <!-- div de la grille perso et ennemie-->
				<?php
					CreationGrilleadv();
					Creationtirsperso();
					GrilleAdvHTML();
				?>
			</div>
			<br/>
			<div id="boitegrilleperso">
				<?php 
					CreationGrilleperso();
					Creationtirsadv();
					GrillePersoHTML();
				?>
			</div>
</div>
	</body>
</html>
