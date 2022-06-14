<?php

function match_tab_builder($tab_vaca, $tab_genis){
    /*fonction de construction d'un tableau de correspondance entre 
    les noms entre les bases de données Vaca et Genis*/

    for($i=0; $i<count($tab_vaca); $i++){
        $init_tab[$tab_vaca[$i]]=$tab_genis[$i];    
    }
    return $init_tab;
}


?>