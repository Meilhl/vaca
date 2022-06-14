<?php
function transportValide(){
  $link = mysqli_connect('localhost', 'root', '', 'vaca');
  mysqli_set_charset($link,"utf8mb4_general_ci");
  //Ouverture BDD
  mysqli_select_db ($link , "vaca")
    or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

//Requêtes
// 1. Validation des transports
  $jour = date("Y-m-d"); //A modifier, c'est pour tester
  //On affiche les transports validés les 5derniers jours
  $i=1;
  while($i<=5)
  {
    $query="SELECT id_type_demande FROM demande
    WHERE demande.id_statutTran = 1
    AND demande.date_validation =\"".$jour."\"";
    $result = mysqli_query($link,$query)
      or die ("impossible requete prealable transport validé!".mysqli_error($link));
    $tab = mysqli_fetch_all($result);
    if($tab != NULL){
      $type = $tab[0][0];
    }
    else{
      $type=0;
    }
    if($type == 1){
      //Requête principale
      $query="SELECT profil.nom, profil.prenom,demande.quantite,materiel.id_materiel
        FROM demande,materiel,profil
        WHERE demande.id_materiel = materiel.id_materiel
        AND demande.id_profil = profil.id_profil
        AND demande.id_statutTran = 1
        AND demande.date_validation =\"".$jour."\"";
      $result = mysqli_query($link,$query)
        or die ("impossible requete principale transport validé!".mysqli_error($link));
      $tab = mysqli_fetch_all($result);
      $n = mysqli_num_rows($result);
      echo $n;
      for($x=1;$x<=$n;$x++){
        // Valeurs
        $nom_eleveur = $tab[$x][0];
        $prenom_eleveur = $tab[$x][1];
        $quantite = $tab[$x][2];
        $id_mat = $tab[$x][3];

        $query="SELECT typedemateriel.lib_materiel FROM typedemateriel,materiel
        WHERE demande.id_materiel = typedemateriel.id_materiel
        AND demande.id_materiel =".$id_mat;
        $result = mysqli_query($link,$query)
          or die ("impossible requete materiel transport validé!".mysqli_error($link));
        $tab_materiel = mysqli_fetch_all($result);
        $materiel = $tab_materiel[0][0];
        $jour_format = date("d/m/Y",strtotime($jour));
        echo "<li> Le <b>".$jour_format."</b>, ".$nom_eleveur." ".$prenom_eleveur." a bien récupéré
        ".$quantite." ".$materiel."(s). ";
        //lien vide pour l'instant !!
        echo "<a href = '../../Pages/Administrateur/Accueil_administrateur.php'> Voir la convention. </a></li>";
      }
    }
    elseif ($type == 2) {
      //Requête principale
      $query="SELECT profil.nom, profil.prenom,demande.quantite,animal.id_race
        FROM demande,attributiondesanimaux at,animal,profil
        WHERE demande.id_demande=at.id_demande
        AND at.id_animal = animal.id_animal
        AND demande.id_profil = profil.id_profil
        AND demande.id_statutTran = 1
        AND demande.date_validation =\"".$jour."\"";
      $result = mysqli_query($link,$query)
        or die ("impossible requete principale transport validé!".mysqli_error($link));
      $tab = mysqli_fetch_all($result);
      $n = mysqli_num_rows($result);
      for($x=0;$x<=$n-1;$x++){
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
        $jour_format = date("d/m/Y",strtotime($jour));
        echo "<li> Le <b>".$jour_format."</b>, ".$nom_eleveur." ".$prenom_eleveur." a bien récupéré
        ".$quantite." ".$race.". ";
        //lien vide pour l'instant !!
        echo "<a href = '../../Pages/Administrateur/Accueil_administrateur.php'> Voir la convention. </a></li>";
      }
    }
    elseif ($type == 3) {
      //Requête principale
      $query="SELECT profil.nom, profil.prenom
        FROM demande,profil
        WHERE demande.id_profil = profil.id_profil
        AND demande.id_statutTran = 1
        AND demande.date_validation =\"".$jour."\"";
      $result = mysqli_query($link,$query)
        or die ("impossible requete principale transport validé!".mysqli_error($link));
      $tab = mysqli_fetch_all($result);
      echo $tab;
      $n = mysqli_num_rows($result);
      for($x=0;$x<=$n-1;$x++){
        // Valeurs
        $nom_eleveur = $tab[$x][0];
        $prenom_eleveur = $tab[$x][1];
        $jour_format = date("d/m/Y",strtotime($jour));
        echo "<li> Le <b>".$jour_format."</b>, ".$nom_eleveur." ".$prenom_eleveur." a bien récupéré
        son troupeau. ";
        //lien vide pour l'instant !!
        echo "<a href = '../../Pages/Administrateur/Accueil_administrateur.php'> Voir la convention. </a></li>";
      }
    }

    $i++;
    $jour=date("Y-m-d",strtotime("-1 day",strtotime($jour)));
  }
  }

 ?>