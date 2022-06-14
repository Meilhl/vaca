<?php 

//PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php 
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t : tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre
    // $id : id à donner au tableau
    // $col_case : liste des indices de colonnes qui contiendront des cases à cocher   --> en cours   --> connecter à la base de données pour modification
    //$link : line pour BDD
    //$table_bdd : Nom de table ou modif les enregistrements dans bdd
    //$col_doc:indice colonne pour lien 
    //$doc:tableau avec lien et nom
    //$page_modif : page a renvouyer pour modif
    //$col_exploit : colonne exloit pour avoir info lorsque hover
    //$info_exploit : info a afficher pour exploit
    //$col_info : nombre de colonne de table info
    
    
function creerTabHTMLrecap($tab,$nbcol,$nblig,$t,$id,$col_case,$link,$table_bdd,$col_doc,$doc,$page_modif,$col_exploit,$info_exploit,$col_info)
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
        for ($j=0; $j <= $nbcol; $j++)				 
		{
             if ($j==$nbcol) { 
                echo"<th>Modifier</th>";
             
             }
             else{
                // affichage de la ligne d'entête
                echo "<TH>" . $t[0][$j] . "</TH>";
                 }
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
            for ($j=0; $j <= $nbcol; $j++)			
			{
                if ($j==$nbcol) { 
                    echo '<TD>' ;
                    
                        echo '<a href="'.$page_modif.'?id='.$tab[$i][0].'">Modifier</a>';
                        
                    echo '</TD>' ;
                }
                else {
                
                $etat = 'case normale' ;
                
                for ($ind=0 ; $ind < count($col_case) ; $ind++) {
                    
                    if ($j == $col_case[$ind]) {                        
                        
                        if ($tab[$i][$j] == 1) 
                            $etat = 'checked' ;
                            $value = 1 ;
                        if ($tab[$i][$j] == 0)
                            $etat = '' ;
                            $value = 0 ;
                    }
                }
                
                for ($ind=0 ; $ind < count($col_doc) ; $ind++) {
                    
                    if ($j == $col_doc[$ind]) {                        
                        $etat = 'case lien' ;
                    }
                }
                
                
                switch ($etat){
                    
                    case 'case normale':
                    
                        if($j==$col_exploit){
                            
                            echo "<TD class='dropdown'>" . $tab[$i][$j] ;
                            echo '<div class="info">';
                            for ($l=0;$l<count($info_exploit);$l++){
                                if($info_exploit[$l][0]==$tab[$i][$col_exploit]){
                                    for($m=0;$m<$col_info;$m++){
                                        echo $info_exploit[$l][$m].'<br>';
                                    }
                                }
                            }
                            echo '</div></td>';
                        }
                        else {
                            echo "<TD>" . $tab[$i][$j]  . "</TD>";	// affichage des valeurs du tableau
                        }
                        break;
                    
                    case'checked':
                    
                        if (isset($_GET["maj"])) {
                            if (isset ($_GET["check".$i.$j])){
                                $valeur = $_GET["check".$i.$j] ;
                                $etat = 'checked' ;
                                $value = 1 ;
                            }
                            else{
                                $etat = '' ;
                                $value = 0 ;
                            }
                            
                            
                            $require = "UPDATE ".$table_bdd." SET " . $t[1][$j] . "=" . $value . ", " . $t[1][0] . "=" . $tab[$i][0] . " WHERE ". $t[1][0] . "=" . $tab[$i][0] ;
                            mysqli_query($link, $require) ;
                         }
                            
                         echo '<TD> <input type="checkbox" name="check'.$i.$j.'" value="1"' . $etat . '> </TD>' ;
                        break;
                    
                    case '':
                        if (isset($_GET["maj"])) {
                            if (isset ($_GET["check".$i.$j])){
                                $valeur = $_GET["check".$i.$j] ;
                                $etat = 'checked' ;
                                $value = 1 ;
                            }
                            else{
                                $etat = '' ;
                                $value = 0 ;
                            }
                            
                            
                            $require = "UPDATE ".$table_bdd." SET " . $t[1][$j] . "=" . $value . ", " . $t[1][0] . "=" . $tab[$i][0] . " WHERE ". $t[1][0] . "=" . $tab[$i][0] ;
                            mysqli_query($link, $require) ;
                         }
                            
                         echo '<TD> <input type="checkbox" name="check'.$i.$j.'" value="1"' . $etat . '> </TD>' ;
                        break;
                     
                    
                    case'case lien':
                        echo '<td class="lien"> ';
                            
                            for ($k=0; $k<count($doc);$k++){
                                if ($doc[$k][0]==$tab[$i][0]){
                                    echo '<a href="'.$doc[$k][1].'"> '.$doc[$k][2].'</a><br>';
                                }
                            }
                        echo '</td>';
                        break;
                    }
                    
                }    
            }
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE>";
    
}

?>