<?php
//ouverture de session
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Mes demandes
  </title>
</head>
<body>
  <div class= "header">
    <?php
    $role=2;
    require("../../Style/Entete.php");
    affiche_entete($role);
    ?>
  </div>

  <div class="corps">
    <center><div class="border" style="width:auto;height:auto">
      <!--<div class="gauche">-->
      <?php
      require("../../Fonction/affiche_demande.php");
      //connection à la base
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      $id_profil=$_SESSION['id_profil'];

      // demande animaux
      // récupération de toute les demandes du profil

      $query="SELECT id_demande, id_statutDem, quantite
      FROM demande
      WHERE demande.id_race!='NULL'
      AND id_profil = $id_profil";

      $result = mysqli_query($link, $query)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
      $tab_id_demande = mysqli_fetch_all($result);

      if(count($tab_id_demande)==0){
        echo"<br><hr><h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Pas de demande d'animaux </h2><hr>";
      }

      else{

        for ($id=0;$id<count($tab_id_demande);$id++){
          echo"<div class='demande'>";

          if ($tab_id_demande[$id][1]==1){
            echo "<form method='GET' action='2A_Mes_demandes.php' name= 'validation_trajet'>";
            Affiche_demande_animaux($link, $tab_id_demande, $id, 1);
            echo "<input type='submit' name='btn_valid_trajet' value='Validation du transport'>";
            echo"</form>";
            if (isset($_GET["btn_valid_trajet"])){
              echo "<form method='GET' action='../../Fonction/modif_bdd_convention.php' target_blank name= modif_bdd_convention> ";
              for ($i=0; $i<$tab_id_demande[$id][2];$i++){
                echo "<p>Identifiant de l'animal ".$i." : <input type='text' name=animal".$i."></p>";
              }
              $id_profil=$_SESSION["id_profil"];
              $query_duree="SELECT lib_duree
              FROM demande
              LEFT JOIN dureeconvention ON demande.id_duree=dureeconvention.id_duree
              WHERE id_demande=".$tab_id_demande[0][0];
              $result_duree = mysqli_query($link, $query_duree)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
              $tab_duree = mysqli_fetch_all($result_duree);
              $duree=$tab_duree[0][0];
              echo "<input type='hidden' name ='duree' value='".$duree."'>";
              echo "<input type='hidden' name ='id_profil' value='".$id_profil."'>";
              echo "<input type='hidden' name ='quantite' value='".$tab_id_demande[$id][2]."'>";
              echo "<input type='submit' name='valid' value='validation'>";
              echo"</form>";
            }

          }
          elseif ($tab_id_demande[$id][1]==2){
            echo "<form method='GET' action='2A_Mes_demandes.php' name= modif_demande>";
            Affiche_demande_animaux($link, $tab_id_demande, $id, 2);
            echo "<input type='submit' name='btn_annul' value='Annuler'>";
            echo"</form>";
          }
          else{
            echo "<form method='GET' action='2A_Mes_demandes.php' name= modif_demande>";
            Affiche_demande_animaux($link, $tab_id_demande, $id, 0);
            echo "<input type='submit' name='btn_annul' value='Refaire une demande'>";
            echo"</form>";
          }
          echo "</div>";
        }
      }

      // demande materiel
      // décupération des demandes matériels

      $query_mat="SELECT id_demande, id_statutDem
      FROM demande
      WHERE demande.id_materiel!='NULL'
      AND id_profil = $id_profil";

      $result_mat = mysqli_query($link, $query_mat)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
      $tab_id_demande_mat = mysqli_fetch_all($result_mat);

      if(count($tab_id_demande_mat)==0){
        echo"<hr><h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Pas de demande de materiel </h2><hr>";
      }

      else{
        for ($id=0;$id<count($tab_id_demande_mat);$id++){
          echo"<div class='demande'>";

          if ($tab_id_demande[$id][1]==1){
            echo "<form method='GET' action='2A_Mes_demandes.php' name= 'validation_trajet'>";
            Affiche_demande_materiel($link, $tab_id_demande_mat, $id, 1);
            echo "<input type='submit' name='btn_valid_trajet' value='Validation du transport'>";
            echo"</form>";
            if (isset($_GET["btn_valid_trajet"])){
              echo "<form method='GET' action='../../Fonction/modif_bdd_convention.php' name= modif_bdd_convention> ";
              for ($i=0; $i<$tab_id_demande_mat[$id][2];$i++){
                echo "<p>Identifiant de l'animal ".$i." : <input type='text' name=materiel".$i."></p>";
              }
              $query_duree="SELECT lib_duree
              FROM demande
              LEFT JOIN dureeconvention ON demande.id_duree=dureeconvention.id_duree
              WHERE id_demande=".$id;
              $result_duree = mysqli_query($link, $query_duree)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
              $tab_duree = mysqli_fetch_all($result_duree);
              $duree=$tab_duree[0][0];
              echo "<input type='hidden' name ='duree' value='".$duree."'>";
              echo "<input type='submit' name='valid' value='validation'>";
              echo"</form>";
            }

          }
          elseif ($tab_id_demande_mat[$id][1]==2){
            echo "<form method='GET' action='2A_Mes_demandes.php' name= modif_demande>";
            Affiche_demande_materiel($link, $tab_id_demande_mat, $id, 2);
            echo "<input type='submit' name='btn_annul' value='Annuler'>";
            echo"</form>";
          }
          else{
            // echo "<form method='GET' action='2A_Mes_demandes.php' name= modif_demande>";
            Affiche_demande_materiel($link, $tab_id_demande_mat, $id, 0);
            // echo "<input type='submit' name='btn_annul' value='Refaire une demande'>";
            // echo"</form>";
          }
          echo "</div>";
        }

      }
      echo "</div>";


      // fin du programme
      //fermer le recordset
      mysqli_free_result($result);
      //fermet la connexion
      mysqli_close($link);


      ?>
    </div>
  </div></center>

  <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
  </div>
</body>
</hmtl>
