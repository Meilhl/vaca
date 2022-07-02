<?php
    require("../../Fonction/transform_requete.php");
    $db_vaca=mysqli_connect('localhost','root','','vaca');
    mysqli_set_charset($db_vaca,"utf8mb4_general_ci");

    $db_genis=mysqli_connect('localhost','root','','genis');
    mysqli_set_charset($db_genis,"utf8mb4_general_ci");

    $id_race_vaca = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
    $id_race_genis = array(19,5,6,3,4,2,7,8,9,10,11,12,13,14,15,16,31,17,18,24);

    $tabsex_vaca=['F','M','H'];
    $tabsex_genis=[1,2,3];
    // Construction des tableaux de correspondance
    $arrmacth_id_race = match_tab_builder($id_race_vaca,$id_race_genis);
    $arrmatch_sexe = match_tab_builder($tabsex_vaca, $tabsex_genis);
    
    $review_animal = "SELECT * FROM animal";
    
    $rev_result_vaca = mysqli_query($db_vaca, $review_animal) or die ('pb : ' . mysqli_error($db_vaca)) ;
    $table_animal_vaca = mysqli_fetch_all($rev_result_vaca) ;
    $ncol_vaca = mysqli_num_fields($rev_result_vaca) ;
    $nlig_vaca = mysqli_num_rows($rev_result_vaca) ;
    
    $review_genis_animal = "SELECT nom_animal,sexe,no_identification,YEAR(date_naiss),code_race,id_pere,id_mere FROM animal";

    $rev_result_genis = mysqli_query($db_genis, $review_genis_animal) or die ('pb : ' . mysqli_error($db_genis)) ;
    $table_animal_genis = mysqli_fetch_all($rev_result_genis) ;
    $ncol_genis = mysqli_num_fields($rev_result_genis) ;
    $nlig_genis = mysqli_num_rows($rev_result_genis) ; 

    $i=0;
    $nom_animal=$table_animal_genis[$i][0];
    $sexe_genis=$table_animal_genis[$i][1];
    $no_identification=$table_animal_genis[$i][2];
    $annee_naiss=$table_animal_genis[$i][3];
    $code_race=$table_animal_genis[$i][4];
    $id_pere=$table_animal_genis[$i][5];
    $id_mere=$table_animal_genis[$i][6];

    $queryfamille="SELECT id_famille FROM animal WHERE id_animal= '".$id_mere."'";
    $resultfamille=mysqli_query($db_vaca,$queryfamille) or die("Impossible d'ouvrir la BDD race:".mysqli_error($db_vaca));
    $tabfamille=mysqli_fetch_all($resultfamille); // Création d'un tableau php
    if ($tabfamille==null){
        $id_famille='NULL';
    }
    else{
        $id_famille="'".$tabfamille[0][0]."'";
    }
    if (! $code_race==null){
        $id_race = array_keys($arrmacth_id_race,$code_race)[0];
    }
    else{
        $id_race=NULL;
    }
    $sexe_vaca = array_keys($arrmatch_sexe,$sexe_genis)[0];
    print_r($table_animal_genis);
    $ajout_vaca = "INSERT INTO animal (id_mere,id_famille,id_sexe,id_race,id_pere,identifiant_animal,surnom,annee_naissance) 
    VALUES ($id_mere,$id_famille,$sexe_vaca,$id_race,$id_pere,$no_identification,$nom_animal,$annee_naiss)";
    echo $ajout_vaca;
?>   