<?php
function rappelRDV(){
  $link = mysqli_connect('localhost', 'root', '', 'vaca');
  mysqli_set_charset($link,"utf8mb4_general_ci");
  //Ouverture BDD
  mysqli_select_db ($link , "vaca")
    or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

  //Requêtes
  // 1. Validation des transports
  $jour = date("Y-m-d"); //A modifier, c'est pour tester
  //On affiche les rdv les 15prochains jours
  $i=1;
  while($i<=15){
    // Rendez-vous véto
    $query="SELECT identifiant_animal, surnom FROM animal
    WHERE animal.date_prochainVETO =\"".$jour."\"";
    $result = mysqli_query($link,$query)
      or die ("impossible requete prealable rappels RDV".mysqli_error($link));
    $tab_animal = mysqli_fetch_all($result);
    if($tab_animal !=NULL){
      $n = mysqli_num_rows($result);
      for($x=0;$x<=$n-1;$x++){
        $id_animal = $tab_animal[$x][0];
        $surnom = $tab_animal[$x][1];
        $jour_format = date("d/m/Y",strtotime($jour));
        echo "<li>Le <b>".$jour_format."</b>, vous avez un rendez-vous véto pour l'animal : ".$id_animal." (".$surnom.").</li>";
      }
    }

    // Rappels contrôles techniques
    $query="SELECT id_materiel, nom_materiel, plaque FROM materiel
    WHERE materiel.date_prochainControle =\"".$jour."\"";
    $result = mysqli_query($link,$query)
      or die ("impossible requete prealable rappels RDV".mysqli_error($link));
    $tab_materiel = mysqli_fetch_all($result);
    if($tab_materiel !=NULL){
      $n = mysqli_num_rows($result);
      $jour_format = date("d/m/Y",strtotime($jour));
      for($x=0;$x<=$n-1;$x++){
        $id_mat = $tab_materiel[$x][0];
        $nom = $tab_materiel[$x][1];
        $plaque = $tab_materiel[$x][2];
        echo "<li>Le <b>".$jour_format."</b>, le véhicule \"".$nom."\" #".$id_mat." a besoin d'un contrôle technique dans les 3 mois suivants cette date.</li>";
      }
    }

    $i++;
    $jour=date("Y-m-d",strtotime("+1 day",strtotime($jour)));
  }
}
?>