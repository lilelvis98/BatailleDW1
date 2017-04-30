<?php
	$id_joueur = $_SESSION["id_joueur"];
	$id_partie = $_SESSION["id_partie"];
	$connexion = $_SESSION["connexion"];

	function getGrilleperso()
	{
		global $id_joueur;
		global $connexion;
		global $id_partie;

		//Porte-avion
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM b Bateau NATURAL JOIN n Type_Navire WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Type_Navire = 0";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result) //Découpage du résultat
		$Nb_cases_0 = 0;
		$X_0 = $data['X'];
		$Y_0 = $data['Y'];
		$Orientation_0 = $data['Orientation'];

		//Croiseur
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM b Bateau NATURAL JOIN n Type_Navire WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Type_Navire = 1";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result) //Découpage du résultat
		$Nb_cases_1 = 0;
		$X_1 = $data['X'];
		$Y_1 = $data['Y'];
		$Orientation_1 = $data['Orientation'];

		//Destroyeur
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM b Bateau NATURAL JOIN n Type_Navire WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Type_Navire = 2";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result) //Découpage du résultat
		$Nb_cases_2 = 0;
		$X_2 = $data['X'];
		$Y_2 = $data['Y'];
		$Orientation_2 = $data['Orientation'];

		//Sous_marin
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM b Bateau NATURAL JOIN n Type_Navire WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Type_Navire = 3";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result) //Découpage du résultat
		$Nb_cases_3 = 0;
		$X_3 = $data['X'];
		$Y_3 = $data['Y'];
		$Orientation_3 = $data['Orientation'];

		//Torpilleur
		$sql = "SELECT b.Coord_X AS X, b.Coord_Y AS Y, b.Bool_Orientation AS Orientation FROM b Bateau NATURAL JOIN n Type_Navire WHERE b.Id_Partie != $id_partie AND b.Id_Joueur = $id_joueur AND b.Type_Navire = 4";

		$result = $connexion->query($sql) or die("echec critique2 <br/>".mysqli_error());

		if($result == FALSE) // échec si FALSE
		{
			echo "Échec de la requête6 <br/>";
		}

		$data = mysqli_fetch_assoc($result) //Découpage du résultat
		$Nb_cases_4 = 0;
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
