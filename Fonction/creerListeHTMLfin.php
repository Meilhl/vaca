<?php 
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php 
// ex : creerListeHTML($name,$tab)
// paramètres à saisir : 
	// $name : le nom de la liste
	// $tab : tableau à 2 colonnes contenant : 
		// le value (l'identifiant pour le système)
		// le texte à afficher dans la liste pour l'utilisateur
function creerListeHTMLfin($name,$tab,$nbcol,$nblign, $val)
{	
	echo "<select name =" . $name . ">";
	echo PHP_EOL; // crée un retour de ligne dans le code HTML, utile en debogage / à tester en l'oubliant !
	echo "<option value = 'NULL'>";	
	for ($i=0; $i < $nblign; $i++)				//boucle parcourant chaque colonne du recordset, 
		{
			echo '<option value = "' .$tab[$i][0] .'">';
			for ($j=1; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
			{
				if ($tab[$i][$j]!='')
				{
					echo $tab[$i][$j].' | ' ;
				}

				
					
			}
			echo "</option>";
			
		}
	echo "</select>";
}	



?>
