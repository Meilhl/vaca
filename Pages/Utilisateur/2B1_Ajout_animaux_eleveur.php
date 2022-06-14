<?php
//ouverture de session
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Ajout animal
  </title>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript">

  function afficheMeres(str,strr){
    $.ajax({
      type: 'get',
      dataType: 'html',
      url: '../../Fonction/majMeres.php', // Si on fait une erreur dans le nom du fichier php, la requête échoue.
      timeout: 1000, //délai (en ms) pour que la requête soit exécutée. Si ce délai est dépassé, on exécute la fonction spécifiée dans le paramètre "error".
      data: {
        debut:str,
        type : strr

      },
      success: function (response) {
        document.getElementById("txtMeres").innerHTML=response;
        console.log('oui');
      },
      error: function () {
        alert('La requête a échouée');
        console.log('non');
      }

    });

  }

  function affichePeres(str,strr){
    $.ajax({
      type: 'get',
      dataType: 'html',
      url: '../../Fonction/majPeres.php', // Si on fait une erreur dans le nom du fichier php, la requête échoue.
      timeout: 1000, //délai (en ms) pour que la requête soit exécutée. Si ce délai est dépassé, on exécute la fonction spécifiée dans le paramètre "error".
      data: {
        debut:str,
        type : strr
      },
      success: function (response) {
        document.getElementById("txtPeres").innerHTML=response;
        console.log('oui');
      },
      error: function () {
        alert('La requête a échouée');
        console.log('non');
      }
    });
  }


</script>
</head>
<body>
  <div class= "header">
    <?php
    $role=2;
    require("../../Style/Entete.php");
    require("../../Fonction/creerListeHTML2.php");
    require("../../Fonction/creerTabHTML.php");
    require("../../Fonction/creerListeHTML1val.php");
    require("../../Fonction/creerListeHTMLsex.php");

    affiche_entete($role); ?>
  </div>

  <div class="corps" style="background-color: rgba(159,185,153,0);">
    <center><div class="border" style='width:35%;padding:20px;height:auto'>

      <?php

      /* Connexion à la base de données*/
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      /* Choix d'une BDD et message d'erreur si connexion impossible*/
      mysqli_select_db($link,'vaca')
      or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));

      /* Récupération des identifiant des observateurs ainsi que leurs nom */
      $query1="SELECT id_espece, espece
      FROM espece";

      //Exécution de la requête et production d'un recordset
      $result1=mysqli_query($link,$query1) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
      $tab1=mysqli_fetch_all($result1); // Création tableau php

      $id_espece=-1; /* Nous avons besoin d'attribuer la valeur -1 pour que la valeur sélectionnée lors de
      l'envoie du premier formulaire reste sélectionnée*/
      if (isset($_GET["espece"]))
      {
        $id_espece=$_GET["espece"];// Si le formulaire
      }
      echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> 🐄 Ajout d'un animal </h3> <hr>";

      echo "<form style='text-align:left;' action='2B1_Ajout_animaux_eleveur.php' method='GET'>";
      echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;'> Quelle est l'espèce de l'animal ?</h2>";
      creerListeHTML2("espece",$tab1,$id_espece);
      echo "<input style='float:left;position:absolute;line-height:1.8em' type='submit' name='bouton1' value='Valider'>";
      echo"<br><br>";
      echo "</form>";

      if (isset($_GET["espece"])) // N'affiche pas le second formulaire si le premier n'est pas renseigné
      {
        // Récupère les identifiant des départments et leurs noms
        $query2="SELECT id_race, race FROM race
        WHERE race.id_espece=$id_espece";
        //Exécution de la requête et production d'un recordset
        $result2=mysqli_query($link,$query2) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
        $tab2=mysqli_fetch_all($result2); // Création d'un tableau php

        $id_race=-1; /* Nous avons besoin d'attribuer la valeur -1 pour que la valeur sélectionnée lors de
        l'envoie du premier formulaire reste sélectionnée*/
        if (isset($_GET["race"])){$id_race=$_GET["race"];}

        $surnom='';
        if (isset($_GET["surnom"])){$surnom=$_GET["surnom"];}

        $identifiant='';
        if (isset($_GET["identifiant"])){$identifiant=$_GET["identifiant"];}

        $annee_naissance='';
        if (isset($_GET["annee_naissance"])){$annee_naissance=$_GET["annee_naissance"];}

        $sexe='F';
        if (isset($_GET["sexe"])){$sexe=$_GET["sexe"];  }

        $mere='Non renseignée';
        if (isset($_GET["mere"])){$mere=$_GET["mere"];}

        $pere='Non renseignée';
        if (isset($_GET["pere"])){$pere=$_GET["pere"];}

        $tabsex=[['F','M','H'],['Femelle','Mâle','Mâle castré']];
        echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Remplir les informations suivantes :</h2>";
        echo "<form style='text-align:left' action='2B1_Ajout_animaux_eleveur.php' method='GET'>";
        echo "<input type='hidden' name='espece' value='$id_espece'>";

        echo"<label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Race :</label>";
        echo "<center>";
        creerListeHTML2("race",$tab2,$id_race);
        echo "</center>";
        echo"<br><br> <label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Sexe :</label>";
        echo "<center>";
        creerListeHTMLsex("sexe",$tabsex,$sexe);
        echo "</center>";

        echo "<br><center><input type='text' placeholder='Surnom' name='surnom' value=$surnom></center>";
        echo "<br><center><input type='text' placeholder='Identifiant national' name='identifiant' value=$identifiant></center>";
        echo "<br><center><input type='text' placeholder='Année de naissance' name='annee_naissance' value=$annee_naissance></center>";
        echo "<br><br>";
        echo "<center><input type='submit' name='bouton2' value='Valider'></center>";
        echo "<hr></form>";

        if (isset($_GET["race"]))
        {
          echo "<form style='text-align:left'>";
          echo "<label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Identifiant national de la mère :</label><br>";
          echo "<br><input type='text' placeholder='Commencer à écrire...' onkeyup='afficheMeres(this.value,$id_race)' size='20' >";
          echo "<span id='txtMeres'></span>";

          if ($id_espece==1 || $id_espece==2)
          {
            echo "<br><br><label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Identifiant national du père :</label><br>";
            echo "<br><input type='text' placeholder='Commencer à écrire...' onkeyup='affichePeres(this.value,$id_race)' size='20' >";
            echo "<span id='txtPeres'></span>";
          }

          echo "<br><br>";
          echo "<input type='hidden' name='espece' value=$id_espece>";
          echo "<input type='hidden' name='race' value=$id_race>";
          echo "<input type='hidden' name='sexe' value=$sexe>";
          echo "<input type='hidden' name='surnom' value=$surnom>";
          echo "<input type='hidden' name='identifiant' value=$identifiant>";
          echo "<input type='hidden' name='annee_naissance' value=$annee_naissance>";
          echo "<center><input type='submit' name='validation' value= 'Enregistrer ce nouvel animal'></center>";
          echo "</form>";

          $id_espece=$_GET["espece"];
          $id_race=$_GET["race"];
          $id_sexe=$_GET["sexe"];
          $id_mere="NULL";
          $id_pere="NULL";
          $id_famille="NULL";
          if (isset($_GET["id_mere"]))
          {
            $id_mere='"'.$_GET["id_mere"].'"';
            $queryfamille="SELECT id_famille FROM animal WHERE id_animal=$id_mere";

            $resultfamille=mysqli_query($link,$queryfamille) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
            $tabfamille=mysqli_fetch_all($resultfamille); // Création d'un tableau php
            $id_famille="'".$tabfamille[0][0]."'";
          }

          if(isset($_GET["id_pere"]))
          {
            $id_pere="'".$_GET["id_pere"]."'";
          }

          $surnom=$_GET["surnom"];
          $identifiant=$_GET["identifiant"];
          $annee_naissance=$_GET["annee_naissance"];
          $convention=0;
          $attente=1;
          $reforme=0;



          $ajout=" INSERT animal (id_race,id_famille,id_sexe,id_mere,id_pere,surnom,
            identifiant_animal,annee_naissance,statut_reformation,statut_convention,en_attente)
            VALUES ('$id_race',$id_famille,'$id_sexe',$id_mere,$id_pere,'$surnom',
              '$identifiant','$annee_naissance','$reforme','$convention','$attente')";

              if(mysqli_query($link,$ajout)){
                echo "L'animal a bien été ajouté";
              }
            }
          }
          //Fermer la connexion
          mysqli_close($link);
          ?>

        </div></center>
      </div>
      <div class="footer">
        <?php include("../../Style/Pied.html"); ?>
      </div>
    </body>
  </hmtl>
