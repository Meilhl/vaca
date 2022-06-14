<?php
function datesConvention($calendar,$date){

  // Ouverture bdd
  $link = mysqli_connect('localhost', 'root', '', 'vaca');
  mysqli_set_charset($link,"utf8mb4_general_ci");
  mysqli_select_db ($link , "vaca")
    or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

  // Récupération mois en cours
  $active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
  $active_month = $date != null ? date('m', strtotime($date)) : date('m');
  $active_day = $date != null ? date('d', strtotime($date)) : date('d');
  $num_days = date('t', strtotime($active_day . '-' . $active_month . '-' . $active_year));
  $jour = date("Y-m-01",strtotime($date)); // Premier jour du mois

  // Mis en place des evenements dans le calendrier
  for($x=0;$x<=$num_days-1;$x++){

    // Conventions dates de debut
    $query1="SELECT id_type_demande, id_demande, id_profil FROM demande
    WHERE demande.id_statutDem = 1
    AND demande.date_debut =\"".$jour."\"";

    $result1 = mysqli_query($link,$query1)
      or die ("impossible requete conv dates debut".mysqli_error($link));
    $tab_debut = mysqli_fetch_all($result1);

    // Conventions dates de fin
    $query2="SELECT id_type_demande, id_demande, id_profil FROM demande
    WHERE demande.id_statutDem = 1
    AND demande.date_fin =\"".$jour."\"";
    $result2 = mysqli_query($link,$query2)
      or die ("impossible requete conv dates fin".mysqli_error($link));
    $tab_fin = mysqli_fetch_all($result2);

    // Evenements debuts de convention
    if($tab_debut != NULL){
      $n = mysqli_num_rows($result1);
      for($x=0;$x<=$n-1;$x++){
        $id_type = $tab_debut[$x][0];
        $id_demande = $tab_debut[$x][1];
        $id_profil = $tab_debut[$x][2];

        // Récupération Nom profil
        $query="SELECT nom, prenom FROM profil
        WHERE id_profil =".$id_profil;
        $result = mysqli_query($link,$query)
          or die ("impossible requete nom profil".mysqli_error($link));
        $tab = mysqli_fetch_all($result);
        $nom = $tab[0][0];
        $prenom = $tab[0][1];

        // Affichage texte en fonction du type de convention
        if($id_type==2 || $id_type == 3){
          $texte = "<a style='color:black;text-decoration:none' href ='Historique_convention.php?id_demande=".$id_demande."'>Début convention animal <br>".$prenom." ".$nom."</a>";
        }
        else{
          $texte = "<a style='color:black;text-decoration:none' href ='Historique_convention.php?id_demande=".$id_demande."'>Début convention matériel <br>".$prenom." ".$nom."</a>";
        }
        // Ajout de l'événement au calendrier
        $calendar->add_event($texte,$jour,1,'green');
      }
    }
    // Evenements fins de convention
    if($tab_fin !=NULL){
      $n = mysqli_num_rows($result2);
      for($x=0;$x<=$n-1;$x++){
        $id_type = $tab_fin[$x][0];
        $id_demande = $tab_fin[$x][1];
        $id_profil = $tab_fin[$x][2];

        // Récupération Nom profil
        $query="SELECT nom, prenom FROM profil
        WHERE id_profil =".$id_profil;
        $result = mysqli_query($link,$query)
          or die ("impossible requete nom profil".mysqli_error($link));
        $tab = mysqli_fetch_all($result);
        $nom = $tab[0][0];
        $prenom = $tab[0][1];

        // Affichage texte en fonction du type de convention
        if($id_type==2 OR $id_type == 3){
          $texte = "<a style='color:black;text-decoration:none' href ='Historique_convention.php?id_demande=".$id_demande."'>⚠️ Fin convention animal <br>".$prenom." ".$nom." ⚠️</a> ";
        }
        else{
          $texte = "<a style='color:black;text-decoration:none' href ='Historique_convention.php?id_demande=".$id_demande."'>⚠️ Fin convention matériel <br>".$prenom." ".$nom." ⚠️</a>";
        }
        // Ajout de l'événement au calendrier
        $calendar->add_event($texte,$jour,1,'red');
      }
    }
    $jour=date("Y-m-d",strtotime("+1 day",strtotime($jour)));
  }

}
?>