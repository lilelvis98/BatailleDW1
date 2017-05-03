<?php
	$id_joueur = $_SESSION["id_joueur"];
	$id_partie = $_SESSION["id_partie"];
	$connexion = $_SESSION['connexion'];
	$grille = array("0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0",
					"0","0","0","0","0","0","0","0","0","0");

	function CreationGrilleperso()
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;
		global $grille;
		
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
				$grille[($Y - 1)*10 + $X]=$i;
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

	function AjouterBateau($bateau, $orientation, $lettre, $chiffre)
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;

		$sql = "UPDATE Bateau SET Coord_X = $lettre, Coord_Y = $chiffre,  Bool_Orientation = $orientation WHERE Id_Joueur = $id_joueur AND Id_Partie = $id_partie AND Id_Type_Navire = $bateau";
		$resultat = mysqli_query($connexion, $sql);
		if ($resultat == FALSE)
		{
			echo "Dommage Fromage";
		}
		else
		{
			echo $sql;
		}
	}


	function GrillePersoHTML()
	{
		global $grille;
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
				else if ($grille[$case] != 0)
				{
					echo "<td id=CaseBateau>".$grille[$case]."</td>";
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


