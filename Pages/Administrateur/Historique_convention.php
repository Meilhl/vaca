<?php session_start(); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../../Style/calendar.css" media="all" />
    <title>
		Convention
	</title>
</head>
<body>
    <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
    </div>

    <div class="corps" style='background-color: rgba(159,185,153,0);'>
    <?php
    // Ouverture bdd
    $link = mysqli_connect('localhost', 'root', '', 'vaca');
    mysqli_set_charset($link,"utf8mb4_general_ci");
    mysqli_select_db ($link , "vaca")
      or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

    // En cas de renvoi depuis une autre page
    if(isset($_GET["id_demande"])){
      $id_demande = $_GET["id_demande"];

    // Affichage de la Convention dont le numéro est celui dans l'url (renvoi depuis les calendriers)
      if($id_demande !=NUll){
        echo"<center><div class='border' style='height:auto;width:40%;'>";
        /* Récupération des informations sur la demande*/
        $query1="SELECT date_demande, prenom, nom, quantite, lib_duree, date_debut, date_fin, typededemande.id_type_demande, id_statutTran, date_validation
        FROM demande, profil, dureeconvention, typededemande,race
        WHERE demande.id_profil = profil.id_profil
        AND demande.id_duree = dureeconvention.id_duree
        AND demande.id_type_demande = typededemande.id_type_demande
        AND id_demande = ".$id_demande;

        $result1 = mysqli_query($link, $query1)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
        $info_demande = mysqli_fetch_all($result1);

        $prenom = $info_demande[0][1];
        $nom = $info_demande[0][2];
        $quantite = $info_demande[0][3];
        $lib_duree = $info_demande[0][4];
        $date_debut = $info_demande[0][5];
        $date_fin = $info_demande[0][6];
        $id_type = $info_demande[0][7];
        $statut = $info_demande[0][8];

        // Date en format (jj/mm/YYYY)
        $jour = date('d/m/Y',strtotime($info_demande[0][0]));
        $date_transport = date('d/m/Y',strtotime($info_demande[0][9]));

        // Affichage
        echo "<div class = 'navtop' style='width:auto;'><h1 style='padding-left:5px;'>Demande n°" .$id_demande. "</h1></div><br>";
        echo "<p style='text-align:left'> Demande effectuée le <b>" . $jour . "</b> par " .$prenom. " " .$nom. ".</p>";
        echo "<h2 style='width:80%'> Informations de la demande </h2> ";


        // Cas animal
        if($id_type != 1){
          $race = mysqli_fetch_all(mysqli_query($link,"SELECT race FROM race,demande WHERE demande.id_race = race.id_race AND id_demande =".$id_demande))[0][0];
          echo "<h3> Il s'agit d'une demande d'animal pour la race " .$race. ".</h3>";
          $query2 = "SELECT surnom
          FROM attributiondesanimaux, animal
          WHERE animal.id_animal = attributiondesanimaux.id_animal
          AND id_demande = ".$id_demande;

          $result2 = mysqli_query($link, $query2)or die("Impossible requete attribution".mysqli_error($link));
          $tab = mysqli_fetch_all($result2);
          // Cas troupeau
          if($quantite>1){
              echo "<p style='text-align:left'>".$quantite." animaux sont concernés par cette demande: <BR>";
              for($x=0;$x<$quantite;$x++){
                $surnom = $tab[$x][0];
                echo "<li style='text-align:left'> ".$surnom." </li>";           // IL FAUDRAIT METTRE UN LIEN VERS LA FICHE DE L'ANIMAL
              }
          }
          // Cas mâle seul
          else {
            $surnom = '';
            if($tab!=null){$surnom = $tab[0][0];}
            echo "<p style='text-align:left'>Un seul animal est concerné par cette demande (".$surnom."). <BR>";
          }
        }
        // Cas Materiel
        else{
          $query2 = "SELECT nom_materiel
          FROM materiel,demande
          WHERE demande.id_materiel = materiel.id_materiel
          AND id_demande = ".$id_demande;
          $result2 = mysqli_query($link, $query2)or die("Impossible requete attribution".mysqli_error($link));
          $nom_materiel = mysqli_fetch_all($result2)[0][0];

          if($quantite>1){
            echo "<center><h3> Il s'agit d'une demande de matériel pour des " .$nom_materiel. "s au nombre de ".$quantite.". <h3></center>";
          }
          else{
            echo "<center><h3> Il s'agit d'une demande de matériel pour un(e) " .$nom_materiel. ".<h3></center>";
          }
        }
        echo "<p style='text-align:left'> ";
        echo "La convention dure ".$lib_duree.".<br>";
        echo "Elle commence le <b>". $date_debut."</b> et se finit le <b>".$date_fin."</b>.</p><br>";

        if($statut == 1){
          echo "<h3>Le transport a bien été effectué le <b>".$date_transport." !</b></h3>";
        }
        else {
          echo "<h3> ⚠️ Le transport est toujours en attente.</h3>";
        }
        if(!isset($_SESSION['n'])){
          echo "<hr><h3 style='margin-left:20px;font-size:1em;text-align : left'>Rechercher une autre convention : <a style='font-size:1.2em;text-decoration:none' href='Historique_convention.php'>🔎</a></h3>";
        }
        echo "<h3 style='margin-left:20px;font-size:1em;text-align : left'>Voir l'agenda : <a style='font-size:1.2em;text-decoration:none' href='Agenda.php'>📅</a></h3>";

        // Si la page provient d'une demande de voir toutes les conventions correspondant à une date
        if(isset($_SESSION["n"])){
          $n = $_SESSION["n"]-1;
          $tabConv = $_SESSION["tabConv"];
          // S'il ne reste plus de demandes après celle là
          if($n==-1){
            unset($_SESSION["n"]);
            unset($_SESSION["tabConv"]);
            echo "Toutes les conventions demandées ont été visualisées.";
            echo "<form action='Historique_convention.php'><input type='submit' name='menu' value='Revenir au menu'></form>";
          }
          else{
            $_SESSION["n"] = $n;
            $suivant = $tabConv[$n][0];
            echo "Il reste ".($n+1)." autre(s) convention(s) qui répond(ent) à votre demande :";
            echo "<form><input type='submit' name='suivant' value='Voir la convention suivante'><input type='hidden' id='id_demande' name='id_demande' value='$suivant'></form>";
          }
          echo"</div></center>";
        }
      }// Fin if
    }//fin isset


// Affichage des conventions quand l'url est vide
    else{
      if(isset($_SESSION["tabConv"])){unset($_SESSION["tabConv"]);}
      ?>
      <center>
        <div class="navtop" style="width:40%;height:5%;text-align:left;padding-left : 20px;"><h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:white'> Choisissez une date de convention : </h2></div>
        <div class="border" style="padding :20px;height:auto;width:40%">
          <form>
            <input style="float:left" type="date" name ="dateConv">
            <input style="margin-right:50%;margin-top:0.3%" type="submit" name="conv" value="Valider">
          </form>
          <?php
          if (isset($_GET["dateConv"]) AND $_GET["dateConv"]!=NULL)
          {
              $date=$_GET["dateConv"];
              $query = "SELECT id_demande
              FROM demande
              WHERE date_debut = \"".$date."\"
              OR date_fin = \"".$date."\"";

              $result = mysqli_query($link,$query)
                or die ("impossible requete convention".mysqli_error($link));
              $tabConv = mysqli_fetch_all($result);

              if($tabConv!=NULL){
                $_SESSION["n"]=mysqli_num_rows($result)-1;
                $_SESSION["tabConv"]=$tabConv;
                $premier = $tabConv[$_SESSION["n"]][0];
                echo("<script>location.href = 'Historique_convention.php?id_demande=".$premier."';</script>");
              }
              else{
                echo "Aucune convention trouvée.
                Voir l'";
                echo "<a href='Agenda.php'>agenda</a>.";
              }
          }
          ?>
        </div>
      </center>
      <?php
    }


    ?>
  </div>
  <br>
    <div class="footer">
      <?php include("../../Style/Pied.html");?>
    </div>
  </body>
</hmtl>
