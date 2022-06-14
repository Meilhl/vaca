<?php 
//PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php 
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre

function creerTabHTML($tab,$nbcol,$nblig,$t)
{
	echo "<CENTER><TABLE BORDER = 1>";				// début du tableau
	
	if (isset($t)==TRUE)							// on teste l'existence de $t
	{
		echo "<THEAD>";								// crée l'en-tête du tableau avce les noms des champs de la requête
		echo "<TR>";
		for ($i=0; $i < $nbcol; $i++)				// boucle parcourant chaque colonne du recordset, 
		{
			echo "<TH>" . $t[$i] . "</TH>";			// affichage de la ligne d'entête
		} 
		echo "</TR>";
		echo "</THEAD>";
	}
	
	echo "<TBODY>";									// crée le corps du tableau
		for ($i=0; $i < $nblig; $i++)				//boucle parcourant chaque ligne du recordset, 
		{
			echo ("<TR>");
			for ($j=0; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
			{
					echo "<TD>" . $tab[$i][$j]  . "</TD>";	// affichage des valeurs du tableau
			}
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE></CENTER>";
}

/*PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php et affiche en rouge
le texte d'une case correspondant à une valeur $max prédéfinie */
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre
    // $max : valeur prédéfinie (NB : pas forcément une valeur maximum)

function creerTabHTML2($tab,$nbcol,$nblig,$t,$max)
{
	echo "<CENTER><TABLE BORDER = 1>";				// début du tableau
	
	if (isset($t)==TRUE)							// on teste l'existence de $t
	{
		echo "<THEAD>";								// crée l'en-tête du tableau avce les noms des champs de la requête
		echo "<TR>";
		for ($i=0; $i < $nbcol; $i++)				// boucle parcourant chaque colonne du recordset, 
		{
			echo "<TH>" . $t[$i] . "</TH>";			// affichage de la ligne d'entête
		} 
		echo "</TR>";
		echo "</THEAD>";
	}
	
	echo "<TBODY>";									// crée le corps du tableau
        
		for ($i=0; $i < $nblig; $i++)				//boucle parcourant chaque ligne du recordset, 
		{   
			echo ("<TR>");
            
            for ($j=0; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
            {
                $case = $tab[$i][$j] ;
                if ($case == $max)
                    echo '<TD><font color="red">' . $case . "</font></TD>";	// affichage de la valeur en rouge si elle est égale à $max

                else 
					echo "<TD>" . $case . "</TD>";	// affichage des valeurs du tableau
			}
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE></CENTER>";
}


//PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php 
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t : tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre
    // $id : id à donner au tableau
    // $cases : liste des indices de colonnes qui contiendront des cases à cocher
    // $liens : liste des indices de colonnes qui contiendront des liens

function creerTabHTML3($tab,$nbcol,$nblig,$t,$id)
{
	echo "<TABLE ID='".$id."' BORDER = 1>";				// début du tableau
	
	if (isset($t)==TRUE)							// on teste l'existence de $t
	{
		echo "<THEAD>";								// crée l'en-tête du tableau avce les noms des champs de la requête
		echo "<TR>";
		for ($i=0; $i < $nbcol; $i++)				// boucle parcourant chaque colonne du recordset, 
		{
			echo "<TH>" . $t[$i] . "</TH>";			// affichage de la ligne d'entête
		} 
		echo "</TR>";
		echo "</THEAD>";
	}
	
	echo "<TBODY>";									// crée le corps du tableau
		for ($i=0; $i < $nblig; $i++)				//boucle parcourant chaque ligne du recordset, 
		{
			echo ("<TR>");
			for ($j=0; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
			{
					echo "<TD>" . $tab[$i][$j]  . "</TD>";	// affichage des valeurs du tableau
			}
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE>";
}


//PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php 
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t : tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre
    // $id : id à donner au tableau
    // $case : liste des indices de colonnes qui contiendront des cases à cocher   --> en cours   --> connecter à la base de données pour modifications
    // $lien : liste des indices de colonnes qui contiendront des liens            --> pas commencé

function creerTabHTMLrecap($tab,$nbcol,$nblig,$t,$id,$case,$link,$table_bdd)
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
                
                $type = 'pas case à cocher' ;
                $etat = $type ;
                
                for ($ind=0 ; $ind < count($case) ; $ind++) {
                    
                    if ($j == $case[$ind]) {                        
                        
                        if ($tab[$i][$j] == 1) 
                            $etat = 'checked' ;
                            $value = 1 ;
                        if ($tab[$i][$j] == 0)
                            $etat = '' ;
                            $value = 0 ;
                    }
                }
                
                if ($etat == $type) 
                    echo "<TD>" . $tab[$i][$j]  . "</TD>";	// affichage des valeurs du tableau
                
                else {
                    
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
                        
                        
                        $require = "UPDATE ".$table_bdd." SET " . $t[1][$j] . "=" . $value . ", " . $t[1][1] . "=" . $tab[$i][1] . " WHERE ". $t[1][1] . "=" . $tab[$i][1] ;
                        mysqli_query($link, $require) ;
                    }
                    
                echo '<TD> <input type="checkbox" name="check'.$i.$j.'" value="1"' . $etat . '> </TD>' ;
                
                    
                
                }
                    
                    
            }
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE>";
    
}


?>