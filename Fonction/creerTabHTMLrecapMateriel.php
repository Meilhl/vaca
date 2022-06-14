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
    
    
function creerTabHTMLrecapMateriel($tab,$nbcol,$nblig,$t,$id,$col_case,$link,$table_bdd,$col_doc,$doc,$page_modif,$col_exploit,$info_exploit,$col_info,$page_suppr)
{
    
	// début du tableau d'id entré en paramètre
    echo "<TABLE ID='".$id."' BORDER = 1>";				
	
    // on teste l'existence de $t ie est-ce qu'on a choisi des titres 
	if (isset($t)==TRUE)							
	{
		// crée l'en-tête du tableau avce les noms des champs de la requête
        echo "<THEAD>";								
		echo "<TR>";
		// boucle parcourant chaque colonne du recordset (sans l'id = 1e colonne)
        for ($j=0; $j <= $nbcol; $j++)				 
		{
            // Pour la dernière colonne, le titre est "Actions"
            if ($j==$nbcol) { 
               echo"<th>Actions</th>";
             
            }
            else{
               // affichage de la ligne d'entête --> noms dans la première ligne du tableau $t
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
			
            //boucle parcourant chaque colonne du recordset (sans l'id = 1e colonne)
            for ($j=0; $j <= $nbcol; $j++)			
			{
                /* Pour la dernière colonne, sur chaque ligne, on met un lien vers la page de modification et vers
                celle de suppression */
                if ($j==$nbcol) { 
                    echo '<TD>' ;
                    
                        echo '<a href="'.$page_modif.'?id='.$tab[$i][0].'">Modifier</a>';
                        echo '<br>' ;
                        echo '<a href="'.$page_suppr.'?suppr=Ok&id='.$tab[$i][0].'&nom='.$tab[$i][2].'" onclick="return confirm('."'Voulez-vous vraiment supprimer ce matériel ?'".')">Supprimer</a>' ;
                        
                    echo '</TD>' ;
                }
                
                // Pour toutes les autres colonnes
                else {
                
                    // Par défaut, la case est "normale" ie juste du texte affiché
                    $etat = 'case normale' ;
                    
                    
                    // On parcourt la liste contenant les indices des colonnes qui doivent contenir des cases à cocher
                    for ($ind=0 ; $ind < count($col_case) ; $ind++) {
                        
                        // Si la colonne actuelle doit contenir une case :
                        if ($j == $col_case[$ind]) {                        
                            
                            // Si la BDD contient la valeur 1 pour la case actuelle :
                            if ($tab[$i][$j] == 1) {
                                // L'état de la case devient "checked"
                                $etat = 'checked' ;
                                // On initialise la variable $value à 1 (pour checked)
                                $value = 1 ;
                            }
                                
                            // Si la BDD contient la valeur 0 pour la case actuelle :
                            if ($tab[$i][$j] == 0) {
                                // L'état de la case devient ""
                                $etat = '' ;
                                // On initialise la variable $value à 0 (pour unchecked)
                                $value = 0 ;
                            }
                        }
                    }
                    
                    // On parcourt la liste contenant les indices des colonnes qui doivent contenir des liens pour documents
                    for ($ind=0 ; $ind < count($col_doc) ; $ind++) {
                        
                        // Si la colonne actuelle doit contenir un lien vers un doc :
                        if ($j == $col_doc[$ind]) {  
                            // L'état de la case devient "case lien"                    
                            $etat = 'case lien' ;
                        }
                    }
                    
                    
                    // Différentes situations selon l'état de la case 
                    switch ($etat){
                        
                        // 1er cas : la case est "normale"
                        case 'case normale':
                        
                            // Si la case doit contenir des infos sur l'exploit et le contact
                            if($j==$col_exploit){
                                
                                // Affichage lorsque l'on passe la souris sur la case 
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
                        
                        // 2eme cas : la case doit contenir une case à cocher et elle est cochée
                        case'checked':
                        
                            // Si on a appuyé sur le bouton de mise à jour
                            if (isset($_GET["maj"])) {
                                // Si la case était cochée
                                if (isset ($_GET["check".$i.$j])){
                                    $valeur = $_GET["check".$i.$j] ;
                                    $etat = 'checked' ;
                                    $value = 1 ;
                                }
                                // Sinon
                                else{
                                    $etat = '' ;
                                    $value = 0 ;
                                }
                                
                                // Requête SQL pour modifier la BDD : 1 si case cochée ou 0 sinon
                                $require = "UPDATE ".$table_bdd." SET " . $t[1][$j] . "=" . $value . ", " . $t[1][0] . "=" . $tab[$i][0] . " WHERE ". $t[1][0] . "=" . $tab[$i][0] ;
                                mysqli_query($link, $require) ;
                             }
                                
                            echo '<TD> <input type="checkbox" name="check'.$i.$j.'" value="1"' . $etat . '> </TD>' ;
                            break;
                        
                        // 3eme cas : la case doit contenir une case à cocher et elle est vide
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
                         
                        // 4eme cas : la case doit contenir un lien 
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