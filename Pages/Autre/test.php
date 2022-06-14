<?php
function req_decompose($str_req){
    //Décompose une requête en ces éléments constitutifs//
    $sep = " ()";
    $tok = strtok($str_req, $sep);
    $req_expl=[];
    while ($tok !== false) {
        array_push($req_expl, $tok); 
        $tok = strtok($sep);       
        }
    return $req_expl;
}

function transform_req( string  $requete){ 
    /*Fonction qui transforme une requête SQL pour la BDD VACA 
    en une requête pour la BDD GENIS */

    //Les tableaux des tables dans GENIS et VACA
    $array_tables_vaca=array('animal','espece','race','exploitation');
    $array_tables_genis=array('animal','espece','race','elevage');

    //Les tableaux des champs dans GENIS et VACA
    $fields_genis = array('code_race','','sexe','id_mere','id_pere','nom_animal','no_identification','date_naissance','','','');
    $fields_vaca = explode(',','id_race,id_famille,id_sexe,id_mere,id_pere,surnom,identifiant_animal,annee_naissance,statut_reformation,statut_convention,en_attente');

    //Tableaux des identification races et sexe
    
    // Paragraphe pour séparer les éléments syntaxique de la requète 
    $req_expl=req_decompose($requete);
    $insert=explode(',',$req_expl[0]);
    $name_table=explode(',',$req_expl[1]);
    $champs=explode(',',$req_expl[2]);
    $into=explode(',',$req_expl[3]);
    $valeurs=explode(',',$req_expl[4]);
    //On commence la construction de la requête
    $req_genis = $req_expl[0];

    //Construction d'un tableau de correspondance en les noms de table
    $arrmatch_tables = match_tab_builder($array_tables_vaca,$array_tables_genis);

    // Finalement on récupère le nom de la table genis 
    $tab_name_genis = $arrmatch_tables[$req_expl[1]];


    //Même démarche pour les champs
    $del_fields =[];
    $arrmatch_fields = match_tab_builder($fields_vaca,$fields_genis);
    $req_genis = $req_genis . " " . $tab_name_genis . " (" . $arrmatch_fields[$champs[0]];
    for ($i=1; $i<count($arrmatch_fields); $i++){
        if ($arrmatch_fields[$champs[$i]]!=''){
            $req_genis = $req_genis . "," . $arrmatch_fields[$champs[$i]];
        }
        else{
            $del_fields = array_push($del_fields, $i);
        }    
    }
    $del_fields = arsort($del_fields)
    $req_genis = $req_genis . $arrmatch_fields[$champs[count($arrmatch_fields)-1]] . ") " . $req_expl[3];

    $arrmacth_id_race = match_tab_builder($id_race_vaca,$id_race_genis);
    $arrmatch_sexe = match_tab_builder($tabsex_vaca, $tabsex_genis);
    $valeurs[0] = $arrmacth_id_race[$valeurs[0]];
    $valeurs[2] = $arrmatch_sexe[$valeurs[2]];
    $req_genis = $req_genis . " (". implode(',',$valeurs) . ")";
    return $req_genis;
}
?>