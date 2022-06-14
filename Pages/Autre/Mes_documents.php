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
    Mes documents
  </title>

  <!-- besoin pour tableau import biblio JS, et script JS-->

  <script type="text/javascript" src="/media/js/site.js?_=0c32e5cdbe9b575086edb0b907646184"></script>
  <script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Fzero_configuration.html" async></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
  <script type="text/javascript" class="init">


  $(document).ready(function() {
    $('#tableau_doc_eleveur').DataTable({
      "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]],
      "pageLength" : 50,
      "scrollY": "500px",
      "scrollCollapse": true,
      "paging": false,
      language: {
        processing:     "Traitement en cours...",
        search:         "Filtrer le tableau &nbsp;:",
        lengthMenu:    "Afficher _MENU_ documents",
        info:           "Affichage de _END_ documents sur _TOTAL_ documents",
        infoEmpty:      "Affichage de 0 documents",
        infoFiltered:   "(filtr&eacute; de _MAX_ documents au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun document à afficher",
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
      <h1>Mes documents</h1>

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

        //on récupère l'id du profil pour savoir qui est connecté et de ne lui montrer que ce qu'il a le droit de voir
        $id_profil= $_SESSION["id_profil"];
        $id_type_profil = $_SESSION["id_type_profil"];

        //selection des infos des docs du profil de l'éleveur
        $query_info_eleveur= "SELECT id_doc_profil as 'Identifiant du document', lib_docsP as 'Type de document', emplacementP as 'Documents'
        FROM docsprofil
        JOIN typedocsprofil ON docsprofil.id_typeP=typedocsprofil.id_typeP
        WHERE id_profil=".$id_profil;

        $result_info_eleveur = mysqli_query($link, $query_info_eleveur) or die ('pb : ' . mysqli_error($link)) ;

        $tab_info_eleveur = mysqli_fetch_all($result_info_eleveur) ;
        $ncol = mysqli_num_fields($result_info_eleveur) ;
        $nlig = mysqli_num_rows($result_info_eleveur) ;

        for ($i=0 ; $i<$ncol ; $i++) {
          $titre = mysqli_fetch_field_direct($result_info_eleveur, $i) ;
          $t[0][$i] = $titre -> name ;
        }

        //selection des docs du profil de l'éleveur
        $query_doc_eleveur= "SELECT id_doc_profil, lienP, emplacementP FROM docsprofil WHERE id_profil=".$id_profil;
        $result_doc_eleveur = mysqli_query($link, $query_doc_eleveur) or die ('pb : ' . mysqli_error($link)) ;
        $tab_doc_eleveur = mysqli_fetch_all($result_doc_eleveur) ;


        //appel du document contenant la fonction pour faire le tableau
        require("../../Fonction/creerTabHTMLAnimauxEleveur.php") ;
        //AJOUT D'UNE COLONNE POUR SUPPRIMER LE DOC?
        creerTabHTMLAnimauxEleveur($tab_info_eleveur, $ncol, $nlig, $t, "tableau_doc_eleveur", [2],$tab_doc_eleveur) ;

        //fermer les recordsets et la bdd
        mysqli_free_result($result_info_eleveur);
        mysqli_free_result($result_doc_eleveur);
        mysqli_close($link);
        ?>

        <br style="clear:both;">

        <a href="Ajout_document.php">ajouter un document</a>

      </div>
    </div></center>
    </div>

    <div class="footer">
      <?php include("../../Style/Pied.html"); ?>

    </div>

  </body>
</hmtl>
