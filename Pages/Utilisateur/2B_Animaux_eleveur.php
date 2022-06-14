<?php
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="../../Style/Style_table.css" media="all" />
  <title>
    Mes animaux
  </title>

  <!-- besoin pour tableau import biblio JS, et script JS-->

  <script type="text/javascript" src="/media/js/site.js?_=0c32e5cdbe9b575086edb0b907646184"></script>
  <script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Fzero_configuration.html" async></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
  <script type="text/javascript" class="init">


  $(document).ready(function() {
    $('#tableau_animaux_eleveur').DataTable({
      "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]],
      "pageLength" : 50,
      "scrollY": "500px",
      "scrollCollapse": true,
      "paging": false,
      language: {
        processing:     "Traitement en cours...",
        search:         "Filtrer le tableau &nbsp;:",
        lengthMenu:    "Afficher _MENU_ animaux",
        info:           "Affichage de _END_ animaux sur _TOTAL_ animaux",
        infoEmpty:      "Affichage de 0 animaux",
        infoFiltered:   "(filtr&eacute; de _MAX_ animaux au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun animal à afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
          first:      "Premier",
          previous:   "Pr&eacute;c&eacute;dent",
          next:       "Suivant",
          last:       "Dernier"
        },

        aria: {
          sortAscending:  ": activer pour trier la colonne par ordre croissant",
          sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }}
      });
    } );

    </script>
  </head>
  <body>
    <div class= "header">
      <?php
      $role=2;
      require("../../Style/Entete.php");
      affiche_entete($role);
      ?>
      <br>
    </div>

    <div class="corps">
      <center><div class="border" style="width:auto;height:auto;padding:15px">
        <h1>Tableau récapitulatif des animaux</h1>
        <div class="tableau_recap" >


          <?php
          //on récupère l'id du profil pour savoir qui est connecté et de ne lui montrer que ce qu'il a le droit de voir
          $id_profil= $_SESSION["id_profil"];
          $id_type_profil = $_SESSION["id_type_profil"];

          //ouverture BDD
          $link = mysqli_connect('localhost', 'root', '', 'vaca') ;
          mysqli_set_charset($link, "utf8mb4_general_ci") ;

          mysqli_select_db($link, 'vaca')
          or die("Impossible d'ouvrir la BDD vaca : " . mysqli_error($link)) ;

          //selection des infos des animaux en sélectionnant ceux associés à l'éleveur
          $query_info_animal = 'SELECT DISTINCT animal.id_animal as ID, animal.identifiant_animal as Identifiant, animal.surnom as Surnom, race as Race, espece as Espece,
          animal.id_sexe as Sexe, animal.annee_naissance as "Date de naissance", famille as Famille, animal_mere.identifiant_animal as "Mère",
          animal_pere.identifiant_animal as "Père", animal.date_prochainVeto as "Date prochain RDV Véto", emplacementA as Documents
          FROM animal
          LEFT JOIN animal animal_mere ON animal.id_mere = animal_mere.id_animal
          LEFT JOIN animal animal_pere ON animal.id_pere=animal_pere.id_animal
          JOIN race ON race.id_race = animal.id_race
          JOIN espece ON espece.id_espece = race.id_espece
          LEFT JOIN famille ON animal.id_famille = famille.id_famille
          LEFT JOIN docsanimaux ON docsanimaux.id_animal = animal.id_animal
          LEFT JOIN exploitation ON animal.id_exploit=exploitation.id_exploit
          JOIN attributiondesexploitations ON attributiondesexploitations.id_exploit = exploitation.id_exploit
          WHERE attributiondesexploitations.id_profil = '.$id_profil.'
          GROUP BY animal.id_animal';

          $result_info_animal = mysqli_query($link, $query_info_animal) or die ('pb : ' . mysqli_error($link)) ;

          $tab_info_animal = mysqli_fetch_all($result_info_animal) ;
          $ncol = mysqli_num_fields($result_info_animal) ;
          $nlig = mysqli_num_rows($result_info_animal) ;

          //recuperation des titres pour en-tête du tableau
          for ($i=0 ; $i<$ncol ; $i++) {
            $titre = mysqli_fetch_field_direct($result_info_animal, $i) ;
            $t[0][$i] = $titre -> name ;

          }

          //selection tableau pour les documents dans table
          $query_doc='SELECT id_animal, lienA, emplacementA FROM docsanimaux ';
          $result_doc = mysqli_query($link, $query_doc) or die ('pb : ' . mysqli_error($link)) ;
          $tab_doc = mysqli_fetch_all($result_doc) ;

          require("../../Fonction/creerTabHTMLAnimauxEleveur.php") ;

          creerTabHTMLAnimauxEleveur($tab_info_animal, $ncol, $nlig, $t, "tableau_animaux_eleveur", [11],$tab_doc)  ; //changer en tabrecap des que rceup fichier modif Pauline

          // fermer recordset et la bdd
          mysqli_free_result($result_info_animal);
          mysqli_close($link);
          ?>
          <br style="clear:both;">
          <a href="../Utilisateur/2B1_Ajout_animaux_eleveur.php">Ajouter un animal</a>
        </div></center>
      </div>
      <div class="footer">
        <?php include("../../Style/Pied.html"); ?>
      </div>
    </body>
  </hmtl>
