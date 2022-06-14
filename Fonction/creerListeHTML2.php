 <?php
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php
// ex : creerListeHTML($name,$tab)
// paramètres à saisir :
	// $name : le nom de la liste
	// $tab : tableau à 2 colonnes contenant :
		// le value (l'identifiant pour le système)
		// le texte à afficher dans la liste pour l'utilisateur
function creerListeHTML2($name,$tab, $val)
{
	echo "<select name =" . $name . ">";
	echo PHP_EOL; // crée un retour de ligne dans le code HTML
	for ($i=0; $i < count($tab); $i++)
	{
		if ($tab[$i][0]==$val)
		{

			echo "<option value = '" .$tab[$i][0] .  "' selected><p>" . $tab[$i][1] ."</p> </option> ";
		}

		else
		{
			echo "<option value = '" .$tab[$i][0] .  "'><p>" . $tab[$i][1] ." </p></option> ";

		}


		echo PHP_EOL;
	}
	echo "</select>";
}



?>
