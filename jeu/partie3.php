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
			require_once('./fonctions_partie3.php');
			require_once('./fonctions_accueil.php');
		?>
		<?php getadv(); ?>
		<h1>Il semblerait que <?php echo $pseudo_adv; ?> n'ai pas encore constitué sa flotte<br/>Patience matelot !</h1>
			<?php
				CreationGrilleadv();
				GrilleValidable();
				if($partie_2)
				{
					header("Location: ./partie2.php");
				}
			?>
			<div id="boiteconsignes">
				<form method='POST' action='./accueil.php'>
					<input id="valider_pos" name="cliquevalider" type="Submit" value="Retourner à l'accueil"/>
				</form>
			</div>
			<table id="tab_contacts">
					<th id="th_contact">Contacts</th>
					<tr id="marge_avant_contacts"></tr>
					<?php
						getamis(); 
					?>
			</table>
			<div id="boitegrilles"> <!-- div de la grille perso et ennemie-->
				<?php
					CreationGrilleperso();
					GrillePersoHTML();
				?>
			</div>
	</body>
</html>
