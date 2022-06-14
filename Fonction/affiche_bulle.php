<?php
// Récupération de la liste de matériel

    $id_materiel = $_GET["ListeMateriel"];
    include ("creerListeHTMLjava.php") ;

    $link = mysqli_connect('localhost', 'root', '', 'vaca');
    mysqli_set_charset($link," utf8mb4_general_ci");
    mysqli_select_db ($link , "vaca")
    or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

  //Requête pour afficher les infos demander.
    $query_materiel_info = "SELECT nom_materiel, materiel.id_type_mat, plaque, annee_achat, commentaire_materiel, typedemateriel.lib_materiel
    FROM materiel, typedemateriel
    WHERE materiel.id_type_mat = typedemateriel.id_type_mat
    AND id_materiel=".$id_materiel ;

    $result_materiel_info = mysqli_query($link, $query_materiel_info)
    or die ("impossible requête" .mysqli_error($link));

    $tab_info = mysqli_fetch_all($result_materiel_info);   	// le tableau PHP

    $nbcol = mysqli_num_fields ($result_materiel_info);
    $nbli = mysqli_num_rows ($result_materiel_info) ;
    $id_type_mat = $tab_info[0][1];


  if($id_type_mat==1){
        for ($i=0 ; $i<$nbli ;$i++){
    echo "<p style='text-align:left;'>Le matériel sélectionné est un(e) <strong>". $tab_info[$i][0] . "</strong>.<br>Plaque d'immatriculation : <b>"
    .$tab_info[$i][2]. "</b>.";
    if($tab_info[$i][3]!=NULL){echo "<br>Le matériel a été acheté en " .$tab_info[$i][3]. ".<br>";}
    if($tab_info[$i][4]!=NULL){echo "<br>Commentaire particulier : ''<i>".$tab_info[$i][4]."</i>'.";}
    echo "</p>";
    echo "<br>";
    }
}
  else{
    for ($i=0 ; $i<$nbli ;$i++){
      echo "<p style='text-align:left;'>Le matériel selectionné est un(e) <b>". $tab_info[$i][0] . "</b>.";
      if($tab_info[$i][3]!=NULL){echo "<br>Le matériel a été acheté en " .$tab_info[$i][3]. ".<br>";}
      if($tab_info[$i][4]!=NULL){echo "<br>Commentaire particulier : '<i>".$tab_info[$i][4]."</i>'.";}
      echo "<br>";
  }
}

?>
