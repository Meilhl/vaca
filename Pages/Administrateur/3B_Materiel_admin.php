<?php session_start() ; ?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" /> <!--Style_table.css "">-->
  <link rel="stylesheet" type="text/css" href="../../Style/Style_table.css" />

  <title>
    Matériel
  </title>

  <!-- Code javascript qui sert à dynamiser le tableau -->

  <script type="text/javascript" src="/media/js/site.js?_=0c32e5cdbe9b575086edb0b907646184"></script>
  <script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Fzero_configuration.html" async></script>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
  <script type="text/javascript" class="init">


  $(document).ready(function() {
    $('#tableau_mat').DataTable({
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
      <center><div class="border" style="width:auto;height:auto;padding:15px">
        <a href="../Administrateur/Interface_bilan.php">Créer un bilan</a>

        <h1>Tableau récapitulatif du matériel : </h1>

        <a href="3Bbis_Petit_materiel_admin.php">Voir le tableau du petit matériel</a>

        <div class="tableau_recap">


          <?php
          // Lien et ouverture de la base de données vaca
          $link = mysqli_connect('localhost', 'root', '', 'vaca') ;
          mysqli_set_charset($link, "utf8mb4_general_ci") ;
          mysqli_select_db($link, 'vaca')
            or die("Impossible d'ouvrir la BDD vaca : " . mysqli_error($link)) ;
          
        // Script pour supprimer un enregistrement dans la bdd

          if (isset($_GET['suppr'])) {
            $id = $_GET['id'] ;
            $query_supp = 'DELETE FROM materiel WHERE id_materiel = ' . $id ;
            mysqli_query($link, $query_supp)
            or die(mysqli_error()) ;
          }

          // Requête pour récupérer les infos à afficher dans le tableau du grand matériel
          $query1 = 'SELECT materiel.id_materiel as ID, typedemateriel.lib_materiel as Type, plaque as Plaque, nom_materiel as Nom, valeur_achat as Valeur, annee_achat as "Année d\'achat", DATE_FORMAT(date_prochainControle, "%d/%m/%Y") as "Prochain contrôle technique", emplacementM as Documents, nom_exploit as "Localisation actuelle", lieu_stockage as "Lieu de dépôt", retour_depot as "Retour au dépôt", etat_des_lieux as "État des lieux", disponibilite as "Disponibilité"
          FROM materiel
          JOIN typedemateriel ON typedemateriel.id_type_mat = materiel.id_type_mat
          LEFT JOIN exploitation ON exploitation.id_exploit = materiel.id_exploit
          LEFT JOIN docsmateriel ON docsmateriel.id_materiel = materiel.id_materiel
          WHERE materiel.id_type_mat != 7
          GROUP BY materiel.id_materiel' ;

          $result1 = mysqli_query($link, $query1) or die ('pb : ' . mysqli_error($link)) ;
          $tab1 = mysqli_fetch_all($result1) ;
          $ncol = mysqli_num_fields($result1) ;
          $nlig = mysqli_num_rows($result1) ;

          // Récupération des titres des colonnes dans la ligne 0 du tableau $t
          for ($i=0 ; $i<$ncol ; $i++) {
            $titre = mysqli_fetch_field_direct($result1, $i) ;
            $t[0][$i] = $titre -> name ;
          }

          // Requête SQL pour récupérer les noms des champs des tables
          $query2 = 'SELECT materiel.id_materiel, materiel.id_type_mat, plaque, nom_materiel, valeur_achat, annee_achat, DATE_FORMAT(date_prochainControle, "%d/%m/%Y"), emplacementM, nom_exploit, lieu_stockage, retour_depot, etat_des_lieux, disponibilite
          FROM materiel
          JOIN typedemateriel ON typedemateriel.id_type_mat = materiel.id_type_mat
          LEFT JOIN exploitation ON exploitation.id_exploit = materiel.id_exploit
          LEFT JOIN docsmateriel ON docsmateriel.id_materiel = materiel.id_materiel
          WHERE materiel.id_type_mat != 7
          GROUP BY materiel.id_materiel' ;
          $result2 = mysqli_query($link, $query2) or die ('pb : ' . mysqli_error($link)) ;

          // Récupération des noms des champs des tables dans la ligne 1 du tableau $t
          for ($i=0 ; $i<$ncol ; $i++) {
            $titre2 = mysqli_fetch_field_direct($result2, $i) ;
            $t[1][$i] = $titre2 -> name ;
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

          // Fonction utilisée : creerTabHTMLrecapMateriel($tab,$nbcol,$nblig,$t,$id,$col_case,$link,$table_bdd,$col_doc,$doc,$page_modif,$col_exploit,$info_exploit,$col_info)
          // Formulaire pour mettre à jour le tableau_mat si on coche/décoche les cases

          echo '<form name="form1" method="GET" action="3B_Materiel_admin.php">' ;
          creerTabHTMLrecapMateriel($tab1, $ncol, $nlig, $t, "tableau_mat", [10, 11, 12], $link, "materiel", [7], $tab3, "3B2_Modif_materiel.php", 8, $tab4, $col_info, "3B_Materiel_admin.php") ;
          echo '<input type="submit" name="maj" value="Actualiser">' ;
          echo '</form>' ;

          mysqli_free_result($result1); // fermer recordset
          mysqli_close($link);
          ?>
        </div>
        <br><br>

        <!-- Lien qui emmène vers la page d'ajout de matériel -->
        <a href="3B1_Ajout_materiel.php" class="lien_page" style="float:left">Ajouter un nouveau matériel</a>
        <br style="clear:both;">
      </div></center>
    </div>

    <div class="footer">
      <?php include("../../Style/Pied.html"); ?>
    </div>
  </body>
</hmtl>
