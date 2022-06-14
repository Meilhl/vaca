<?php
//ouverture de session
session_start();
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Modification animal
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
    $role=1;
    require("../../Style/Entete.php");
    require("../../Fonction/creerListeHTML2.php");
    require("../../Fonction/creerTabHTML.php");
    require("../../Fonction/creerListeHTML1val.php");
    require("../../Fonction/creerListeHTMLsex.php");
    require('../../Fonction/creerListeHTMLfin.php');
    require("../../Fonction/transform_requete.php");

    affiche_entete($role); ?>
    <br>
  </div>

  <div class="corps" style="background-color: rgba(159,185,153,0);">
    <center><div class="border" style='width:35%;padding:20px;height:auto'>
"'
      <?php

      /* Connexion à la base de données*/
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      /* Choix d'une BDD et message d'erreur si connexion impossible*/
      mysqli_select_db($link,'vaca')
      or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));

      $link_genis=mysqli_connect('localhost','root','','genis');
        mysqli_set_charset($link_genis,"utf8mb4_general_ci");
      
      $id=$_GET['id'];
      $bigquery="SELECT id_race, surnom, identifiant_animal, annee_naissance, id_sexe, id_mere, id_pere,statut_reformation,statut_convention
      FROM animal
      Where id_animal='$id'";

      //Exécution de la requête et production d'un recordset
      $resultbig=mysqli_query($link,$bigquery) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
      $tabbig=mysqli_fetch_all($resultbig); // Création tableau php

      $id_race=$tabbig[0][0];
      $surnom=$tabbig[0][1];
      $identifiant=$tabbig[0][2];
      $annee_naissance=$tabbig[0][3];
      $sexe=$tabbig[0][4];
      $mere=$tabbig[0][5];
      $pere=$tabbig[0][6];
      $convention=$tabbig[0][7];
      $reforme=$tabbig[0][8];

      //Récupération de l'identifiant dans la base de données genis pour les requêtes ultérieurs
      $genis_recid="SELECT id_animal FROM animal WHERE no_identification='$identifiant'";
      $result_recid=mysqli_query($link_genis,$genis_recid) or die("Impossible d'ouvrir la BDD genis:".mysqli_error($link_genis));
      $id_genis=mysqli_fetch_all($result_recid)[0][0];
      
      echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> 🐄 Modification d'un animal </h3> <hr>";
      // Récupère les identifiant des départments et leurs noms
      $query2="SELECT id_race, race FROM race";
      //Exécution de la requête et production d'un recordset
      $result2=mysqli_query($link,$query2) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
      $tab2=mysqli_fetch_all($result2); // Création d'un tableau php

      $tabsex=[['F','M','H'],['Femelle','Mâle','Mâle castré']];

      echo "<form style='text-align:left;' action='3A2_Modif_animal.php' method='GET'>";
      echo "<label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Race :</label>";
      echo "<center>";
      creerListeHTML2("race",$tab2,$id_race);
      echo "</center>";

      echo "<label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Sexe :</label>";
      echo "<center>";
      creerListeHTMLsex("sexe",$tabsex,$sexe);
      echo "</center>";

      echo "<br><center><input type='text' name='surnom' placeholder='Surnom' value=$surnom></center>";

      ?>
      <br><center><input type='text' placeholder='Identifiant national' name='identifiant' value="<?php echo $identifiant;?>"></center>
      <?php

      echo "<br><center><input type='text' name='annee_naissance' value=$annee_naissance></center>";

      $querymere= "SELECT id_animal, identifiant_animal, surnom, annee_naissance
      FROM animal
      Where id_race=$id_race 
      and id_sexe='F'";

      $resultmere=mysqli_query($link,$querymere) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
      $tabmere=mysqli_fetch_all($resultmere); // Création d'un tableau php
      $nblig=mysqli_num_rows($resultmere);
      $nbco=mysqli_num_fields($resultmere);

      echo "<br><label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Mère de l'animal :</label>";
      echo "<center>";
      creerListeHTMLfin("id_mere",$tabmere,$nbco,$nblig,$mere);
      echo "</center>";


      if ($pere!="")
      {
        $querypere= "SELECT id_animal, identifiant_animal, surnom, annee_naissance
        FROM animal
        Where id_race=$id_race and id_sexe='M'";

        $resultpere=mysqli_query($link,$querypere) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
        $tabpere=mysqli_fetch_all($resultpere); // Création d'un tableau php
        $nbli=mysqli_num_rows($resultpere);
        $nbc=mysqli_num_fields($resultpere);

        echo "<br><label style='font-size:1em;font-family:Verdana;font-weight:bold;'>Mère de l'animal :</label>";
        echo "<center>";
        creerListeHTMLfin("id_pere",$tabpere,$nbc,$nbli,$pere);
        echo "<center>";
      }
      echo "<input type=hidden name='id' value=$id>";
      echo "<input type=hidden name='id_genis' value=$id_genis>";
      echo "<br><br><center><input type='submit' name='validation' value= 'Enregistrer'></center>";
      echo "</form>";
    ?>
    <?php
      if (isset($_GET["race"]))
      {
        $id=$_GET['id'];
        $id_genis=$_GET['id_genis'];
        $id_race=$_GET["race"];
        $id_sexe=$_GET["sexe"];
        $id_mere="NULL";
        $id_pere="NULL";
        if (isset($_GET["id_mere"]))
        {
          $id_mere=$_GET["id_mere"];
        }

        if(isset($_GET["id_pere"]))
        {
          $id_pere=$_GET["id_pere"];
        }

        $surnom=$_GET["surnom"];
        $identifiant=$_GET["identifiant"];
        $annee_naissance=$_GET["annee_naissance"];

        //tableaux des id pour les champs des BDD 
        $id_race_vaca = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
        $id_race_genis = array(19,5,6,3,4,2,7,8,9,10,11,12,13,14,15,16,31,17,18,24);
    
        $tabsex_vaca=["'F'","'M'","'H'"];
        $tabsex_genis=[1,2,3];
        // Construction des tableaux de correspondance
        $arrmacth_id_race = match_tab_builder($id_race_vaca,$id_race_genis);
        $arrmatch_sexe = match_tab_builder($tabsex_vaca, $tabsex_genis);
        $code_race = $arrmacth_id_race[$id_race];
        $sexe_genis = $arrmatch_sexe["'$id_sexe'"];
        $date_naiss = "$annee_naissance" . "-01-01";


        $ajout="UPDATE animal SET id_race='$id_race',id_sexe='$sexe',id_mere='$id_mere',id_pere=$id_pere,surnom='$surnom',
        identifiant_animal='$identifiant',annee_naissance='$annee_naissance'
        WHERE id_animal='$id'";

        $modif_genis =" UPDATE animal SET code_race='$code_race',sexe='$sexe_genis',id_mere='$id_mere',id_pere=$id_pere,nom_animal='$surnom',
        no_identification='$identifiant',date_naiss='$date_naiss'
        WHERE id_animal='$id_genis'" ;
        
        if ($push=mysqli_query($link,$ajout)){
          echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;'>Les modifications ont bien été enregistrées !</h2>";
        }
        
        $push_genis=mysqli_query($link_genis,$modif_genis);
      }

      //Fermer la connexion
      mysqli_close($link);
      mysqli_close($link_genis);
      ?>

    </div></center>
  </div>

  <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
  </div>
</body>
</hmtl>
