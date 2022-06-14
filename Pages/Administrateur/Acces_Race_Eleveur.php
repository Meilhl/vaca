<?php
//ouverture de session
session_start();
$new_profil= $_SESSION['new_profil'];
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
  </div>

  <div class="corps">
    <center><div class="border" style='width:35%;padding:20px;height:auto'>

      <?php
      require("../../Fonction/creerListeHTML2.php");
      require("../../Fonction/creerListeHTMLfin.php");


      // Connexion à la base de données
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      // Choix d'une BDD et message d'erreur si connexion impossible
      mysqli_select_db($link,'vaca')
      or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));


      $acces_race=array(); //Création d'une liste vide qui servira à construire la requête

      // Récupération de l'id_profil correspondant à l'identifiant du profil (Adresse mail)
      $queryexploit=" SELECT id_profil FROM profil WHERE identifiant_profil='$new_profil' ";

      //Exécution de la requête et production d'un recordset
      $resultexploit=mysqli_query($link,$queryexploit) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
      $tabexploit=mysqli_fetch_all($resultexploit); // Création d'un tableau php

      // Stockage de l'id_profil
      $id_profil=$tabexploit[0][0];

      // Récupération de toute les races du conservatoire
      $queryrace="SELECT id_race, race FROM race";

      //Exécution de la requête et production d'un recordset
      $resultrace=mysqli_query($link,$queryrace) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
      $taberace=mysqli_fetch_all($resultrace); // Création d'un tableau php

      //Traitement du recordset
      $lignerace = mysqli_num_rows($resultrace) ; //nb lignes tableau
      $colrace= mysqli_num_fields($resultrace) ; // nb colonnes

      echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> 👤 Races du conservatoire </h2> <hr>";
      echo "<form style='text-align:left'>";
      for ($i=0;$i<$lignerace;$i++)
      {
        /*La checkbox associé à la race 1 s'apelle 1*/
        echo "<label class='container'>".$taberace[$i][1];
        echo "<input  type='checkbox' name=".$taberace[$i][0]." value='1'>";
        echo "<span class='checkmark'></span>";
        echo "</label>";
        echo "<br>";
      }
      echo "<center><input type='submit' name='bt1' value='Valider'></center>";
      echo "</form>";


      if (isset($_GET["bt1"]))/*Quand on a cliqué sur la bouton*/
      {
        for ($i=0;$i<$lignerace;$i++)
        {
          $acces_race[$i]=0;         /*acces race vaut 0*/
          if(isset($_GET[$i+1]))      /*Si la race n°i a été coché alors elle est set dans l'URL  */
          {
            $acces_race[$i]=1;  /*donc son acces race vaut 1 */
          }
        }


        for ($i=0;$i<$lignerace;$i++)
        {
          $ajout=" INSERT accesrace (id_race, id_profil,acces_race)
          VALUES (".$taberace[$i][0].",'$id_profil',".$acces_race[$i].")";
          $push=mysqli_query($link,$ajout);
        }

        echo "<H3 style='font-size:1.2em;font-weight:bold'>Les droits ont bien été attribués.</H3>";
        echo "<center><p style='font-size:1.2em;font-weight:bold'>Cliquer <a href='attribution_exploit_profil.php'>ici</a> pour associer une exploitation au profil</p></center>";

      }

      ?>
    </div>
  </div></center>
  <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
  </div>
</body>
</hmtl>
