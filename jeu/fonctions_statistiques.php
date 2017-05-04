<?php
	/*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
	//Fonction de récupération des stats
	function get_statistiques(){
		global $connexion;
		$pseudo_joueur = $_SESSION['pseudo_joueur'];
		$id_joueur = $_SESSION['id_joueur'];

		$sql = "SELECT COUNT(Id_Partie) AS nb FROM Partie WHERE (Id_Invite = $id_joueur OR Id_Initiateur = $id_joueur) AND Id_Etat = 2";
		$resultat = mysqli_query($connexion, $sql);
		$resultat_arr = mysqli_fetch_assoc($resultat);
		$parties_jouees = $resultat_arr["nb"];

		echo "Parties Jouées : " . $parties_jouees . "<br /><br />";

		$sql2 = "SELECT COUNT(Id_Partie) AS nb FROM Partie WHERE Id_Initiateur = $id_joueur";
		$resultat2 = mysqli_query($connexion, $sql2);
		$resultat2_arr = mysqli_fetch_assoc($resultat2);
		$parties_initiees = $resultat2_arr["nb"];

		echo "Parties Initiées : " . $parties_initiees . "<br /><br />";

		$sql3 = "SELECT COUNT(Id_Partie) AS nb FROM Partie WHERE Id_Gagnant = $id_joueur AND Id_Etat = 2";
		$resultat3 = mysqli_query($connexion, $sql3);
		$resultat3_arr = mysqli_fetch_assoc($resultat3);
		$parties_gagnees = $resultat3_arr["nb"];

		echo "Parties Gagnées : " . $parties_gagnees . "<br /><br />";

		if ($parties_jouees > 0){
			$pourcentage_victoires = $parties_gagnees / $parties_jouees;
		}else{
			$pourcentage_victoires = "N/A";
		}
		$parties_perdues = $parties_jouees - $parties_gagnees;

		echo "Parties Perdues : " . $parties_perdues . "<br /><br />";
		echo "Pourcentage de victoire : " . $pourcentage_victoires . "<br /><br />";
	}

?>

