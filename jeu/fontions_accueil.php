<?php
	session_start();	
	$connexion = $_SESSION['connexion'];
	$id_joueur = $_SESSION['id_joueur'];

	function getamis()
	{
			
		$sql = "SELECT j.Date_Derniere_Co AS Co, j.Pseudo AS Pseudo, Max(p.Date_Creation) AS Max_Date, p.Id_Etat AS Id_Etat FROM Joueur j JOIN Partie p ON j.Id_Joueur = p.Id_Initiateur OR j.Id_Joueur = p.Id_Invite WHERE j.Id_Joueur != $id_joueur AND (p.Id_Invite = $id_joueur OR p.Id_Initiateur = $id_joueur) GROUP BY j.Pseudo ORDER BY p.Id_Etat;"
		$resultat = $connexion->query($sql);

		while($data = mysql_fetch_array($resultat))
		{
			echo '<tr id="contact">';
			echo '   <td id="Pseudo_contact">$data['Pseudo']</td>';

			//fonction test d'innactivité #DemanderAPapa
			echo '   <td id="contact-online" ></td>';
			//echo '   <td id="contact-offline" ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '   <td id="contact_last_game">';
			if (Id_Etat == 0)
			{
				echo 'Partie en cours, débutée le $data['Max_Date']';
			}
			else if (Id_Etat == 1)
			{
				echo 'En Attente depuis le $data['Max_Date']';
			}
			else
			{
				echo 'Aucune partie, dernière commencée le $data['Max_Date']';
			}
			echo '   </td>';
			echo '</tr>';
		}
	}



?>
