<?php
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php
// ex : creerListeHTML($name,$tab)
// paramètres à saisir :
	// $name : le nom de la liste
	// $tab : tableau à 2 colonnes contenant :
		// le value (l'identifiant pour le système)
		// le texte à afficher dans la liste pour l'utilisateur

    //$affiche: le nom du champ qu'on veut garder afficher
function creerListeHTML_leonie($name,$tab,$affiche)
{
	echo "<select name =" . $name . ">";
	echo PHP_EOL; // crée un retour de ligne dans le code HTML, utile en debogage / à tester en l'oubliant !
	for ($i=0; $i < count($tab); $i++)
	{
        if ($affiche==$tab[$i][0])
        {
            echo "<option value = '" .$tab[$i][0] .  "' selected>" . $tab[$i][1] ." </option> ";
        }
        else
        {
            echo "<option value = '" .$tab[$i][0] .  "'>" . $tab[$i][1] ." </option> ";
        }
		echo PHP_EOL;
	}
	echo "</select>";
}



?>
