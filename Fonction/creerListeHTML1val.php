<?php 
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php 
// ex : creerListeHTML($name,$tab)
// paramètres à saisir : 
	// $name : le nom de la liste
	// $tab : tableau contenant
		// le texte à afficher dans la liste pour l'utilisateur
function creerListeHTML1val($name,$tab,$val)
{	
	echo "<select name =" . $name . ">";
	echo PHP_EOL; // crée un retour de ligne dans le code HTML, utile en debogage / à tester en l'oubliant !
	for ($i=0; $i < count($tab); $i++)					
	{
        if ($tab[$i]==$val){
            echo "<option value = '" .$tab[$i] .  "'selected>" . $tab[$i] ." </option> ";
        }
        else {
            echo "<option value = '" .$tab[$i] .  "'>" . $tab[$i] ." </option> ";
        }
		
		echo PHP_EOL;
	}
	echo "</select>";
}	



?>