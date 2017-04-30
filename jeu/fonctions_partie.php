<?php
	/*$id_joueur = $_SESSION["id_joueur"];
	$id_partie = $_SESSION["id_partie"];
	$connexion = $_SESSION['connexion'];*/

	function getGrilleperso()
	{
		/*global $id_joueur;
		global $connexion;
		global $id_partie;
		
		$sql = "SELECT j.Pseudo AS Pseudo , Max(p.Date_Creation) AS Max_Date, p.Id_Etat AS Id_Etat FROM Joueur j JOIN Partie p ON j.Id_Joueur = p.Id_Initiateur OR j.Id_Joueur = p.Id_Invite WHERE j.Id_Joueur != $id_joueur AND (p.Id_Invite = $id_joueur OR p.Id_Initiateur = $id_joueur) GROUP BY p.Id_Etat, j.Pseudo, j.Date_Derniere_Co ORDER BY p.Id_Etat";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}*/

		echo "<table id=GrillePerso>";

		for( $chiffre = 0; $chiffre <= 10; $chiffre++)
		{
			echo "<tr>";

			for( $lettre = 0; $lettre <= 10; $lettre++)
			{
				if($chiffre == 0 && $lettre == 0)
				{
					echo "<td></td>";
				}
				else if($chiffre == 0)
				{
					switch ($lettre)
					{
						case 1 :
							echo "<td id=CaseLeg>".A."</td>";
							break;
						case 2 :
							echo "<td id=CaseLeg>".B."</td>";
							break;
						case 3 :
							echo "<td id=CaseLeg>".C."</td>";
							break;
						case 4 :
							echo "<td id=CaseLeg>".D."</td>";
							break;
						case 5 :
							echo "<td id=CaseLeg>".E."</td>";
							break;
						case 6 :
							echo "<td id=CaseLeg>".F."</td>";
							break;
						case 7 :
							echo "<td id=CaseLeg>".G."</td>";
							break;
						case 8 :
							echo "<td id=CaseLeg>".H."</td>";
							break;
						case 9 :
							echo "<td id=CaseLeg>".I."</td>";
							break;
						case 10 :
							echo "<td id=CaseLeg>".J."</td>";
							break;

					}
				}
				else if($lettre == 0)
				{
					echo "<td id=CaseLeg>".$chiffre."</td>";
				}
				else
				{
					echo "<td id=CaseEau></td>";
				}
			}
			echo "</tr>";
		}

		echo "</table>";


		/*while($data = mysqli_fetch_assoc($result))
		{
			$pseudo_data = $data['Pseudo'];
			$id_etat_data = $data['Id_Etat'];
			$max_date_data = $data['Max_Date'];

			echo '<tr id="contact">';
			echo '   <td id="Pseudo_contact">'.$pseudo_data.'</td>';

			//fonction test d'inactivité #DemanderAPapa
			echo '   <td id="contact-online" ></td>';
			//echo '   <td id="contact-offline" ></td>';
			echo '</tr>';
			echo '<tr>';
			echo '   <td id="contact_last_game">';
			if ($id_etat_data == 0)
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
		}*/
	}



?>
