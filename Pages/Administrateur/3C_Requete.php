<?php session_start(); ?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Requete
  </title>
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
      <?php
      //recup fichier pour liste
      require("../../Fonction/creerListeHTML2.php");
      /* Connexion à la base de données*/
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      /* Choix d'une BDD et message d'erreur si connexion impossible*/
      mysqli_select_db($link,'vaca')
      or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));


      //permet de modifier la BDD si appuie sur bouton que ce soit valider ou refuser la demande, modif statut et commentaire
      if(isset($_GET["id_demande"])){
        $id_demande=$_GET["id_demande"];
        //si bouton valider
        $rep="";
        if (isset($_GET["btn_exploit".$id_demande])){
          if(isset($_GET["nb_exploit".$id_demande])){
            $nb_exploit=$_GET["nb_exploit".$id_demande];
            $rep="<table>";
            //recupere les coorodonnées des exploits
            for ($i=1;$i<=$nb_exploit;$i++){
              $nb_animal=$_GET["nb_animal".$i];
              $exploit=$_GET["lst_exploit".$i];
              $rep=$rep."<tr><td>".$nb_animal." animaux </td>";
              //recupere info de exploitation ($exploit)
              $query_exploit= "SELECT nom, adresse, tel, mail
              FROM exploitation
              JOIN attributiondesexploitations ON exploitation.id_exploit=attributiondesexploitations.id_exploit
              JOIN profil ON attributiondesexploitations.id_profil=profil.id_profil
              JOIN contact ON contact.id_profil=profil.id_profil
              WHERE exploitation.id_exploit=".$exploit;
              $t=["chez ", " à l'adresse ", " num : ", " mail : "];
              $result_exploit = mysqli_query($link, $query_exploit) or die ('pb : ' . mysqli_error($link)) ;

              $tab_exploit = mysqli_fetch_all($result_exploit) ;
              $ncol = mysqli_num_fields($result_exploit) ;
              $nlig = mysqli_num_rows($result_exploit) ;

              //ajout contact sur une variable pour le mettre en commentaire dans BDD
              for ($li=0;$li<$nlig;$li++){
                for ($col=0; $col<$ncol;$col++){
                  $rep=$rep."<td>".$t[$col].$tab_exploit[$li][$col]."</td>";
                }// fin for
                $rep=$rep."</tr><tr><td> ou </td> ";
              }// fin for
              $rep=$rep."</tr> ";
            }
            $rep=$rep."</table><br>";
          }

          // ajout du commentaire de l'admin
          if (isset($_GET["comm_admin".$id_demande])){
            $comm_admin=$_GET["comm_admin".$id_demande];
            $rep=$rep."<br>".$comm_admin;
          }

          //modif dans BDD du statut et de la rep de l'admin
          $query_bdd='UPDATE demande SET reponse_demande="'.$rep.'", id_demande='.$id_demande.' WHERE id_demande='.$id_demande;
          mysqli_query($link, $query_bdd);
          $query_statut="UPDATE demande SET id_statutDem=1, id_demande=".$id_demande." WHERE id_demande=".$id_demande;
          mysqli_query($link, $query_statut);
        }
        // si bouton refuser
        elseif(isset($_GET["btn_refus".$id_demande])){
          $rep="Demande refusée ";
          if (isset($_GET["comm_admin".$id_demande])){
            $comm_admin=$_GET["comm_admin".$id_demande];
            $rep=$rep."<br>".$comm_admin;
          }
          //modif dans BDD du statut et de la rep de l'admin
          $query_bdd='UPDATE demande SET reponse_demande="'.$rep.'", id_demande='.$id_demande.' WHERE id_demande='.$id_demande;
          mysqli_query($link, $query_bdd);
          $query_statut="UPDATE demande SET id_statutDem=0, id_demande=".$id_demande." WHERE id_demande=".$id_demande;
          mysqli_query($link, $query_statut);
        }
      }


      //recupere les demandes en cours
      $query="SELECT id_demande,id_type_demande
      FROM demande
      WHERE id_statutDem=2";
      $result = mysqli_query($link, $query)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
      $tab_id_demande = mysqli_fetch_all($result);

      //si pas de demande
      if(count($tab_id_demande)==0){
        echo"<h2>Pas de demande en attente</h2>";
      }

      //si demande
      else{
        $rep="";
        // boucle sur les demandes en cours en verifinat l'id du type de demande si animal ou materiel
        for ($id=0;$id<count($tab_id_demande);$id++){
          switch ($tab_id_demande[$id][1]){
            // pour materiel
            case 1 :
            echo"<div class='demande'>";
            $id_demande=$tab_id_demande[$id][0];
            /* Récupération des informations sur la demande*/
            $query1="SELECT id_demande, date_demande, prenom, nom, nom_materiel, quantite, date_debut, date_fin
            FROM demande,profil, materiel
            WHERE demande.id_profil=profil.id_profil
            AND demande.id_materiel=materiel.id_materiel
            AND id_demande = ".$id_demande;

            $result1 = mysqli_query($link, $query1)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
            $info_demande = mysqli_fetch_all($result1);

            //affichage des infos pour la demande
            echo "<hr><h3>Demande materiel n°" . $info_demande[0][0] . "</h3>";
            echo "<p>Date de la demande : " . $info_demande[0][1] . "<BR>";
            echo "Demandeur : " . $info_demande[0][2] . " " . $info_demande[0][3] . "<BR>";
            echo "Materiel : " . $info_demande[0][4] . "<BR>";
            echo "Quantité : " . $info_demande[0][5] . "<BR>";
            echo "Date de début : ". $info_demande[0][6]."<br>";
            echo "Date de fin : ". $info_demande[0][7]."<br></p>";
            //envoie info necessaire pour modif BDD
            echo "<form method='GET' name ='form_materiel' action = '3C_Requete.php'>";
            echo "<Input type='text'  placeholder='Commentaire...' name='comm_admin".$id_demande."' >";
            echo "<input type='hidden' name='id_demande' value='".$id_demande."'>";
            echo "<br><br><Input type='submit' name='btn_exploit".$id_demande."' value='Valider la demande'>";
            echo "<br><br><Input style='float:none;' type='submit' name='btn_refus".$id_demande."' value='Refuser la demande'><hr>";
            echo "</form>";
            echo "</div>";
            break ;
            //pour animal
            case 2 :
            echo"<div class='demande'>";
            $id_demande=$tab_id_demande[$id][0];
            /* Récupération des informations sur la demande*/
            $query1="SELECT id_demande, date_demande, prenom, nom, race, quantite, lib_duree, date_debut, demande.id_race, demande.id_duree
            FROM demande, profil, race, dureeconvention
            WHERE race.id_race = demande.id_race
            AND demande.id_profil = profil.id_profil
            AND demande.id_duree = dureeconvention.id_duree
            AND id_demande = ".$id_demande;

            $result1 = mysqli_query($link, $query1)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
            $info_demande = mysqli_fetch_all($result1);

            //affichage des infos pour la demande
            $num_race = $info_demande[0][8];
            echo "<h3>Demande animal n°" . $info_demande[0][0] . "</h3>";
            echo "<p>Date de la demande: " . $info_demande[0][1] . "<BR>";
            echo "Demandeur : " . $info_demande[0][2] . " " . $info_demande[0][3] . "<BR>";
            echo "Race : " . $info_demande[0][4] . "<BR>";
            echo "Quantité : " . $info_demande[0][5] . "<BR>";
            echo "Durée de la convention : ". $info_demande[0][6]."<br>";
            echo "Date de début de la convention : ". $info_demande[0][7]."<br>";
            echo "Date de fin de la convention : ";
            //calcul date de fin selon duree convention
            $dateDepartTimestamp = strtotime($info_demande[0][7]);
            switch($info_demande[0][9]){
              case 1 : //pour 6 mois
              $duree=6;
              $date_fin = date('Y-m-d', strtotime('+'.$duree.' month', $dateDepartTimestamp ));
              echo $date_fin."<br></p>";
              break;
              case 2 : //pour un an
              $duree=1;
              $date_fin = date('Y-m-d', strtotime('+'.$duree.' year', $dateDepartTimestamp ));
              echo $date_fin."<br></p>";
              break;
              case 3 ://pour 2 ans
              $duree=2;
              $date_fin = date('Y-m-d', strtotime('+'.$duree.' year', $dateDepartTimestamp ));
              echo $date_fin."<br></p>";
              break;
              case 4 :
              $duree=1; //choix par admin
              $date_fin = date('Y-m-d', strtotime('+'.$duree.' year', $dateDepartTimestamp ));
              echo "<form method='GET' name ='form_date_fin' action = '3C_Requete.php'>" ;
              if (isset($_GET['btn_date_fin'])){
                $date_fin=$_GET['date_fin'];
              }
              echo "<input type='date' name= 'date_fin' value='".$date_fin."'>";
              echo "<br><br><input type='submit' name ='btn_date_fin' value= 'Valider la date de fin'></p>";
              echo "</form>";
              break;
            }// fin switch

            //modif dzte de fin dans BDD
            if (isset($date_fin)){
              $query_modif="UPDATE demande SET date_fin = '".$date_fin."', id_demande = ".$info_demande[0][0]." where id_demande = ".$info_demande[0][0];
              mysqli_query($link, $query_modif);
            }

            /* Récupération des exploitations disposant des animaux demandées*/
            $query2="SELECT DISTINCT exploitation.id_exploit, exploitation.nom_exploit
            FROM animal
            JOIN exploitation ON animal.id_exploit = exploitation.id_exploit
            AND id_race = ".$num_race;

            $result2 = mysqli_query($link, $query2)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
            $lib_exploit = mysqli_fetch_all($result2);
            if (isset($_GET['lst_exploit'])==TRUE){
              $val = $_GET['lst_exploit'];
            } //fin if

            // choisir nb exploit
            echo "<form method='GET' action='3C_Requete.php' name ='form_nb_exploit'>";
            echo "<p>Choisir le nombre d'exploitations : ";
            $nb_exploit=1;
            if (isset($_GET["btn_nb_exploit".$id_demande])){
              $nb_exploit=$_GET["nb_exploit".$id_demande];
            }
            echo "<input type='text' name='nb_exploit".$id_demande."' value=".$nb_exploit."></p>";
            echo "<br><br><input type='submit' name='btn_nb_exploit".$id_demande."' value='Valider nombre exploitations'>";

            echo "</form>";

            if (isset($_GET["btn_nb_exploit".$id_demande]) OR $info_demande[0][5]==1){
              //boucle sur le nb d'exploit choisi pour choisir le nombre d'anmail et quelle exploit puis envoie des infos necessaire pour modif la BDD si validation de demande
              for ($i=1;$i<=$nb_exploit;$i++){
                echo "<form method = 'GET' action = '3C_Requete.php' name = 'form_exploit'>";
                echo "<p>Exploitation ".$i;
                $nb_animal=1;
                $exploit=0;
                echo " <INPUT type='text' name='nb_animal".$i."'> ";
                creerListeHTML2('"lst_exploit'.$i.'"' , $lib_exploit, $exploit);
                echo "<br><br></p>";
              }//fin du for
              echo "<p><Input type='text' placeholder='Commentaire...' name='comm_admin".$id_demande."' ></p>";
              echo "<input type='hidden' name='id_demande' value='".$id_demande."'>";
              echo "<Input type='hidden' name='nb_exploit".$id_demande."'value=".$nb_exploit." >";
              echo "<br><br><Input type='submit' name='btn_exploit".$id_demande."' value='Valider la demande'>";
              echo "</form>";

            }//fin if
            // possibilité de refus de demande avec commentaire pourquoi et envoi des infos necessaire pour modif BDD
            echo "<form method = 'GET' action = '3C_Requete.php' name = 'form_bouton_refus'>";
            echo "<p><Input type='text' placeholder='Commentaire pour refus...' name='comm_admin".$id_demande."' ></p>";
            echo "<input type='hidden' name='id_demande' value='".$id_demande."'>";
            echo "<input type='hidden' name='reponse' value='".$rep."'>";
            echo "<br><br><Input type='submit' name='btn_refus".$id_demande."' value='Refuser la demande'><hr>";
            echo "</form>";
            echo"</div>";

            break ;

          }// fin switch
        }//fin for
      }// fin else
      ?>
    </div></center>
  </div>
  <div class="footer">
    <?php include("../../Style/Pied.html");?>
  </div>
</body>
</hmtl>
