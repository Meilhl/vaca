<?php 

//PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php 
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t : tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre
    // $id : id à donner au tableau
    //$col_doc:indice colonne pour lien 
    //$doc:tableau avec lien et nom

    
    
function creerTabHTMLAnimauxEleveur($tab,$nbcol,$nblig,$t,$id,$col_doc,$doc)
{
	// début du tableau d'id entré en paramètre
    echo "<TABLE ID='".$id."' BORDER = 1>";				
	
    // on teste l'existence de $t ie est-ce qu'on a choisi des titres 
	if (isset($t)==TRUE)							
	{
		// crée l'en-tête du tableau avce les noms des champs de la requête
        echo "<THEAD>";								
		echo "<TR>";
		// boucle parcourant chaque colonne du recordset
        for ($j=0; $j < $nbcol; $j++)				 
		{
                // affichage de la ligne d'entête
                echo "<TH>" . $t[0][$j] . "</TH>";
                
		} 
        
		echo "</TR>";
		echo "</THEAD>";
	}
	
	// crée le corps du tableau
    echo "<TBODY>";									
		//boucle parcourant chaque ligne du recordset
        for ($i=0; $i < $nblig; $i++)				 
		{
			echo ("<TR>");
			
            //boucle parcourant chaque colonne du recordset
            for ($j=0; $j < $nbcol; $j++)			
			{

                //cases qui contiendront un lien
                
                for ($ind=0 ; $ind < count($col_doc) ; $ind++) 
                {
                    
                    if ($j == $col_doc[$ind]) 
                    {                        
                        $etat = 'case lien' ;
                    }
                    else
                    {
                        $etat = 'case normale' ;
                    }                        
                }
                
                
                switch ($etat)
                {
                    
                    case 'case normale':
                    
                            echo "<TD>" . $tab[$i][$j]  . "</TD>";	// affichage des valeurs du tableau
                
                        break;
                        
                    case 'case lien':
                    
                        echo '<td class="lien"> ';
                            
                            for ($k=0; $k<count($doc);$k++)
                            {
                                if ($doc[$k][0]==$tab[$i][0])
                                {
                                    echo '<a href="'.$doc[$k][1].'"> '.$doc[$k][2].'</a><br>';
                                }
                            }
                        echo '</td>';
                        break;
                }    
                    
                    
            }
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE>";
    
}

?>