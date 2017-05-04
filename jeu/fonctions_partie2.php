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

	$tirsperso = array("0","0","0","0","0","0","0","0","0","0",
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

	$tirsadv = array("0","0","0","0","0","0","0","0","0","0",
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

	function Creationtirsperso() //Création de la grille contenant les différents tirs effectués par le joueur
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;
		global $grilleperso;
		global $tirsperso;
		
		for ( $i = 1; $i <= 5; $i++)
		{
			$sql = "SELECT tir.Coord_X AS X, tir.Coord_Y AS Y FROM Tir tir NATURAL JOIN Tour tr WHERE tr.Id_Partie = $id_partie AND tr.Id_Joueur = $id_joueur";
			$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête de récupération des tirs <br/>";
			}

			while($data = mysqli_fetch_assoc($result)) //Découpage du résultat
			{
				$X = $data['X'];
				$Y = $data['Y'];
				$case = ($Y - 1)*10 + $X;
				$tirsperso[$case] = 1;
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

	function Creationtirsadv() //Création de la grille contenant les différents tirs effectués par son adversaire
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;
		global $grilleperso;
		global $tirsadv;
		
		for ( $i = 1; $i <= 5; $i++)
		{
			$sql = "SELECT tir.Coord_X AS X, tir.Coord_Y AS Y FROM Tir tir NATURAL JOIN Tour tr WHERE tr.Id_Partie = $id_partie AND tr.Id_Joueur != $id_joueur";
			$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête de récupération des tirs <br/>";
			}

			while($data = mysqli_fetch_assoc($result)) //Découpage du résultat
			{
				$X = $data['X'];
				$Y = $data['Y'];
				$tirsadv[($Y - 1)*10 + $X] = 1;
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
			echo "Erreur : Impossible de faire cette requête : ".$sql;
		}
	}

	function GrillePersoHTML()
	{
		global $grilleperso;
		global $tirsadv;
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
				else if ($grilleperso[$case] != 0 and $tirsadv[$case] != 0)
				{
					echo "<td id=CaseBateauTouche>".$grilleperso[$case]."</td>";
				}
				else if ($grilleperso[$case] != 0)
				{
					echo "<td id=CaseBateau>".$grilleperso[$case]."</td>";
				}
				else if ($tirsadv[$case] != 0)
				{				
					echo "<td id=CaseEauTouche>T</td>";
				}
				else
				{				
					echo "<td id=CaseEauTouche></td>";
				}
			}
			echo "</tr>";
		}

		echo "</table>";
	}

	function GrilleAdvHTML()
	{
		global $grilleadv;
		global $tirsperso;
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
				else if ($grilleadv[$case] != 0 and $tirsperso[$case] != 0)
				{
					echo "<td id=CaseBateauTouche></td>";
				}
				else if ($tirsperso[$case] != 0)
				{				
					echo "<td id=CaseEauTouche></td>";
				}
				else
				{				
					echo "<td id=CaseInconnue></td>";
				}
			}
			echo "</tr>";
		}

		echo "</table>";
	}



?>


