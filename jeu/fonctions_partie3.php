<?php
	/*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
	$id_joueur = $_SESSION["id_joueur"];
	$id_partie = $_SESSION["id_partie"];
	$connexion = $_SESSION['connexion'];
	$partie_2 = false;
	$grilleperso = array("0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0");

	$grilleadv = array("0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0");

	$pseudo_adv = "BarbeRousse";


	function CreationGrilleperso()
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;
		global $grilleperso;
		
		for ( $i = 1; $i <= 5; $i++)
		{
			$sql = "SELECT n.Nb_Cases AS Nb_Cases, b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie = $id_partie AND b.Id_Joueur = $id_joueur AND b.Id_Type_Navire = ($i - 1)";

			$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête6 <br/>";
			}

			$data = mysqli_fetch_assoc($result); //Découpage du résultat
			$Nb_cases = $data['Nb_Cases'];
			$X = $data['X'];
			$Y = $data['Y'];
			$Orientation = $data['Orientation'];
			for ($Nb_cases = $data['Nb_Cases']; $Nb_cases != 0; $Nb_cases--)
			{
				if($X != NULL)
				{
					$grilleperso[($Y - 1)*10 + $X]=$i;
				}

				if ($Orientation == true)
				{
					$X++;
				}
				else
				{
					$Y++;
				}
			}
		}
	}

	function CreationGrilleadv()
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;
		global $grilleadv;
		
		for ( $i = 1; $i <= 5; $i++)
		{
			$sql = "SELECT n.Nb_Cases AS Nb_Cases, b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie = $id_partie AND b.Id_Joueur != $id_joueur AND b.Id_Type_Navire = ($i - 1)";

			$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête6 <br/>";
			}

			$data = mysqli_fetch_assoc($result); //Découpage du résultat
			$Nb_cases = $data['Nb_Cases'];
			$X = $data['X'];
			$Y = $data['Y'];
			$Orientation = $data['Orientation'];
			for ($Nb_cases = $data['Nb_Cases']; $Nb_cases != 0; $Nb_cases--)
			{
				if($X != NULL)
				{
					$grilleadv[($Y - 1)*10 + $X]=$i;
				}

				if ($Orientation == true)
				{
					$X++;
				}
				else
				{
					$Y++;
				}
			}
		}
	}
	
	function GrillePersoHTML()
	{
		global $grilleperso;
		echo "<table id=GrillePerso>";

		for( $chiffre = 0; $chiffre <= 10; $chiffre++)
		{
			echo "<tr>";

			for( $lettre = 0; $lettre <= 10; $lettre++)
			{
				$case=($chiffre - 1)*10 + $lettre;

				if($chiffre == 0 && $lettre == 0)
				{
					echo "<td></td>";
				}
				else if($chiffre == 0)
				{
					switch ($lettre)
					{
						case 1 :
							echo "<td id=CaseLeg>A</td>";
							break;
						case 2 :
							echo "<td id=CaseLeg>B</td>";
							break;
						case 3 :
							echo "<td id=CaseLeg>C</td>";
							break;
						case 4 :
							echo "<td id=CaseLeg>D</td>";
							break;
						case 5 :
							echo "<td id=CaseLeg>E</td>";
							break;
						case 6 :
							echo "<td id=CaseLeg>F</td>";
							break;
						case 7 :
							echo "<td id=CaseLeg>G</td>";
							break;
						case 8 :
							echo "<td id=CaseLeg>H</td>";
							break;
						case 9 :
							echo "<td id=CaseLeg>I</td>";
							break;
						case 10 :
							echo "<td id=CaseLeg>J</td>";
							break;
					}
				}
				else if($lettre == 0)
				{
					echo "<td id=CaseLeg>".$chiffre."</td>";
				}
				else if ($grilleperso[$case] != 0)
				{
					echo "<td id=CaseBateau>".$grilleperso[$case]."</td>";
				}
				else
				{				
					echo "<td id=CaseEau></td>";
				}
			}
			echo "</tr>";
		}

		echo "</table>";
	}

	function getadv()
	{
		global $connexion;
		global $id_partie;
		global $id_joueur;
		global $pseudo_adv;

		$sql = "SELECT j.Pseudo AS pseudo FROM Joueur j JOIN Partie p ON p.Id_Initiateur = j.Id_Joueur OR p.Id_Invite = j.Id_Joueur WHERE j.Id_Joueur != $id_joueur AND p.Id_Partie = $id_partie";
		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		$data = mysqli_fetch_assoc($result);

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}
		else
		{
			$pseudo_adv = $data['pseudo'];
		}
	}

	function GrilleValidable()
	{
		global $grilleadv;
		global $partie_2;
		global $connexion;
		global $id_partie;

		$nb_1 = 5;
		$nb_2 = 4;
		$nb_3 = 3;
		$nb_4 = 3;
		$nb_5 = 2;
		
		for( $chiffre = 1; $chiffre <= 10; $chiffre++)
		{
			for( $lettre = 1; $lettre <= 10; $lettre++)
			{
				$case=($chiffre - 1)*10 + $lettre;
				switch ($grilleadv[$case])
				{
					case 1 :
						$nb_1--;
						break;

					case 2 :
						$nb_2--;
						break;

					case 3 :
						$nb_3--;
						break;

					case 4 :
						$nb_4--;
						break;

					case 5 :
						$nb_5--;
						break;
				}
			}
		}

		if($nb_1 == 0 && $nb_2 == 0 && $nb_3 == 0 && $nb_4 == 0 && $nb_5 == 0)
		{
			$sql = "UPDATE Partie SET Id_Etat = 4 WHERE Id_Partie = $id_partie";
			$resultat = mysqli_query($connexion, $sql);
			if ($resultat == FALSE)
			{
				echo "Erreur : Impossible de continuer la partie : ".$sql;
			}
			else
			{
				$partie_2 = true;

				$sql = "SELECT Id_Invite FROM Partie WHERE Id_Partie = $id_partie";
				$result = $connexion->query($sql) or die("echec requete : ".$sql);
				$data = mysqli_fetch_assoc($result);
				$id_invite = $data['Id_Invite'];

				$sql = "INSERT INTO Tour(Id_Partie, Id_Tour, Id_Joueur, Id_Carte) VALUES ($id_partie, 1, $id_invite, 0)";
				$result = $connexion->query($sql) or die("echec requete : ".$sql);
				if($result == FALSE) // échec si FALSE
				{
					echo "Échec de la requête : $sql <br/>";
				}
			}
		}
	}

?>


