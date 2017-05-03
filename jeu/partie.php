<?php session_start(); ?>

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
		?>
		<h1><?php echo $_SESSION['pseudo_joueur']; ?> vous attaque, aux abris moussaillon !</h1><br/>
		<div id="boutons_accueil">
			<div id="boiteconsignes"> <!-- div d'action (placement des bâteaux/pioche des cartes etc...) -->
				<form method='POST' action='./partie.php'>
						Il est temps de mettre en flotte en position ! <br/> <br/> <br/>

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

						<label><input type="radio" name="orientation" id="H" value="horizontal" <?php if( $_POST["orientation"] == "horizontal") { echo "CHECKED"; } ?>> Horizontal</label> <br/>
						<label><input type="radio" name="orientation" id="V" value="vertical" <?php if( $_POST["orientation"] == "vertical") { echo "CHECKED"; } ?>> Vertical</label> <br/>

				<br/>
						<label><input type="radio" name="bateau" id="1" value="0" <?php if( $_POST["bateau"] == "0") { echo "CHECKED"; } ?>>Porte-avion</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="1" <?php if( $_POST["bateau"] == "1") { echo "CHECKED"; } ?>>Croiseur</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="2" <?php if( $_POST["bateau"] == "2") { echo "CHECKED"; } ?>>Contre-torpilleur</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="3" <?php if( $_POST["bateau"] == "3") { echo "CHECKED"; } ?>>Sous-marin</label> <br/>
						<label><input type="radio" name="bateau" id="1" value="4" <?php if( $_POST["bateau"] == "4") { echo "CHECKED"; } ?>>Torpilleur</label> <br/>
				<br/>
				<br/>
				<br/>
						<input id="cliva" name="cliquevalider" type="Submit" value="Placer le navire"/>
				</form>
		        <br/>
				<?php if($_POST['bateau'] != null) echo "Placement d'un ".$_POST["bateau"]." ".$_POST["orientation"]." en : ".$_POST["lettre"].$_POST["chiffre"]; ?>
				<?php  
					if (isset($_POST['bateau']) && isset($_POST['orientation'])
					{
						AjouterBateau($_POST["bateau"], $_POST["orientation"], $_POST["lettre"], $_POST["chiffre"]);
					}
 				?>
			</div>
			<div id="boitecarte"> <!-- div des dernières cartes jouées -->
				<?php $data_array = $_GET['case[0]'];
						echo $data_array; ?>
			</div>
			<div id="boitegrilles"> <!-- div de la grille perso -->
				<?php 
					CreationGrillePerso(); 
					GrillePersoHTML();
				?>
			</div>
			<br/>
			<div id="boitegrilles"> <!-- div de la grille ennemie -->
				<?php getGrilleEnnemie(); ?>
			</div>
		</div>
	</body>
</html>
