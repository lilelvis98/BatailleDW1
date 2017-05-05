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
			require_once('./fonctions_partie.php');
			require_once('./fonctions_accueil.php');
		?>
		<h1>Il est temps choisir vos meilleurs marins Capitaine <?php echo $_SESSION['pseudo_joueur']; ?> !</h1><br/>
		<div id="boutons_accueil">
			<div id="boiteconsignes"> <!-- div d'action (placement des bâteaux/pioche des cartes etc...) -->
				<form method='POST' action='./partie.php'>
						Choisissez la position de votre flotte, tous les bateaux doivent être placés :<br/> <br/> <br/>

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

						<label><input type="radio" name="orientation" id="H" value="1" <?php if( $_POST["orientation"] == "1") { echo "CHECKED"; } ?>> Horizontal</label> <br/>
						<label><input type="radio" name="orientation" id="V" value="0" <?php if( $_POST["orientation"] == "0") { echo "CHECKED"; } ?>> Vertical</label> <br/>

				<br/>
						<label><input type="radio" name="bateau" id="1" value="0" <?php if( $_POST["bateau"] == "0") { echo "CHECKED"; } ?>> [1] Porte-avion <div id="en_savoir_plus"><a href="https://fr.wikipedia.org/wiki/Porte-avions">?</a></div></label> <br/>
						<label><input type="radio" name="bateau" id="1" value="1" <?php if( $_POST["bateau"] == "1") { echo "CHECKED"; } ?>> [2] Croiseur <div id="en_savoir_plus"><a href="https://fr.wikipedia.org/wiki/Croiseur">?</a></div></label> <br/>
						<label><input type="radio" name="bateau" id="1" value="2" <?php if( $_POST["bateau"] == "2") { echo "CHECKED"; } ?>> [3] Contre-torpilleur <div id="en_savoir_plus"><a href="https://fr.wikipedia.org/wiki/Destroyer">?</a></div></label> <br/>
						<label><input type="radio" name="bateau" id="1" value="3" <?php if( $_POST["bateau"] == "3") { echo "CHECKED"; } ?>> [4] Sous-marin <div id="en_savoir_plus"><a href="https://fr.wikipedia.org/wiki/Sous-Marin">?</a></div></label> <br/>
						<label><input type="radio" name="bateau" id="1" value="4" <?php if( $_POST["bateau"] == "4") { echo "CHECKED"; } ?>> [5] Torpilleur <div id="en_savoir_plus"><a href="https://fr.wikipedia.org/wiki/Torpilleur">?</a></div></label> <br/>
				<br/>
						<input id="cliva" name="cliquevalider" type="Submit" value="Placer le navire"/>
				</form>
		        <br/>
				<?php 

					if (isset($_POST['bateau']) and isset($_POST['orientation']))
					{
						AjouterBateau($_POST["bateau"], $_POST["orientation"], $_POST["lettre"], $_POST["chiffre"]);
					}
 				?>
				<br/>
				<br/>
				<br/>
				<form method='POST' action='./partie.php'>
					<input id="valider_pos" name="cliquevalider" type="Submit" value="Valider les positions"/>
				</form>
				<?php 
					CreationGrillePerso(); 
					if($_POST['cliquevalider'] == "Valider les positions")
					{
						GrilleValidable();
					}

					if ($partie_2)
					{					
						header("Location: ./partie2.php");
					}
					else if($partie_3)
					{
						header("Location: ./partie3.php");
					}
				?>
			</div>
			<table id="tab_contacts">
					<th id="th_contact">Contacts</th>
					<tr id="marge_avant_contacts"></tr>
					<?php
						getamis(); 
					?>
			</table>
			<div id="boitegrilles"> <!-- div de la grille perso -->
				<?php 
					
					GrillePersoHTML();
				?>
			</div>
			<div id="bouton_deco">
			<form method='POST' action='./index.php'>
				<input id="clidec" name="cliqueDeconnexion" type="submit" value="Deconnexion" class="deconnexion"/>
			</form>
			</div>
		</div>
	</body>
</html>
