<?php
	require_once('./fonctions.php');
	if(isset($_POST["pseudoJoueur"]) && isset($_POST["motDePasse"]))
	{
		connexion_bd();
		connexion_site($_POST['pseudoJoueur'], $_POST['motDePasse']);
		global $est_connecte;
		global $pseudo_joueur;
		echo $pseudo_joueur . "\n" . $est_connecte;
	}
	else{echo "abazut";}

	
?>
