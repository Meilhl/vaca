<?php
//ouverture de session
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Création consentement
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
    <center><div class="border" style="width:auto;height:auto">
    <a href="../Utilisateur/1A_Demande_animaux.php">Nouvelle demande Animaux</a>
    <a href="../Utilisateur/1B_Demande_materiel.php">Nouvelle demande materiel</a>
    <div class="">


      <!-- Exemple de génération pour une race donnée -->
      <form action='../../Fonction/generationPDFconsentement.php' name='form_pdf' target='_blank' onsubmit=modificationBDD()>
        <br><input type='submit' value="Prévisualisation fiche de consentement actuelle" name='test_pdf'></form>
        <br><hr><br>
      </div>

      <div class="">
        <!-- Ajout des blocs -->
        <?php
        $link=mysqli_connect('Localhost','root','','vaca');
        mysqli_set_charset($link,"utf8mb4_general_ci");
        mysqli_select_db($link,'vaca')
        or die ("impossible d'ouvrir la BDD: ". mysqli_error($link));

        /*Récupération des titres et des différents blocs de text */
        $queryText="SELECT id_bloc_convention, lib_bloc, text
        FROM textconvention";
        $resultText=mysqli_query($link, $queryText)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
        $tabText=mysqli_fetch_all($resultText);
        mysqli_free_result($resultText);

        /*Récupération des données (titre et libellé) de la BDD*/
        for ($i=0;$i<count($tabText);$i++){
          if ($tabText[$i][1]=="titre_consentement"){
            $lib_fiche_consentement=$tabText[$i][1];
            $titre_fiche_consentement=$tabText[$i][2];}
            if ($tabText[$i][1][0]=="p"){ //la première lettre du libellé du titre de la page et p on s'en sert pour repérer les titres de pages
              $lib_page_consentement[]=$tabText[$i][1];
              $page_consentement[]=$tabText[$i][2];}
              elseif ($tabText[$i][1][0]=="b"){  // de même pour le les blocs
                $lib_bloc_consentement[]=$tabText[$i][1];
                $bloc[]=$tabText[$i][2];}
              }?>


              <form method="POST" action="Modification_Consentement.php" name="form_modif_consent">
                <?php
                include ("../../Fonction/affichageTextarea.php");

                /*Affichage et zone de saisie*/
                $array=array('titre_consentement','page_consentement_1','bloc_1','page_consentement_2','bloc_2','bloc_3','bloc_4','racepdf');
                /*Titre de la fiche*/
                echo "Titre fiche de consentement: ";
                affichageTextarea($array[0],$titre_fiche_consentement,5,100);
                echo "<strong> [NOM DE LA RACE]</strong><br><br>";
                /*Textarea page 1*/
                echo "<br><hr><br>Titre de la première page";
                affichageTextarea($array[1],$page_consentement[0],5,100);
                echo "Saisie texte de la première page";
                affichageTextarea($array[2],$bloc[0],15,200);

                /*Textarea page 2*/
                echo "<br><hr><br>Titre de la seconde page";
                affichageTextarea($array[3],$page_consentement[1],5,100);
                echo "Saisie du premier bloc de texte de la seconde page";
                affichageTextarea($array[4],$bloc[1],15,200);
                echo "<strong> [NOM DE LA RACE]</strong><br>";
                echo "Saisie du deuxième bloc de texte de la seconde page";
                affichageTextarea($array[5],$bloc[2],15,200);
                echo "<strong> [LISTE DES ASSOCIATIONS]</strong><br>";
                echo "Saisie du troisième bloc de texte de la seconde page";
                affichageTextarea($array[6],$bloc[3],15,200);
                /*Récupération de la race */
                $queryRace="SELECT id_race, race
                FROM race";
                $resultRace=mysqli_query($link, $queryRace)
                or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
                $tabRace=mysqli_fetch_all($resultRace);
                mysqli_free_result($resultRace);
                $racepdf="racepdf";
                if (isset($_POST["racepdf"])){
                  $SelectRace=$_POST["racepdf"];
                }
                else{
                  $SelectRace=$tabRace[0][0];
                }

                echo "<br><h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>[Optionnel] Choisissez une race pour faire des tests :</h2>";
                require("../../Fonction/creerListeHTML2.php");
                creerListeHTML2($racepdf,$tabRace,$SelectRace);
                ?>
                <!-- Validation des textes -->
                <br><br><input type=submit name='valider_consentement' value='Valider la fiche de consentement' col=3 rows=50></form>

                <?php

                /*et modificatin de la BDD*/
                include("../../Fonction/modifBDD_textconv.php");
                if (isset($_POST['valider_consentement'])){
                  foreach($array as $value){
                    modifBDD_textconv($value);
                  }
                }
                ?>
              </div>
            </div></center>
            </div>

            <div class="footer">
              <?php include("../../Style/Pied.html"); ?>
            </div>
          </body>
        </hmtl>
