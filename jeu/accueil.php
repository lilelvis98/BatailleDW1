<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="css/style_normal.css">

		<title>La Bataille Navale</title>
	</head>

	<body>
		<?php session_start(); ?>
		<h1>Bienvenue, <?php echo $_SESSION['pseudo_joueur'];?> !</h1>
		<div>
				<button id="acceuil_jouer" type="submit" value="JOUER"/>
		</div>
		<div>
				<button id="accueil_stat" type="submit" value="STATISTIQUES"/>
		</div>
	</body>
</html>
