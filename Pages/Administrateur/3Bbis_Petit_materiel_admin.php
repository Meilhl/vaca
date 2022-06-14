<?php session_start() ; ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" /> <!--Style_table.css "">-->
  <link rel="stylesheet" type="text/css" href="../../Style/Style_table.css" />

  <title>
    Petit matériel
  </title>

  <!-- Code javascript qui sert à dynamiser le tableau -->

  <script type="text/javascript" src="/media/js/site.js?_=0c32e5cdbe9b575086edb0b907646184"></script>
  <script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Fzero_configuration.html" async></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
  <script type="text/javascript" class="init">



  $(document).ready(function() {
    $('#tableau_petit_mat').DataTable({
      "lengthMenu": [[10, 50, 100, 200, -1], [10, 50, 100, 200, "All"]],
      "pageLength" : 50,
      "scrollY": "400px",
      "scrollCollapse": true,
      "paging": false,
      language: {
        processing:     "Traitement en cours...",
        search:         "Filtrer le tableau &nbsp;:",
        lengthMenu:     "Afficher _MENU_ items",
        info:           "Affichage de _TOTAL_ items",
        infoEmpty:      "Affichage de 0 item",
        infoFiltered:   "(filtr&eacute; de _MAX_ items au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun item à afficher",
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
      $role=1;
      require("../../Style/Entete.php");
      affiche_entete($role); ?>

    </div>

    <div class="corps">
      <center><div class="border" style="width:auto;height:auto;padding:15px"
      <a href="../Administrateur/Interface_bilan.php">Bilan</a>

      <h1>Tableau récapitulatif du petit matériel : </h1>

      <a href="3B_Materiel_admin.php">Voir le tableau du gros matériel</a>

      <div class="tableau_recap">


        <?php

        // Lien et ouverture de la base de données vaca

        $link = mysqli_connect('localhost', 'root', '', 'vaca') ;
        mysqli_set_charset($link, "utf8mb4_general_ci") ;

        mysqli_select_db($link, 'vaca')
        or die("Impossible d'ouvrir la BDD vaca : " . mysqli_error($link)) ;


        // Partie du code effectuée si on est passé par la page 3B2_Suppression_materiel

        if (isset($_GET['bt_suppr'])) {

          // Récupération de la quantité à supprimer choisie et conversion en integer

          $nb_suppr = $_GET['nb_suppr'] ;
          $nb_suppr = intval($nb_suppr) ;

          // Récupération de l'id et du nom

          $id = $_GET['id'] ;
          $nom = $_GET['nom'] ;


          // Requête pour récupérer tous les id des élements de même nom
          $query_noms = 'SELECT id_materiel
          FROM materiel
          WHERE nom_materiel = "' . $nom . '"' ;

          $result_noms = mysqli_query($link, $query_noms) or die ('pbnoms : ' . mysqli_error($link)) ;

          $tab_noms = mysqli_fetch_all($result_noms) ;
          $nblig = mysqli_num_rows($result_noms) ;
          $nbcol = mysqli_num_fields($result_noms) ;

          // Boucle pour supprimer autant d'éléments du même nom que la quantité sélectionnée

          for ($l=0 ; $l < $nb_suppr ; $l++) {
            $query_suppr = 'DELETE FROM materiel WHERE id_materiel = ' . $tab_noms[$l][0] ;
            mysqli_query($link, $query_suppr) ;
          }

            $tab_noms = mysqli_fetch_all($result_noms) ;
            $nblig = mysqli_num_rows($result_noms) ;
            $nbcol = mysqli_num_fields($result_noms) ;

            // Boucle pour supprimer autant d'éléments du même nom que la quantité sélectionnée

            if ($nb_suppr > $nblig ) {
                $nb_suppr = $nblig ;
            }

            for ($l=0 ; $l < $nb_suppr ; $l++) {
                $query_suppr = 'DELETE FROM materiel WHERE id_materiel = ' . $tab_noms[$l][0] ;
                mysqli_query($link, $query_suppr) ;
            }

        }

        // Requête pour récupérer les infos à afficher dans le tableau du petit matériel

        $query1_pm = 'SELECT materiel.id_materiel as ID, typedemateriel.lib_materiel as Type, nom_materiel as Nom, COUNT(*) as "Quantité", valeur_achat as "Valeur unitaire", emplacementM as Documents, nom_exploit as "Localisation actuelle", lieu_stockage as "Lieu de dépôt", retour_depot as "Retour au dépôt", disponibilite as "Disponibilité"
        FROM materiel
        JOIN typedemateriel ON typedemateriel.id_type_mat = materiel.id_type_mat
        LEFT JOIN exploitation ON exploitation.id_exploit = materiel.id_exploit
        LEFT JOIN docsmateriel ON docsmateriel.id_materiel = materiel.id_materiel
        WHERE materiel.id_type_mat = 7
        GROUP BY nom_materiel, materiel.id_exploit' ;

        $result1_pm = mysqli_query($link, $query1_pm) or die ('pb : ' . mysqli_error($link)) ;

        $tab1_pm = mysqli_fetch_all($result1_pm) ;
        $ncol_pm = mysqli_num_fields($result1_pm) ;
        $nlig_pm = mysqli_num_rows($result1_pm) ;

        // Récupération des titres des colonnes dans la ligne 0 du tableau $t_pm
        for ($i=0 ; $i<$ncol_pm ; $i++) {
          $titre = mysqli_fetch_field_direct($result1_pm, $i) ;
          $t_pm[0][$i] = $titre -> name ;

        }


        // Requête SQL pour récupérer les noms des champs des tables
        $query2_pm = 'SELECT materiel.id_materiel, typedemateriel.lib_materiel, nom_materiel, COUNT(*), valeur_achat, emplacementM, nom_exploit, lieu_stockage, retour_depot, disponibilite
        FROM materiel
        JOIN typedemateriel ON typedemateriel.id_type_mat = materiel.id_type_mat
        LEFT JOIN exploitation ON exploitation.id_exploit = materiel.id_exploit
        LEFT JOIN docsmateriel ON docsmateriel.id_materiel = materiel.id_materiel
        WHERE materiel.id_type_mat = 7
        GROUP BY nom_materiel, materiel.id_exploit' ;

        $result2_pm = mysqli_query($link, $query2_pm) or die ('pb : ' . mysqli_error($link)) ;

        // Récupération des noms des champs des tables dans la ligne 1 du tableau $t_pm
        for ($i=0 ; $i<$ncol_pm ; $i++) {
          $titre2 = mysqli_fetch_field_direct($result2_pm, $i) ;
          $t_pm[1][$i] = $titre2 -> name ;

        }


        // Requête SQL tableau pour récupérer les infos pour les liens des documents

        $query3='SELECT id_materiel, lienM, emplacementM
        FROM docsmateriel ';

        $result3 = mysqli_query($link, $query3) or die ('pb : ' . mysqli_error($link)) ;

        $tab3 = mysqli_fetch_all($result3) ;


        // Requête SQL pour récupérer les infos de contact par exploitation

        $query4='SELECT nom_exploit, adresse, commune, code_postal, nom, prenom, tel, mail
        FROM  exploitation
        JOIN attributiondesexploitations ON exploitation.id_exploit=attributiondesexploitations.id_exploit
        JOIN profil ON profil.id_profil=attributiondesexploitations.id_profil
        LEFT JOIN contact ON profil.id_profil=contact.id_profil
        JOIN commune ON commune.id_commune=exploitation.id_commune';

        $result4 = mysqli_query($link, $query4) or die ('pb : ' . mysqli_error($link)) ;

        $tab4 = mysqli_fetch_all($result4) ;
        $col_info = mysqli_num_fields($result4) ;



        // Appel de la fonction de création et affichage de tableau
        require("../../Fonction/creerTabHTMLrecapMateriel.php") ;


        // Formulaire pour mettre à jour le tableau_petit_mat si on coche/décoche les cases

        echo '<form name="form_pm" method="GET" action="3Bbis_Petit_materiel_admin.php">' ;

            creerTabHTMLrecapMateriel($tab1_pm, $ncol_pm, $nlig_pm, $t_pm, "tableau_petit_mat", [8, 9], $link, "materiel", [5], $tab3, "3B1_Ajout_materiel.php", 6, $tab4, $col_info, "3B2_Suppression_materiel.php") ;

            echo '<input type="submit" name="maj" value="Mettre à jour">' ;

        echo '</form>' ;


        mysqli_free_result($result1_pm); // fermer recordset

        mysqli_close($link);

        ?>


      </div>

      <br><br>

      <!-- Lien qui emmène vers la page d'ajout de matériel -->

      <a href="3B1_Ajout_materiel.php" class="lien_page">Ajouter un nouveau matériel</a>

      <br style="clear:both;">

    </div>

    <div class="footer">
      <?php include("../../Style/Pied.html"); ?>
    </div>
  </body>

</hmtl>
