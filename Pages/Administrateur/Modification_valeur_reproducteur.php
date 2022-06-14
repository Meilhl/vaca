<?php session_start(); ?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Valeur reproducteur
  </title>
</head>
<body>
  <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
  </div>

  <div class="corps">
    <center><div class="border" style="width:40%;height:auto;padding:5px">
      <h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Valeur de reproducteur par race</h2><hr><br>
      <form method='POST' action='Modification_valeur_reproducteur.php' name='form_valeur'>
        <?php
        /*Connexion à la base de données*/
        $link=mysqli_connect('Localhost','root','','vaca');
        mysqli_set_charset($link,"utf8mb4_general_ci");
        mysqli_select_db($link,'vaca')
        or die ('impossible d\'ouvrir la BDD: '. mysqli_error($link));

        $queryRace="SELECT id_race, race, prix_animal, espece
        FROM race
        INNER JOIN espece ON race.id_espece=espece.id_espece";
        $resultRace=mysqli_query($link, $queryRace)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
        $tabRace=mysqli_fetch_all($resultRace);
        mysqli_free_result($resultRace);


        if (isset($_POST['submit'])){
          for ($i=0;$i<count($tabRace);$i++){
            $id_race=$tabRace[$i][0];
            $modification=$_POST["prix".$id_race];
            $require="UPDATE race
            SET prix_animal='".$modification."'
            WHERE id_race='".$tabRace[$i][0]."'";
            mysqli_query($link,$require)
            or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
          }
        }

        /* RECUPERATION DES COMMUNES EN LIEN AVEC LE PROFIL POUR COMPARAISON*/
        $queryRace="SELECT id_race, race, prix_animal, espece
        FROM race
        INNER JOIN espece ON race.id_espece=espece.id_espece";
        $resultRace=mysqli_query($link, $queryRace)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
        $tabRace=mysqli_fetch_all($resultRace);
        mysqli_free_result($resultRace);

        /*Affichage des inputs*/
        echo "<center><table><tr><th><h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;'>Espece</h2>";
        echo "</th><th><h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;'>Nom de la race</h2></th><th>";
        echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;'>Valeur reproducteur de la race (€)</h2></th></tr>";
        for ($i=0;$i<count($tabRace);$i++){
          $id_race=$tabRace[$i][0];
          $race=$tabRace[$i][1];
          $prix=$tabRace[$i][2];
          $espece=iconv('UTF-8', 'windows-1252',$tabRace[$i][3]);
          echo "<tr><td><h2 style='font-size:0.8em;width:auto;padding:5px;background:none;color:black;'>".$espece."</h2></td>";
          echo "<td>";
          echo "<h2 style='font-size:0.8em;width:auto;padding:5px;background:none;color:black;'>".$race."</h2>";
          echo "</td><td>";
          if (isset($_POST["'prix".$id_race."'"])){
            $modif_race=$_POST["'prix".$id_race."'"];
            echo "<input type='number' style='width:auto' name='prix".$id_race."' value ='".$modif_race."'placeholder='valeur reproducteur'><br><br> ";
          }else{
            echo "<input type='number' style='width:auto' name='prix".$id_race."' value ='".$prix."'placeholder='valeur reproducteur'><br><br> ";
          }
          echo "</td></tr>";
        }
        echo "</table></center>";
        echo "<input type='submit' name='submit' value='Valider'> <br><br></form>";

        /*Modification de la BDD*/




        mysqli_close($link);
        ?>
      </div></center>
    </div>
    <div class="footer">
      <?php include("../../Style/Pied.html"); ?>
    </div>
  </body>
</hmtl>
