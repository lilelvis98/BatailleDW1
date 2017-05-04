<?php
	/*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
	$id_joueur = $_SESSION["id_joueur"];
	$connexion = $_SESSION['connexion'];

	function getamis()
	{
		global $id_joueur;
		global $connexion;
		
		$sql = "SELECT DISTINCT j.Online AS online, j.Pseudo AS Pseudo , Max(p.Date_Creation) AS Max_Date, p.Id_Etat AS Id_Etat FROM Joueur j JOIN Partie p ON j.Id_Joueur = p.Id_Initiateur OR j.Id_Joueur = p.Id_Invite WHERE j.Id_Joueur != $id_joueur AND (p.Id_Invite = $id_joueur OR p.Id_Initiateur = $id_joueur) GROUP BY p.Id_Etat, j.Pseudo, j.Online ORDER BY p.Id_Etat";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		while($data = mysqli_fetch_assoc($result))
		{
			$pseudo_data = $data['Pseudo'];	
			$id_etat_data = $data['Id_Etat'];
			$max_date_data = $data['Max_Date'];
			$online_data = $data['online'];

			echo '<tr id="contact">';
			echo '   <td id="Pseudo_contact">'.$pseudo_data.'</td>';

			if($online_data)
			{
				echo '   <td id="contact-online" ></td>';
			}
			else
			{
				echo '   <td id="contact-offline" ></td>';
			}
			echo '</tr>';
			echo '<tr>';
			echo '   <td id="contact_last_game">';
			if ($id_etat_data == 0 or $id_etat_data == 3 or $id_etat_data == 4)
			{
				echo "Partie en cours, débutée le ".$max_date_data;
			}
			else if ($id_etat_data == 1)
			{
				echo "En Attente depuis le ".$max_date_data;
			}
			else
			{
				echo "Aucune partie, dernière commencée le ".$max_date_data;
			}
			echo '   </td>';
			echo '</tr>';
		}
	}



?>
