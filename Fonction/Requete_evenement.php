<?php
function evenements(){
  $link = mysqli_connect('localhost', 'root', '', 'vaca');
  mysqli_set_charset($link,"utf8mb4_general_ci");
  //Ouverture BDD
  mysqli_select_db ($link , "vaca")
    or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

//Requêtes
// 1. Validation des transports
  $jour = date("Y-m-d");
  echo $jour;
  //On affiche les transports validés les 5derniers jours
  $i=1;
  while($i<=5)
  {
    $query="SELECT id_type_demande FROM demande
    WHERE demande.id_statutDem = 1
    AND demande.date_validation =".$jour;
    $result = mysqli_query($link,$query)
      or die ("impossible requete prealable transport validé!".mysqli_error($link));
    $tab = mysqli_fetch_all($result);
    if($tab!=null){
      $type = $tab[0][0];
      ECHO $type;
    }
    else{
      $type = 0;
    }
    if($type = 1){
      //Requête principale
      $query="SELECT profil.nom, profil.prenom,demande.quantite,materiel.id_type_mat
        FROM demande,materiel,profil
        WHERE demande.id_type_mat = materiel.id_type_mat
        AND demande.id_profil = profil.id_profil
        AND demande.id_statut_dem = 1
        AND demande.date_validation =".$jour;
      $result = mysqli_query($link,$query)
        or die ("impossible requete principale transport validé!".mysqli_error($link));
      $tab = mysqli_fetch_all($result);
      $n = mysqli_num_rows($result);
      for($x=1;$x<=$n;$x++){
        // Valeurs
        $nom_eleveur = $tab[$x][0];
        $prenom_eleveur = $tab[$x][1];
        $quantite = $tab[$x][2];
        $id_type_mat = $tab[$x][3];

        $query="SELECT typedemateriel.lib_materiel FROM typedemateriel WHERE id_type_materiel =".$id_type_materiel;
        $result = mysqli_query($link,$query)
          or die ("impossible requete materiel transport validé!".mysqli_error($link));
        $tab_materiel = mysqli_fetch_all($result);
        $materiel = $tab_materiel[0][0];

        echo "Le ".$jour.", ".$nom_eleveur." ".$prenom_eleveur." a bien récupéré
        ".$quantite." ".$materiel."(s)";
        //lien vide pour l'instant !!
        echo "<a> Voir la convention </a>";
      }
    }
    elseif ($type = 2) {
      //Requête principale
      $query="SELECT profil.nom, profil.prenom,demande.quantite,animal.id_race
        FROM demande,attributiondesanimaux at,animal,profil
        WHERE demande.id_demande=at.id_demande
        AND at.id_animal = animal.id_animal
        AND demande.id_profil = profil.id_profil
        AND demande.id_statutDem = 1
        AND demande.date_validation =".$jour;
      $result = mysqli_query($link,$query)
        or die ("impossible requete principale transport validé!".mysqli_error($link));
      $tab = mysqli_fetch_all($result);
      echo $tab;
      $n = mysqli_num_rows($result);
      for($x=1;$x<=$n;$x++){
        // Valeurs
        $nom_eleveur = $tab[$x][0];
        $prenom_eleveur = $tab[$x][1];
        $quantite = $tab[$x][2];
        $id_race = $tab[$x][3];

        $query="SELECT race.race FROM race WHERE id_race =".$id_race;
        $result = mysqli_query($link,$query)
          or die ("impossible requete race transport validé!".mysqli_error($link));
        $tab_race = mysqli_fetch_all($result);
        $race = $tab_race[0][0];

        echo "Le ".$jour.", ".$nom_eleveur." ".$prenom_eleveur." a bien récupéré
        ".$quantite." ".$race;
        //lien vide pour l'instant !!
        echo "<a> Voir la convention </a>";
      }
    }
    elseif ($type = 3) {
      //Requête principale
      $query="SELECT profil.nom, profil.prenom
        FROM demande,profil
        WHERE demande.id_profil = profil.id_profil
        AND demande.id_statutDem = 1
        AND demande.date_validation =".$jour;
      $result = mysqli_query($link,$query)
        or die ("impossible requete principale transport validé!".mysqli_error($link));
      $tab = mysqli_fetch_all($result);
      echo $tab;
      $n = mysqli_num_rows($result);
      for($x=1;$x<=$n;$x++){
        // Valeurs
        $nom_eleveur = $tab[$x][0];
        $prenom_eleveur = $tab[$x][1];

        echo "Le ".$jour.", ".$nom_eleveur." ".$prenom_eleveur." a bien récupéré
        son troupeau";
        //lien vide pour l'instant !!
        echo "<a> Voir la convention </a>";
      }
    }
    elseif ($type = 4) {

    }
  }
  $jour=date("Y-m-d",strtotime("-1 day",strtotime($jour)));
  }

 ?>
