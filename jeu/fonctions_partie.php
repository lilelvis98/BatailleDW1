<?php
	$id_joueur = $_SESSION["id_joueur"];
	$id_partie = $_SESSION["id_partie"];
	$connexion = $_SESSION['connexion'];

	function getGrilleperso()
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;

		//Porte-avion
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Id_Type_Navire = 0";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result); //Découpage du résultat
		$Nb_cases_0 = 5;
		$X_0 = $data['X'];
		$Y_0 = $data['Y'];
		$Orientation_0 = $data['Orientation'];

		//Croiseur
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Id_Type_Navire = 1";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result); //Découpage du résultat
		$Nb_cases_1 = 4;
		$X_1 = $data['X'];
		$Y_1 = $data['Y'];
		$Orientation_1 = $data['Orientation'];

		//Destroyeur
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Id_Type_Navire = 2";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result); //Découpage du résultat
		$Nb_cases_2 = 3;
		$X_2 = $data['X'];
		$Y_2 = $data['Y'];
		$Orientation_2 = $data['Orientation'];

		//Sous_marin
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Id_Type_Navire = 3";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result); //Découpage du résultat
		$Nb_cases_3 = 3;
		$X_3 = $data['X'];
		$Y_3 = $data['Y'];
		$Orientation_3 = $data['Orientation'];

		//Torpilleur
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM Bateau b NATURAL JOIN Type_Navire n WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Id_Type_Navire = 4";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result); //Découpage du résultat
		$Nb_cases_4 = 2;
		$X_4 = $data['X'];
		$Y_4 = $data['Y'];
		$Orientation_4 = $data['Orientation'];
		
		
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
				else if ($X_0 == $lettre && $Y_0 == $chiffre && $Nb_cases_0 != 0)
				{
					echo "<td id=CaseBateau>P-A</td>";
					if ($Orientation_0 == true)
					{
						$X_0++;
					}
					else
					{
						$Y_0++;
					}
					$Nb_cases_0--;
				}
				else if ($X_1 == $lettre && $Y_1 == $chiffre && $Nb_cases_1 != 0)
				{
					echo "<td id=CaseBateau>C</td>";
					if ($Orientation_1 == true)
					{
						$X_1++;
					}
					else
					{
						$Y_1++;
					}
					$Nb_cases_1--;
				}
				else if ($X_2 == $lettre && $Y_2 == $chiffre && $Nb_cases_2 != 0)
				{
					echo "<td id=CaseBateau>D</td>";
					if ($Orientation_2 == true)
					{
						$X_2++;
					}
					else
					{
						$Y_2++;
					}
					$Nb_cases_2--;
				}
				else if ($X_3 == $lettre && $Y_3 == $chiffre && $Nb_cases_3 != 0)
				{
					echo "<td id=CaseBateau>S</td>";
					if ($Orientation_3 == true)
					{
						$X_3++;
					}
					else
					{
						$Y_3++;
					}
					$Nb_cases_3--;
				}
				else if ($X_4 == $lettre && $Y_4 == $chiffre && $Nb_cases_4 != 0)
				{
					echo "<td id=CaseBateau>T</td>";
					if ($Orientation_4 == true)
					{
						$X_4++;
					}
					else
					{
						$Y_4++;
					}
					$Nb_cases_4--;
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



?>
