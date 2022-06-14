<?php 
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php 
// ex : creerListeHTML($name,$tab)
// paramètres à saisir : 
	// $name : le nom de la liste
	// $tab : tableau à 2 colonnes contenant : 
		// le value (l'identifiant pour le système)
		// le texte à afficher dans la liste pour l'utilisateur
function creerListeHTMLsex($name,$tab, $val)
{	
	echo "<select name =" . $name . ">";
	echo PHP_EOL; // crée un retour de ligne dans le code HTML, utile en debogage / à tester en l'oubliant !
	for ($i=0; $i <= count($tab); $i++)					
	{
		if ($tab[0][$i]==$val)
		{
			
			echo "<option value = '" .$tab[0][$i] .  "' selected>" . $tab[1][$i] ." </option> ";
		}
		
		else
		{
			echo "<option value = '" .$tab[0][$i] .  "'>" . $tab[1][$i] ." </option> ";
		
		}
		

		echo PHP_EOL;
	}
	echo "</select>";
}	



?>
