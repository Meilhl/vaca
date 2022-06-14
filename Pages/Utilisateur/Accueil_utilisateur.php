<?php session_start();?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <link href="../../Style/calendar.css" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <title>
    Accueil
  </title>
</head>
<body>
  <div class= "header">
    <?php
    $role=2;
    require("../../Style/Entete.php");
    affiche_entete($role);
    //recuperrer le indentifiant de la page de authentification et passe à suivant
    $identifiant_profil= $_SESSION['identifiant_profil'];
    $id_profil= $_SESSION['id_profil'];
    $id_type_profil= $_SESSION['id_type_profil'];

    $link= mysqli_connect('localhost', 'root','','vaca');
    mysqli_set_charset($link, "utf8mb4_general_ci");
    mysqli_select_db($link, 'vaca')
    or die('Impossible de sélectionner la BDD vaca : '. mysqli_error($link));

    ?>
    <br>
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
        <div class="row" style="height:auto;overflow:auto">
          <div class="border">
            <div class="navtop"> <h3 style="padding-left:5px;"  > <a href="../Utilisateur/2A_Mes_demandes.php" style="font-size:2em;">🚚</a>  Demandes matériel </h3></div>
            <?php
            $query_mat= "SELECT d.id_type_demande, d.id_statutTran, d.id_statutDem, d.id_profil, d.id_materiel, d.date_debut, d.date_fin, d.date_demande, d.date_validation,
            d.quantite, d.criteres_supp, d.reponse_demande, m.nom_materiel, sd.Libelle_demande, st.libelle_transport
            FROM demande d JOIN materiel m ON d.id_materiel=m.id_materiel
            JOIN statutdemande sd ON d.id_statutDem= sd.id_statutDem
            JOIN statuttransport st ON d.id_statutTran=  st.id_statutTran
            WHERE d.id_profil=$id_profil AND d.id_type_demande=1";

            $result_mat = mysqli_query($link, $query_mat);
            $mat= mysqli_fetch_all($result_mat);
            //Afichage de demande de materiel
            for ($i=0; $i<count($mat); $i++){
              echo '<br><b><u>&#8608 Demande de Materiel fait à '.$mat[$i][7].'.</b></u><br><br>';
              echo'<p style="margin:13px;"><b>Date de debut:</b> '.$mat[$i][5].'.<br>
              <b>Date de fin:</b> '.$mat[$i][6].'.<br>
              <b>Materiel demandé:</b> '.$mat[$i][12].'.<br>
              <b>Quantité:</b> '.$mat[$i][9].'.<br>
              <b>Status Demande:</b> '.$mat[$i][13].'.<br>
              <b>Status Transport:</b> '.$mat[$i][14].'.<br>
              <b>Commentaire:</b> '.$mat[$i][10].'.<br>
              <b>Reponse Demande:</b> '.$mat[$i][11].'.<br></p>
              <hr size="7" color="#6f370f" width="60%" align="center" noshade>
              ';
            }
            ?>

          </div>
        </div>
        <br>

        <!-- Rectangle pour les animaux  -->
        <div class="row" style="height:auto;margin-bottom: 20px;overflow:auto">
          <div class="border">
            <div class="navtop"> <h3 style="padding-left:5px;"> <a href="../Utilisateur/2A_Mes_demandes.php" style="font-size:2em;">🐑</a>  Demande animaux </h3></div>

            <?php
            $query_ani= "SELECT d.id_type_demande, d.id_statutTran, d.id_statutDem, d.id_profil, d.id_race, d.date_debut, d.date_fin,
            d.date_demande, d.date_validation, d.quantite, d.criteres_supp, d.reponse_demande,
            r.race, sd.Libelle_demande, st.libelle_transport
            FROM demande d JOIN race r ON d.id_race=r.id_race
            JOIN statutdemande sd ON d.id_statutDem= sd.id_statutDem
            JOIN statuttransport st ON d.id_statutTran=  st.id_statutTran
            WHERE d.id_profil=$id_profil AND d.id_type_demande=2";

            $result_ani = mysqli_query($link, $query_ani);
            $ani= mysqli_fetch_all($result_ani);
            //Afichage de demande de animal
            for ($i=0; $i<count($ani); $i++){
              echo '<br><b><u>&#8608 Demande de Animale fait à '.$ani[$i][7].'.</b></u><br><br>';
              echo'<p style="margin:13px;"><b>Date de debut:</b> '.$ani[$i][5].'.<br>
              <b>Date de fin:</b> '.$ani[$i][6].'.<br>
              <b>Animale demandé:</b> '.$ani[$i][12].'.<br>
              <b>Quantité:</b> '.$ani[$i][9].'.<br>
              <b>Status Demande:</b> '.$ani[$i][13].'.<br>
              <b>Status Transport:</b> '.$ani[$i][14].'.<br>
              <b>Commentaire:</b> '.$ani[$i][10].'.<br>
              <b>Reponse Demande:</b> '.$ani[$i][11].'.<br></p>
              <hr size="7" color="#6f370f" width="60%" align="center" noshade>
              ';
            }
            ?>
          </div>
        </div>
      </div>

      <!-- Rappels -->
      <div class="column" style = "float:right">
        <div class="navtop" style="width:auto"> <h3 style="padding-left:5px;"> <a style="font-size:2em;">📜</a>  Rappels</h3></div>
        <div class="border" style="overflow:auto;height:100%">
          <div class="box-agenda">
            <?php include("../../Fonction/Calendar.php");
            include("../../Fonction/datesConvention.php");
            include("../../Fonction/transportValide.php");
            include("../../Fonction/rappelRDV.php");
            if(isset($calendar)){unset($calendar);}
            $calendar=new Calendar();
            $calendar->set_agenda(FALSE);

            //$event->add_event();?>
            <center><div class='content home'>
              <?=$calendar?>
            </center></div>

            <!-- Rappels -->
            <div class="row" style="padding:10px;">
              <br>
              <?php
              echo "<hr><h3> Rendez-vous </h3>";
              rappelRDV(); ?><hr></p>
            </div>
          </div>
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
        setTimeout(showSlides, 5000); // Change image every 5 seconds
      }
      </script>
      <br style="clear:both;">
    </div>



    <div class="footer">
      <?php include("../../Style/Pied.html"); ?>
    </div>
  </body>
</hmtl>
