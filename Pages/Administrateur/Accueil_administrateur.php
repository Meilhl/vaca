<?php session_start();
if(isset($_GET['modif'])){header('Location:3A2_Modif_animal?id='.$_GET['animal']);}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8mb4_general_ci" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../../Style/Style_table.css"/>
    <link href="../../Style/calendar.css" rel="stylesheet" type="text/css">
    <title>
      Accueil
    </title>

  <!--Affichage tableau-->
    <script type="text/javascript" src="/media/js/site.js?_=0c32e5cdbe9b575086edb0b907646184"></script>
  	<script type="text/javascript" src="/media/js/dynamic.php?comments-page=examples%2Fbasic_init%2Fzero_configuration.html" async></script>
  	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
  	<script type="text/javascript" class="init">

  // fonction  avec parametre pour tableau
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
          info:           "",
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
          info:           "",
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
    <?php $role=1; require("../../Style/Entete.php"); affiche_entete($role);?>
  </div>

  <div class="corps" style="background-color: rgba(159,185,153,0); /*#9FB999 transparent*/">
  <div class="row" style="height:auto;">
    <!-- Diaporama des actus -->
    <div class="column" style='padding-top:5px'>
    <div class="row" style="height:30%">
      <div class="slideshow-container">

      <!-- Actu 1 -->
      <div class="mySlides fade">
          <img class="image" src="../../Image/salonagri.png" style="width : calc(100%/2)"> <!-- Image de l'Actu -->
          <div class="borderactu" style="width:calc(100%/2);overflow:auto">
            <h3 style="color:white">Salon de l'agriculture !</h3>
            <p style="margin : 10px;">Malgré une fermeture anticipée, le Salon se termine sur un fort sentiment d’#agrifierté. Celle des éleveurs, producteurs et élus, qui ont continué à tisser avec les 482 221 visiteurs (633 213 en 2019) de cette 57ème edition le lien indéfectible avec une agriculture qui fait la fierté des Français et sur laquelle le monde pose un regard positif. Pendant 8 jours, pédagogie et volonté de partager, espoirs et perspectives ont été à l’agenda de tous les participants.</p>
          </div>
      </div>

      <!-- Actu 2 -->
      <div class="mySlides fade">
          <img class="image" src="../../Image/grippeaviaire.jpg" style="width : calc(100%/2)">
          <div class="borderactu" style="width : calc(100%/2);overflow:auto">
            <h3 style="color:white">Info Grippe aviaire</h3>
            <p style="margin : 10px;">En l’absence de nouveaux foyers dans la région, des remises en place (repeuplement) sous des conditions strictes ont été rendues possibles depuis le 29 mars dernier dans la zone réglementée du Sud-Ouest. Une période d'assainissement de 3 semaines a été imposée avant la remise en place sous surveillance des animaux. Une visite clinique doit être effectuée 21 jours après l'introduction des animaux par le vétérinaire sanitaire de l'élevage. </p>
          </div>
      </div>

      <!-- Actu 3 -->
      <div class="mySlides fade">
          <img class="image" src="../../Image/alertecani.jpg" style="width : calc(100%/2)">
          <div class="borderactu" style="width : calc(100%/2);overflow:auto">
            <h3 style="color:white">Alerte Canicule</h3>
            <p style="margin : 10px;">"On sera 10-12 degrés au-dessus des normales dans certaines régions, principalement dans le sud-ouest et dans la vallée du Rhône où l'on atteindra les 33-34 degrés.</p>
          </div>
      </div>
    </div>
    </div>

    <!-- Points sous les actus -->
    <div style="text-align:center;height:10px;">
      <span class="dot"></span>
      <span class="dot"></span>
      <span class="dot"></span>
    </div>

  <!-- Rectangle pour le matériel -->
  <div class="row" style="height:auto">
    <div class="border" style='height:auto'>
      <div class="navtop"> <h3 style="padding-left:5px"> <a href="../Administrateur/3B_Materiel_admin.php" style="font-size:2em;">🚚</a>  Materiel </h3></div>
      <div class="tableau_recap" style='transform:scale(0.8);'>
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
          creerTabHTMLrecapMateriel($tab1, $ncol, 3, $t, "tableau_mat", [10, 11, 12], $link, "materiel", [7], $tab3, "3B2_Modif_materiel.php", 8, $tab4, $col_info, "3B_Materiel_admin") ;
      echo '</form>' ;
      echo '<br>' ;
      mysqli_free_result($result1); // fermer recordset
      mysqli_close($link);
      ?>
      </div>
    </div>
  </div>
  <!-- Rectangle pour les animaux  -->
  <div class="row" style="height:auto;margin-bottom: 20px;">
    <div class="border" style='height:auto;'>
      <div class="navtop"> <h3 style="padding-left:5px;"> <a href="../Administrateur/3A_Animaux_admin.php" style="font-size:2em;">🐑</a>  Animaux </h3></div>
      <div class="tableau_recap" style='transform:scale(0.8)'>
      <?php
      //ouverture BDD
      $link = mysqli_connect('localhost', 'root', '', 'vaca') ;
      mysqli_set_charset($link, "utf8_general_ci") ;

      mysqli_select_db($link, 'vaca')
          or die("Impossible d'ouvrir la BDD oiseaudb : " . mysqli_error($link)) ;

      //selection des infos pour afficher dans tableau
      $query1 = 'SELECT DISTINCT animal.id_animal as ID, animal.identifiant_animal as Identifiant, animal.surnom as Surnom, race as Race, espece as Espece, animal.id_sexe as Sexe, animal.annee_naissance as "Date de naissance", famille as Famille, animal_mere.identifiant_animal as "Mère",animal_pere.identifiant_animal as "Père", nom_exploit as Localisation, animal.date_prochainVeto as "Date Vétérinaire" , emplacementA as Documents, animal.statut_reformation as "Réformé", animal.statut_convention as Convention
          FROM animal
          LEFT JOIN animal animal_mere ON animal.id_mere=animal_mere.id_animal
          LEFT JOIN animal animal_pere ON animal.id_pere=animal_pere.id_animal
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

      //recuperation des titres en dur pour creer table car besoin des noms exact des champs pour modif BDD
      $query2 = 'SELECT DISTINCT animal.id_animal, animal.identifiant_animal , animal.surnom, race, espece, animal.id_sexe, animal.annee_naissance , famille, animal_mere.identifiant_animal,animal_pere.identifiant_animal, nom_exploit, animal.date_prochainVeto,  emplacementA, animal.statut_reformation , animal.statut_convention
          FROM animal
          LEFT JOIN animal animal_mere ON animal.id_mere=animal_mere.id_animal
          LEFT JOIN animal animal_pere ON animal.id_pere=animal_pere.id_animal
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

      //selection des documents pour les mettre dans table

      $query3='SELECT id_animal, lienA, emplacementA
          FROM docsanimaux ';

      $result3 = mysqli_query($link, $query3) or die ('pb : ' . mysqli_error($link)) ;

      $tab3 = mysqli_fetch_all($result3) ;

      //selection des infos relative aux exploits
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

     // paramètre à saisir : le tableau, nb de colonnes, nb de lignes, tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre, id à donner au tableau, liste des indices de colonnes qui contiendront des cases à cocher, lien pour BDD
  //                          Nom de table où modif les enregistrements dans bdd, indice colonne pour lien, tableau avec lien et nom des docs, page a renvoyer pour modif, colonne de l'exloit pour avoir info lorsque hover, info a afficher pour exploit
  //                          nombre de colonne de table info
      creerTabHTMLrecap($tab1, $ncol, 3, $t, "tableau_animal", [13,14], $link, "animal",[12],$tab3,"3A2_Modif_animal.php",10,$tab4,$col_info)  ;

      echo '</form>' ;

      mysqli_free_result($result1); // fermer recordset

      mysqli_close($link);

      ?>
  <br>
  <br style="clear:both;">
  </div>
  <br>

    </div>
  </div>

</div>

    <!-- Rappels -->
    <div class="column" style = "float:right">
      <div class="navtop" style="width:auto"> <h3 style="padding-left:5px;"> <a href="../Administrateur/Agenda.php" style="font-size:2em;">📜</a>  Rappels</h3></div>
      <div class="border" style="overflow:auto;height:132%">
          <div class="box-agenda">
            <?php include("../../Fonction/Calendar.php");
            include("../../Fonction/datesConvention.php");
            include("../../Fonction/transportValide.php");
            include("../../Fonction/rappelRDV.php");
            if(isset($calendar)){unset($calendar);}
            $calendar=new Calendar();
            $calendar->set_agenda(FALSE);
            datesConvention($calendar,date('Y-m-d'));

            //$event->add_event();?>
            <center><div class='content home'>
              <?=$calendar?>
            </center></div>

            <!-- Rappels -->
            <div class="row" style="padding:10px;">
              <br>
              <?php
              echo "<hr><h3> Transports récents </h3>";
              transportValide();
              echo "<hr><h3> Rendez-vous </h3>";
              rappelRDV(); ?><hr></p>
            </div>


          <!-- Affichage des animaux récemments ajoutés -->
            <center><div class="navtop" style="width:80%;height:5%"><h3> Animaux récemments ajoutés </h3></div>
            <div class="border" style="width:80%;padding:10px;height:38%;min-height:10%;overflow:auto">

            <?php
            /* Connexion à la base de données*/
            $link=mysqli_connect('localhost','root','','vaca');
            mysqli_set_charset($link,"utf_general_ci");

            /* Choix d'une BDD et message d'erreur si connexion impossible*/
            mysqli_select_db($link,'vaca')
              or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));

            /* if (isset($_GET["valid"]))
            {
                $id=$_GET["animal"];
                $valid= "UPDATE animal SET en_attente='0'
                WHERE id_animal=$id";
                $push=mysqli_query($link,$valid);
            } */

            /* Récupération des identifiant des observateurs ainsi que leurs nom */
            $query1="SELECT id_animal, id_race, identifiant_animal, surnom, id_sexe, annee_naissance
            FROM animal
            WHERE en_attente='1'";

            //Exécution de la requête et production d'un recordset
            $result1=mysqli_query($link,$query1) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
            $tab1=mysqli_fetch_all($result1); // Création tableau php

            $nbligne=mysqli_num_rows($result1);
            $nbcol=mysqli_num_fields($result1);

            for ($i=0; $i < $nbligne; $i++)				//boucle parcourant chaque colonne du recordset,
            		{
                  echo "<p style='text-align:left;width:auto;float:left'>";
                        for ($j=1; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
            			    {
                            if ($j==1)
                            {
                                $query2="SELECT race FROM race WHERE id_race=".$tab1[$i][$j]."";
                                //Exécution de la requête et production d'un recordset
                                $result2=mysqli_query($link,$query2) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
                                $tab2=mysqli_fetch_all($result2); // Création tableau php
                                echo $tab2[0][0]; echo " / ";
                            }
                            else
                            {
                            if ($j==$nbcol-1)
                                {echo $tab1[$i][$j]." ";}

                            else
                                {echo $tab1[$i][$j]." / ";}
                            }

                        }
                      echo "</p>";
                      /* echo "<form><input style='font-size: 1em;' type='submit' name='valid' value='ok'>"; */
                      echo "<form><input style='font-size: 1em;' type='submit' name='modif' value='modifier'>";
                      echo "<input type='hidden' name='animal' value=".$tab1[$i][0].">";
                      echo "<br>";
                      echo "</form>";
                      
                  }

            mysqli_close($link);
            ?>
          </div>
          </center>
      </div>
  </div>

  <br style="clear:both;">
    <!-- Script pour faire défiler le diapo -->
    <script>
      let slideIndex = 0;
      showSlides();
      function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        setTimeout(showSlides, 10000); // Change image every 5 seconds
      }
    </script>
  </div>
  <br>
    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</html>