<?php session_start();
if(isset($_SESSION['destroy'])){unset($_SESSION['destroy']);header('Location:Accueil_administrateur.php');}
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />


  <title>
    Demande Materiel
  </title>
</head>
<div class= "header">
  <?php
  $role=1;
  require("../../Style/Entete.php");
  affiche_entete($role);
  ?>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<!-- Fonction javascript pour afficher les infos suivant ce qu'on sélectionne dans la liste-->
<script type="text/javascript">

function bulle(mat){

  $.ajax({
    type: 'get',
    url: '../../Fonction/affiche_bulle.php',
    data: {
      ListeMateriel: mat
    },
    success: function (response) {
      document.getElementById("infobulle").innerHTML=response;
    }
  });
}
</script>

<div class="corps" style="background-color: rgba(159,185,153,0);">
  <center>
    <div class="border" style ="width:35% ; margin:10px;padding:20px;overflow:auto;height:auto">
      <?php
      include ("../../Fonction/creerListeHTMLjava.php") ;
      $id_type_mat = $_GET["id_type_mat"];


      $link = mysqli_connect('localhost', 'root', '', 'vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      //Ouverture BDD
      mysqli_select_db ($link , "vaca") or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link));

      // On choppe les types
      if ($id_type_mat==1){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🚚​​ Selectionnez le véhicule : </h3> <br>" ;}
      if ($id_type_mat==2){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🐄​​​ Selectionnez le matériel de contention d'animaux : </h3> <br>" ;}
      if ($id_type_mat==3){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🐓​​​ Selectionnez le matériel de naissance et élevage de volaille : </h3> <br>" ;}
      if ($id_type_mat==4){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🗣️​​​ Selectionnez le matériel de support de communication : </h3> <br>" ;}
      if ($id_type_mat==5){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🐝​​​ Selectionnez le matériel d'apiculture' : </h3> <br>" ;}
      if ($id_type_mat==6){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🚚​​ Selectionnez le matériel de transport d'animaux : </h3> <br>" ;}
      if ($id_type_mat==7){echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>🚚​​ Selectionnez le matériel : autre : </h3> <br>" ;}

      // requête pour afficher le matériel de type 1 (véhicule) et disponible
      $query_materiel = "SELECT DISTINCT id_materiel, nom_materiel
      FROM materiel
      WHERE id_type_mat = ".$id_type_mat." AND disponibilite = 1" ;
      $result_materiel = mysqli_query($link, $query_materiel)
      or die ("impossible requête" .mysqli_error($link));

      $tab_mat = mysqli_fetch_all($result_materiel);

      //Formulaire affiche la liste de matériel
      echo"  <form style='text-align:left'>";
      $nom_liste_materiel = "ListeMateriel" ;
      $liste_materiel = creerListeHTML($nom_liste_materiel, $tab_mat);
      ?>
      <br> <br>
      <!-- Ci-dessous la section réservée à l'affichage de la bulle -->
      <div id="infobulle"></div>
      <?php

      // Choix dates
      echo "<hr><h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;'> Choisissez les dates d'emprunt :</h2>";
      echo"<br><br> <label for='date_debut' style='font-size:1em;font-family:Verdana;font-weight: bold;'>Début :</label>";
      if(isset($_GET["date_debut"])){
        echo "<center><input right' type='date' id='date_debut' name='date_debut' value=".$_GET['date_debut']."></center>";
      }
      else{
        echo "<center><input right' type='date' id='date_debut' name='date_debut'></center>";
      }
      echo "<br> <br>   <label for='date_fin' style='font-size:1em;font-family:Verdana;font-weight: bold;'>Fin :</label>";
      if(isset($_GET["date_fin"])){
        echo "<center><input type='date' id='date_fin' name='date_fin' value=".$_GET['date_fin']."></center>";
      }
      else{
        echo "<center><input type='date' id='date_fin' name='date_fin'></center>";
      }
      echo"<br>";
      echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;'> Choisissez l'éleveur concerné par la demande :</h2>";
      // Requête pour afficher l'éleveur
      $query_profil = "SELECT id_profil, nom, prenom
      FROM profil" ;
      $result_profil = mysqli_query($link, $query_profil)
      or die ("impossible requête profil" .mysqli_error($link));
      $tab_profil = mysqli_fetch_all($result_profil);
      $nom_liste_profil = "ListeProfil";
      echo creerListeHTML($nom_liste_profil, $tab_profil);

      echo "<br><br><br><label for='remarque_demande' style='font-size:1em;font-family:Verdana;font-weight: bold;'>  Remarque par rapport à la demande :  <br><br> </label>";
      if(isset($_GET["remarque_demande"])){
        echo "<textarea name='remarque_demande' row=10 cols=40>".$_GET['remarque_demande']."</textarea><br><hr>";
      }
      else{
        echo "<textarea name='remarque_demande' row=10 cols=40></textarea><br>";
      }
      echo "<br> <center><input type='submit' name='bouton1' value='Envoyer'></center>" ;
      echo "<input type='hidden' name='id_type_mat' value=".$_GET['id_type_mat'].">";
      echo " </form>" ;

      ?>
      <script>
      function myFunction() {
        location.replace("https://www.w3schools.com")
      }
    </script>
    <?php
    if(isset($_GET["bouton1"])) {

      //les valeurs à mettre dans la base de données pour la création d'une demande de matériel
      $id_profil=$_GET["ListeProfil"];
      $date_debut= $_GET["date_debut"];
      $id_materiel=$_GET["ListeMateriel"];
      $date_fin= $_GET["date_fin"];
      $quantite=1;
      $commentaire=$_GET["remarque_demande"];
      $date_demande=date("Y-m-d");

      //query pour insérer la demande
      $demande_mat= " INSERT INTO demande (id_profil, id_type_demande, id_statutDem, id_duree, id_materiel, date_debut, date_fin, date_demande, quantite, criteres_supp)
      VALUES (\"".$id_profil."\",'1','1','4',\"".$id_materiel."\",\"".$date_debut."\",\"".$date_fin."\",\"".date('Y-m-d')."\",\"".$quantite."\",\"".$commentaire."\")" ;



      if(mysqli_query($link,$demande_mat)){
        // Pour éviter les réactualisations intempestives
        $_SESSION["destroy"]=TRUE;
        echo "<dialogue>Votre demande a été traitée avec succès !<br>
        <h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black;'> Retour au menu <a href='Accueil_administrateur.php' style='font-size=1em'>🏠</a></h2>
        </dialogue>";
      }
      else{
        echo "<div class='alert'>
        <span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>
        <strong>Bizarre</strong> quelque chose n'a pas fonctionné, veuillez réessayer (sans oublier de remplir tous les champs) ou contacter le Conservatoire si le problème persiste...
        </div>";
      }
    }
    ?>

  </div>
</center>

</div>
<div class="footer">
  <?php include("../../Style/Pied.html"); ?>
</div>

</hmtl>
