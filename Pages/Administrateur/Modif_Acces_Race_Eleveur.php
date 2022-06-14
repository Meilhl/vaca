<?php
//ouverture de session
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Mes animaux
  </title>
</head>
<body>
  <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role);
    ?>
    <br>
  </div>

  <div class="corps">
    <?php
    require("../../Fonction/creerListeHTML2.php");
    require("../../Fonction/creerListeHTMLfin.php");
    // Connexion à la base de données
    $link=mysqli_connect('localhost','root','','vaca');
    mysqli_set_charset($link,"utf8mb4_general_ci");

    // Choix d'une BDD et message d'erreur si connexion impossible
    mysqli_select_db($link,'vaca')
    or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
    ?>
    <center><div class='border' style='width:35%;padding:20px;height:auto'>

      <?php

      $queryprofil="SELECT id_profil, nom, prenom
      FROM profil";

      //Exécution de la requête et production d'un recordset
      $resultprofil=mysqli_query($link,$queryprofil) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
      $tabprofil=mysqli_fetch_all($resultprofil); // Création d'un tableau php

      //Traitement du recordset
      $nblig = mysqli_num_rows($resultprofil) ; //nb lignes tableau
      $nbcol = mysqli_num_fields($resultprofil) ; // nb colonnes

      $id_profil=-1;
      if (isset($_GET["Profil"]))
      {
        $id_profil=$_GET["Profil"];

      }
      $acces_race=array();

      echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> 👤 Gérer les races élevées </h2> <hr>";
      echo "<form action='Modif_Acces_Race_Eleveur.php' style='text-align:left' method='get'>";
      echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;'>Eleveur concerné :</h2>";
      if (isset($_GET["Profil"]))
      {
        echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> Races du conservatoire </h2> <hr>";
      }

      creerListeHTMLfin("Profil",$tabprofil,$nbcol,$nblig,$id_profil);
      echo "<br>";
      echo "<br><center><input type='submit' name='bt1' value='Afficher les races associées'></center>";
      echo "</form>";

      if (isset($_GET["Profil"]))
      {
        $queryacces="SELECT id_race, acces_race
        FROM accesrace
        WHERE id_profil=$id_profil
        ORDER BY id_race";

        //Exécution de la requête et production d'un recordset
        $resultacces=mysqli_query($link,$queryacces) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
        $tabacces=mysqli_fetch_all($resultacces); // Création d'un tableau php

        // creerListeHTML2('test1',$tabacces,'---');
        $queryrace="SELECT id_race, race
        FROM race
        ORDER BY id_race";

        //Exécution de la requête et production d'un recordset
        $resultrace=mysqli_query($link,$queryrace) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
        $taberace=mysqli_fetch_all($resultrace); // Création d'un tableau php

        // creerListeHTML2('test2',$taberace,'---');
        //Traitement du recordset
        $lignerace = mysqli_num_rows($resultrace) ; //nb lignes tableau
        $colrace= mysqli_num_fields($resultrace) ; // nb colonnes

        echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> 👤 Races du conservatoire </h2> <hr>";
        echo "<form style='text-align:left'><br>";
        for ($i=0;$i<$lignerace;$i++)
        {
          if($tabacces[$i][1]==1)
          {
            echo "<label class='container'>".$taberace[$i][1];
            echo "<input  type='checkbox' name=".$taberace[$i][0]." value='1' checked>";
            echo "<span class='checkmark'></span>";
            echo "</label>";
            echo "<br>";
          }
          else
          {
            echo "<label class='container'>".$taberace[$i][1];
            echo "<input  type='checkbox' name=".$taberace[$i][0]." value='1'>";
            echo "<span class='checkmark'></span>";
            echo "</label>";
            echo "<br>";
          }
        }

        echo "<input type='hidden' name='Profil' value=$id_profil>";
        echo "<br><center><input type='submit' name='bt2' value='Valider'></center>";
        echo "</form>";

        if(isset($_GET["bt2"]))
        {
          $delete= "DELETE FROM `accesrace` WHERE id_profil=$id_profil";
          $push=mysqli_query($link,$delete);

          for ($i=0;$i<$lignerace;$i++)
          {
            $acces_race[$i]=0;

            if(isset($_GET[$i+1]))
            {
              $acces_race[$i]=1;
            }
          }


          for ($i=0;$i<$lignerace;$i++)
          {
            $ajout=" INSERT accesrace (id_race, id_profil,acces_race)
            VALUES (".$taberace[$i][0].",'$id_profil',".$acces_race[$i].")";

            $push=mysqli_query($link,$ajout);
          }
          echo "<H3>Les modifications ont bien eu lieu, actualiser la page pour vérifier.";
        }
      }

      ?>

    </div></center>
  </div>

  <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
  </div>
</body>
</hmtl>
