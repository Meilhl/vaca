<?php session_start(); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../Style/Style_table.css"/>

    <title>
		Animaux
	</title>
    
    <!-- besoin pour tableau import biblio JS, et script JS-->
    
<script type="text/javascript" src="/media/js/site.js?_=0c32e5cdbe9b575086edb0b907646184"></script>
	<script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Fzero_configuration.html" async></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
	<script type="text/javascript" class="init">


$(document).ready(function() {
	$('#tableau_animal').DataTable({
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
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
    </div>
    
    <div class="corps">
    <a href="../Administrateur/Interface_bilan.php">Bilan</a>
    <h1>Tableau récapitulatif des animaux</h1>
        <div class="tableau_recap" >
        

        <?php
        //ouverture BDD
        $link = mysqli_connect('localhost', 'root', '', 'vaca') ;
        mysqli_set_charset($link, " utf8mb4_general_ci ") ;

        mysqli_select_db($link, 'vaca') 
            or die("Impossible d'ouvrir la BDD oiseaudb : " . mysqli_error($link)) ;

        //selection des infos pour afficher dans tableau 
        $query1 = 'SELECT DISTINCT animal.id_animal as ID, animal.identifiant_animal as Identifiant, animal.surnom as Surnom, race as Race, espece as Espece, animal.id_sexe as Sexe, animal.annee_naissance as "Date de naissance", famille as Famille, animal_mere.identifiant_animal as "Mère", nom_exploit as Localisation , emplacementA as Documents, animal.statut_reformation as "Réformé", animal.statut_convention as Convention
            FROM animal 
            LEFT JOIN animal animal_mere ON animal.id_mere=animal_mere.id_animal
            JOIN race ON race.id_race=animal.id_race
            JOIN espece ON espece.id_espece=race.id_espece
            LEFT JOIN famille ON animal.id_famille=famille.id_famille
            LEFT JOIN docsanimaux on docsanimaux.id_animal=animal.id_animal
            LEFT JOIN exploitation ON animal.id_exploit=exploitation.id_exploit
            GROUP BY animal.id_animal
            ';
         
        $result1 = mysqli_query($link, $query1) or die ('pb : ' . mysqli_error($link)) ;

        $tab1 = mysqli_fetch_all($result1) ;
        $ncol = mysqli_num_fields($result1) ;
        $nlig = mysqli_num_rows($result1) ;

        for ($i=0 ; $i<$ncol ; $i++) {
            $titre = mysqli_fetch_field_direct($result1, $i) ;
            $t[0][$i] = $titre -> name ;
            
        }
        
        //recuperation des titres en dur pour creer table
        $query2 = 'SELECT DISTINCT animal.id_animal, animal.identifiant_animal , animal.surnom, race, espece, animal.id_sexe, animal.annee_naissance , famille, animal_mere.identifiant_animal, nom_exploit,  emplacementA, animal.statut_reformation , animal.statut_convention 
            FROM animal 
            LEFT JOIN animal animal_mere ON animal.id_mere=animal_mere.id_animal
            JOIN race ON race.id_race=animal.id_race
            JOIN espece ON espece.id_espece=race.id_espece
            LEFT JOIN famille ON animal.id_animal=famille.id_famille
            LEFT JOIN docsanimaux on docsanimaux.id_animal=animal.id_animal
            LEFT JOIN exploitation ON animal.id_exploit=exploitation.id_exploit
            GROUP BY animal.id_animal
            ';
        
        $result2 = mysqli_query($link, $query2) or die ('pb : ' . mysqli_error($link)) ;
        
        // Récupération des titres de colonnes dans une liste
        for ($i=0 ; $i<$ncol ; $i++) {
            $titre2 = mysqli_fetch_field_direct($result2, $i) ;
            $t[1][$i] = $titre2 -> name ;
            
        }
        
        //selection tableau pour les documents dans table
        
        $query3='SELECT id_animal, lienA, emplacementA 
            FROM docsanimaux ';
        
        $result3 = mysqli_query($link, $query3) or die ('pb : ' . mysqli_error($link)) ;
        
        $tab3 = mysqli_fetch_all($result3) ;
        
        $query4='SELECT nom_exploit, adresse, commune, code_postal, nom, prenom, tel, mail
            FROM  exploitation
            JOIN attributiondesexploitations ON exploitation.id_exploit=attributiondesexploitations.id_exploit
            JOIN profil ON profil.id_profil=attributiondesexploitations.id_profil
            LEFT JOIN contact ON profil.id_profil=contact.id_profil
            JOIN commune ON commune.id_commune=exploitation.id_commune';
        
        $result4 = mysqli_query($link, $query4) or die ('pb : ' . mysqli_error($link)) ;
        
        $tab4 = mysqli_fetch_all($result4) ;
        $col_info = mysqli_num_fields($result4) ;
        
        echo '<form name="form1" method="GET" action="3A_Animaux_admin.php">' ;
        

        require("../../Fonction/creerTabHTMLrecap.php") ;

        creerTabHTMLrecap($tab1, $ncol, $nlig, $t, "tableau_animal", [11,12], $link, "animal",[10],$tab3,"3A1_Ajout_animal.php",9,$tab4,$col_info)  ; //changer en tabrecap des que rceup fichier modif Pauline 

        echo '<input type="submit" name="maj" value="Mettre à jour">' ;

        echo '</form>' ;
        
        mysqli_free_result($result1); // fermer recordset

        mysqli_close($link);

        ?>
    <br><br>
    <a href="3A1_Ajout_animal.php" class="lien_page">Ajouter un nouvel animal</a>
    <br style="clear:both;">    
    </div>
    </div>
    
    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>