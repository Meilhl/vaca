<?php
//ouverture de session
session_start();
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Attribuer un mâle reproducteur
  </title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">


  function affichePeres(str,strr){
    console.log("ouais");
    $.ajax({
      type: 'get',
      dataType: 'html',
      url: '../../Fonction/majPeres.php', // Si on fait une erreur dans le nom du fichier php, la requête échoue.
      timeout: 1000, //délai (en ms) pour que la requête soit exécutée. Si ce délai est dépassé, on exécute la fonction spécifiée dans le paramètre "error".
      data: {
        debut: str,
        type:strr

      },
      success: function (response) {
        document.getElementById("txtPeres").innerHTML=response;
        console.log('oui');
      },
      error: function () {
        alert('La requête a échoué');
        console.log('non');
      }

    });

  }

</script>
</head>
<body>
  <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
    <br>
  </div>

  <div class="corps">
    <center><div class="border" style="width:40%;height:auto;padding:15px">
      <?php
      require("../../Fonction/creerListeHTML2.php");

      // Connexion à la base de données
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      // Choix d'une BDD et message d'erreur si connexion impossible
      mysqli_select_db($link,'vaca')
      or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));


      // Récupère les races des animaux uniquement bovin et équin
      $query1="SELECT id_race, race FROM race WHERE id_espece= '1' OR id_espece='2' ";

      //Exécution de la requête et production d'un recordset
      $result1=mysqli_query($link,$query1) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
      $tab1=mysqli_fetch_all($result1); // Création d'un tableau php

      //Traitement du recordset
      $nblig = mysqli_num_rows($result1) ; //nb lignes tableau
      $nbcol = mysqli_num_fields($result1) ; // nb colonnes


      $id_race=-1; /*Permet de garder la valeur sélectionnée dans la liste déroulante*/
      if(isset($_GET["Race"]))
      {
        $id_race=$_GET["Race"];
      }

      echo'<form  action="Attribution_Reproducteur.php" method="GET">';
      // Liste race
      echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Selectionner la race <br> de l'animal que vous souhaitez attribuer: </h2> " ;
      creerListeHTML2("Race",$tab1,$id_race) ;
      echo'<br><br><INPUT TYPE="SUBMIT"  name="bt1" value="Choisir une exploitation"> ';
      echo '</form>';

      if(isset($_GET["Race"]))
      {
        // Récupère les exploitations qui élevent la race selectionnée
        $query2="SELECT id_exploit
        FROM attributiondesexploitations Ade, profil P, accesrace A, race
        WHERE race.id_race=$id_race AND A.id_race=Race.id_race AND P.id_profil=A.id_profil
        AND P.id_profil = Ade.id_profil ";

        //Exécution de la requête et production d'un recordset
        $result2=mysqli_query($link,$query2) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
        $tab2=mysqli_fetch_all($result2); // Création d'un tableau php

        //Traitement du recordset
        $nblig2 = mysqli_num_rows($result2) ; //nb lignes tableau
        $nbcol2 = mysqli_num_fields($result2) ; // nb colonnes

        /*comme les Tables n'était pas directment reliées on a du faire
        cette façon pour créer une requête SQL custom*/

        $propositions=array();
        // Recherche de prénoms dans le tableau correspondant au texte saisie

        for ($i=0; $i<$nblig2; $i++)
        {
          for ($j=0; $j<$nbcol2;$j++)
          {
            $stp='exploitation.id_exploit="'. $tab2[$i][$j].'" ';
            array_push($propositions,$stp);
          }

        }

        $phrase="";
        for ($i=0; $i<count($propositions); $i++)
        {
          if ($i==count($propositions)-1)
          {
            $phrase=$phrase.$propositions[$i];
          }

          else
          {
            $phrase=$phrase.$propositions[$i];
            $phrase=$phrase.'or ';
          }
        }

        $query3= "SELECT id_exploit, nom_exploit FROM exploitation
        WHERE $phrase";


        //Exécution de la requête et production d'un recordset
        $result3=mysqli_query($link,$query3) or die ("Aucune exploitation a ces animaux".mysqli_error($link));
        $tab3=mysqli_fetch_all($result3); // Création d'un tableau php

        $id_exploit=-1;
        if(isset($_GET["Exploit"]))
        {
          $id_exploit=$_GET["Exploit"];
        }

        echo'<form  action="Attribution_Reproducteur.php" method="GET">';
        // Liste exploitation
        echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Selectionner l'exploitation : </H2> " ;
        creerListeHTML2("Exploit",$tab3,$id_exploit);

        if ($id_race==1 ||$id_race==2 ||$id_race==3||$id_race==4||$id_race==5)
        {
          echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Taureau :</h2>";
        }

        else
        {
          echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Cheval :</h2>";
        }
        echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choissiser l'animal dans la liste :</h2>";
        echo "<input type='text' placeholder='Recherche...' onkeyup='affichePeres(this.value,$id_race)' size='20' >";
        echo "<span id='txtPeres'></span>";

        echo "<INPUT TYPE='HIDDEN' name='Race' value=$id_race>";
        echo "<br><br><INPUT TYPE='SUBMIT'  name='bt3' value='Attribuer ce mâle à cette exploitation'> ";
        echo "</form>";

        if (isset($_GET["id_pere"]))
        {
          $id_taureau=$_GET["id_pere"];
          $id_exploit=$_GET["Exploit"];

          $query4="UPDATE animal SET attribution='$id_exploit'
          WHERE id_animal=$id_taureau ";

          $push=mysqli_query($link,$query4);

          $queryexploit="SELECT nom_exploit FROM exploitation WHERE id_exploit=$id_exploit";

          $queryanimal="SELECT identifiant_animal FROM animal WHERE id_animal=$id_taureau";

          //Exécution de la requête et production d'un recordset
          $resultexploit=mysqli_query($link,$queryexploit) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
          $tabexploit=mysqli_fetch_all($resultexploit); // Création d'un tableau php

          //Exécution de la requête et production d'un recordset
          $resultanimal=mysqli_query($link,$queryanimal) or die ("Impossible d ouvrir la BDD race:".mysqli_error($link));
          $tabanimal=mysqli_fetch_all($resultanimal); // Création d'un tableau php

          echo " L'animal n°: ".$tabanimal[0][0]." a été attribué à ".$tabexploit[0][0]."";

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
