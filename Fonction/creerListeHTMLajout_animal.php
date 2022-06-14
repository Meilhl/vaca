<?php 
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php 
// ex : creerListeHTML($name,$tab)
// paramètres à saisir : 
	// $name : le nom de la liste
	// $tab : tableau à 2 colonnes contenant : 
		// le value (l'identifiant pour le système)
		// le texte à afficher dans la liste pour l'utilisateur
function creerListeHTML($name,$tab)
{	
	echo "<select name =" . $name . " style='width:300px'>";
	echo PHP_EOL; // crée un retour de ligne dans le code HTML, utile en debogage / à tester en l'oubliant !
	for ($i=0; $i < count($tab); $i++)					
	{
		echo "<option value = '" .$tab[$i][0] .  "'>" . $tab[$i][1] ." </option> ";
		
		echo PHP_EOL;
	}
	echo "</select>";
}	



?>
