<?php
	/*-----LOPEZ-ROSTAIN ROMAIN 11507001 VILLERMET QUENTIN 11507338-----*/
	$id_joueur = $_SESSION["id_joueur"];
	$id_partie = $_SESSION["id_partie"];
	$connexion = $_SESSION['connexion'];
	$gagnant = "BarbeRousse";
	$pseudo_adv = "BarbeRousse";
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

	function getActionTour()
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;
		global $pseudo_adv;
		global $gagnant;

		$sql = "SELECT DISTINCT tou.Id_Joueur AS joueur FROM Tour tou WHERE tou.Id_Tour = (SELECT Max(Id_Tour) FROM Tour WHERE Id_Partie = $id_partie)";
		$resultat = mysqli_query($connexion, $sql);
		if ($resultat == FALSE)
		{
			echo "Erreur : Impossible de faire cette requête : ".$sql;
		}
		else
		{
			if($gagnant != "BarbeRousse")
			{
				$joueur = $_SESSION['pseudo_joueur'];				
				if($gagnant == $joueur)
				{
					echo '<div id="boiteTourPerso">
							Par la barbe de BarbeRousse ! Vous avez détruit toute la flotte de '.$pseudo_adv.' !<br/><br/>';
					echo '<form method=\'POST\' action=\'./accueil.php\'>
								<input id="valider_pos" name="cliquevalider" type="Submit" value="Retourner à l\'accueil ?"/>
							</form></div>';
				}
				else
				{
					echo '<div id="boiteTourAdv">
							Votre flotte entière a été détruite sous les canons du pirate '.$pseudo_adv.' !<br/><br/>';
					echo '<form method=\'POST\' action=\'./accueil.php\'>
								<input id="valider_pos" name="cliquevalider" type="Submit" value="Retourner à l\'accueil ?"/>
							</form></div>';
				}
			}
			else
			{
				$data = mysqli_fetch_assoc($resultat);	
				if ($data['joueur'] == $id_joueur)
				{
					echo '<div id="boiteTourPerso">
						<form method="POST" action="./partie2.php">
							Capitaine, quels sont vos ordres de tir ? <br/><br/>
							<select name="lettre">
							  <option value="1">A</option>
							  <option value="2">B</option>
							  <option value="3">C</option>
							  <option value="4">D</option>
							  <option value="5">E</option>
							  <option value="6">F</option>
							  <option value="7">G</option>
							  <option value="8">H</option>
							  <option value="9">I</option>
							  <option value="10">J</option>
							</select>
							<select name="chiffre">
							  <option value="1">1</option>
							  <option value="2">2</option>
							  <option value="3">3</option>
							  <option value="4">4</option>
							  <option value="5">5</option>
							  <option value="6">6</option>
							  <option value="7">7</option>
							  <option value="8">8</option>
							  <option value="9">9</option>
							  <option value="10">10</option>
							</select>
							<br/>
							<br/>
							<input id="valider_tir" name="cliquevalider" type="Submit" value="Feu !!!"/>
						</form>';
					if(isset($_POST['lettre']) and isset($_POST['chiffre']))
					{
						FinTour($_POST['lettre'], $_POST['chiffre']);
					}
					echo '</div>';
				
				}
				else
				{
					echo '<div id="boiteTourAdv">
							Tous aux abris, '.$pseudo_adv.' vous canarde !<br/><br/>
							<form method=\'POST\' action=\'./accueil.php\'>
								<input id="valider_pos" name="cliquevalider" type="Submit" value="Retourner à l\'accueil"/>
							</form>
						</div>';
				}
			}	
		}
	}

	function getadv()
	{
		global $connexion;
		global $id_partie;
		global $id_joueur;
		global $pseudo_adv;

		$sql = "SELECT j.Pseudo AS pseudo FROM Joueur j JOIN Partie p ON p.Id_Initiateur = j.Id_Joueur OR p.Id_Invite = j.Id_Joueur WHERE j.Id_Joueur != $id_joueur AND p.Id_Partie = $id_partie";
		$result = $connexion->query($sql) or die("echec requete : ".$sql);

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

	function FinTour($lettre, $chiffre)
	{
		global $connexion;
		global $id_partie;
		global $id_joueur;
		global $tirsperso;

		if($tirsperso[($chiffre - 1)*10 + $lettre] != 0)
		{
			echo "<br/>Vous avez déjà tiré ici Marin d'eaux douces !";
		}
		else
		{
			$sql = "SELECT Max(Id_Tour) AS Dern_Tour FROM Tour WHERE Id_Partie = $id_partie"; //Selectionne le dernier tour de la partie
			$result = $connexion->query($sql) or die("echec requete : ".$sql);
			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête : ".$sql;
			}
			$data = mysqli_fetch_assoc($result);
			$dern_tour = $data['Dern_Tour'];

			$sql = "INSERT INTO Tir(Id_Tour, Coord_X, Coord_Y, Bool_Touche) VALUES ($dern_tour, $lettre, $chiffre, 0)";
			$result = $connexion->query($sql) or die("echec requete : ".$sql);
			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête : $sql <br/>";
			}

			//Test de victoire

			$sql = "SELECT Max(Id_Tour) AS max_id_tour FROM Tour";
			$result = $connexion->query($sql);
			$data = mysqli_fetch_assoc($result);
			$nouveau_tour = $data['max_id_tour'] + 1;
			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête : $sql <br/>";
			}

			$sql = "SELECT j.Id_Joueur AS id_adv FROM Joueur j JOIN Partie p ON p.Id_Initiateur = j.Id_Joueur OR p.Id_Invite = j.Id_Joueur WHERE j.Id_Joueur != $id_joueur AND p.Id_Partie = $id_partie";
			$result = $connexion->query($sql) or die("echec requete : ".$sql);
			$data = mysqli_fetch_assoc($result);
			$Id_Adversaire = $data['id_adv'];

			$sql = "INSERT INTO Tour(Id_Partie, Id_Tour, Id_Joueur, Id_Carte) VALUES ($id_partie, $nouveau_tour, $Id_Adversaire, 0)";
			$result = $connexion->query($sql) or die("echec requete : ".$sql);
			if($result == FALSE) // échec si FALSE
			{
				echo "Échec de la requête : $sql <br/>";
			}
		}
	}

	function FinJeu()
	{
		global $connexion;
		global $id_partie;
		global $gagnant;
		global $pseudo_adv;
		global $grilleadv;
		global $grilleperso;
		global $tirsperso;
		global $tirsadv;

		$PersoGagne = 17;
		$AdvGagne = 17;
		
		for($i = 1; $i <= 10; $i++)
		{
			for($j = 1; $j <= 10; $j++)
			{
				$case=($i - 1)*10 + $j;
				if($grilleadv[$case] != 0 and $tirsperso[$case] != 0)
				{
					$PersoGagne--;
				}
				if($grilleperso[$case] != 0 and $tirsadv[$case] != 0)
				{
					$AdvGagne--;
				}
			}
		}

		if($PersoGagne == 0)
		{
			$gagnant = $_SESSION['pseudo_joueur'];
		}
		else if ($AdvGagne == 0)
		{
			$gagnant = $pseudo_adv;
			$sql = "UPDATE Partie SET Id_Etat = 2 WHERE Id_Partie = $id_partie";
			$resultat = mysqli_query($connexion, $sql);
			if ($resultat == FALSE)
			{
				echo "Erreur : Impossible de continuer la partie : ".$sql;
			}
		}
	}


?>


