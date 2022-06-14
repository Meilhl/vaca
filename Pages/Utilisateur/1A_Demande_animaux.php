<?php session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Demande d'Animaux
  </title>
</head>
<body>
  <div class= "header">
    <?php
    $role=2;
    require("../../Style/Entete.php");
    affiche_entete($role);
    ?>
  </div>

  <div class="corps">
    <center><div class="border" style="width:40%;height:auto;padding:5px">
      <?php
      //Recucperer l'indentifiant de la page precedente (accueil)
      $identifiant_profil= $_SESSION["identifiant_profil"];
      $id_profil= $_SESSION['id_profil'];
      $id_type_profil= $_SESSION['id_type_profil'];

      //Connexion a BDD
      $link= mysqli_connect('localhost', 'root','','vaca');
      mysqli_set_charset($link, "utf8mb4_general_ci");
      mysqli_select_db($link, 'vaca')
      or die('Impossible de sélectionner la BDD vaca : '. mysqli_error($link));

      //recuperer info des race et profil
      $query= "SELECT r.id_race, r.race
      FROM race r
      JOIN accesrace a ON r.id_race= a.id_race
      WHERE a.acces_race=1 && a.id_profil=$id_profil";
      $query2= "SELECT p.id_profil, p.nom, p.prenom, a.id_exploit
      FROM profil p LEFT JOIN attributiondesexploitations a ON a.id_profil=p.id_profil
      WHERE p.id_profil=$id_profil ";



      $result = mysqli_query($link, $query);
      $race= mysqli_fetch_all($result);
      $list_race="list_race"; //why this exists???

      $result2= mysqli_query($link, $query2);
      $tab2= mysqli_fetch_all($result2);
      $id_exploit= $tab2[0][3];

      ?>
      <h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Demande animal</h2><hr>
      <div class="item-left">

        <!--Choix des race-->
        <?php


        echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choix de race:</h2>";
        //echo '<input type="text" id="races" name="races" required/>';
        echo "<form method='GET' action=''>";
        echo '<select id="races" name="races">';
        for ($i=0; $i<count($race); $i++){
          echo'<option value='.$race[$i][0].'>'.$race[$i][1].'</option>';
        }
        echo '</select>';
        echo '<br><br>';
        echo '<input type ="submit" name="choix_race" value="Afficher !">';
        echo '</form>';

        ?>
        <!--Apres la choix des race etait fait, se affiche different formulaire -->
        <?php
        if (isset($_GET['choix_race'])==TRUE){
          $race_choix= $_GET['races'];

          $query3= "SELECT a.id_animal, a.surnom, a.id_race, a.id_sexe, a.identifiant_animal FROM animal AS a WHERE a.id_sexe='M'AND a.id_race='$race_choix' AND a.attribution= $id_exploit";
          $result3= mysqli_query($link, $query3);
          $tab3= mysqli_fetch_all($result3);

          echo "<form method='POST'>";
          //Si la race est de bovin affiche cette formulaire, si taureau affiche tareaus attribue else affiche quantite
          if ($race_choix>=1 && $race_choix<=8){
            echo'<div class=taureaux>';
            echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choix de taureaux ou étalon: </h2>";
            echo '<select id="taureau" name="taureau">';
            for ($i=0; $i<count($tab3); $i++)
            echo'<option value='.$tab3[$i][0].'> Nom: '.$tab3[$i][1].'   ID: '.$tab3[$i][4].'</option>';
            echo '</select>';
            echo'</div>';
          }
          else{
            //Quantite
            echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Nombre des animaux:</h2>";
            echo '<input type="number" class="quantity" id="quantite" name="quantite" min="1" max="60">';
            //Sexe
            echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Choix de sexe:</h2>";
            echo ' <label > <p><b>Mâle</b></p>';
            echo ' <input type="radio" name="sex" class="radio" value="1" required>';
            echo '</label>';
            echo ' <label > <p><b>Female</b></p> ';
            echo '<input type="radio" name="sex" class="radio" value="2" required>';
            echo '</label>';
          }

          ?>


          <!--Duree-->
          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Durée convention:</h2>
          <label for='radio1'> <p><b>1 an</b></p> </label>
          <input type="radio" name="duree" class="radio" id='radio1' value="2" required>

          <label for='radio2'> <p><b>2 an</b></p> </label>
          <input type="radio" name="duree" class="radio" id='radio2' value="3" required>

          <label for='radio3'> <p><b>Autre</b></p> </label>
          <input type="radio" name="duree" class="radio" id='radio3' value="4" required>



        </div>  <!--fin div flex left -->
        <div class="item-right">
          <!--Commentaire-->
          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Remarque :</h2>
          <p>En cas de site transitoire ou autre, faire un commentaire.</p>
          <textarea name="remarque_demande" row=5 cols=40></textarea>

          <!--Dates-->
          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choix des dates :</h2>
          <h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Date de debut:</h2>
          <input type="date" name= "debut_dem" list="date_demande" required>
          <datalist id="debut_dem">
          </datalist>
          <br><br><br>
          <input type='SUBMIT' name='bt_submit' value='Envoyer demande'>
        </form>


        <?php
      } //fin de if race choix submit
      // Take the values of the forms after submit
      //insert into BDD and if everythong goes well, confirmation
      if (isset($_POST['bt_submit'])==TRUE){


        //$sex=$_POST['sex'];
        $comment=$_POST['remarque_demande'];
        $date_dem= date('Y-m-d');
        $debut_dem=$_POST['debut_dem'];
        $duree= $_POST['duree'];
        if($duree==2 or $duree==4){
          $fin_dem=date('Y-m-d', strtotime('+1 years',strtotime($debut_dem)));
        }
        if($duree==3){
          $fin_dem=date('Y-m-d', strtotime('+2 years',strtotime($debut_dem)));
        }

        //insertion dasn la BDD c'est differente pour les taureaux
        if ($race_choix>=1 && $race_choix<=5){
          $id_taureau=$_POST['taureau'];
          $query_info="SELECT nom, prenom, nom_exploit, tel, mail
          FROM animal
          LEFT JOIN exploitation ON animal.id_exploit=exploitation.id_exploit
          LEFT JOIN attributiondesexploitations ON attributiondesexploitations.id_exploit=exploitation.id_exploit
          LEFT JOIN profil on attributiondesexploitations.id_profil=profil.id_profil
          LEFT JOIN contact ON profil.id_profil=contact.id_profil
          WHERE id_animal=".$id_taureau;
          $result_info= mysqli_query($link, $query_info);
          $tab_info= mysqli_fetch_all($result_info);
          $nom=$tab_info[0][0];
          $prenom=$tab_info[0][1];
          $nom_exploit=$tab_info[0][2];
          $tel=$tab_info[0][3];
          $mail=$tab_info[0][4];
          $rep="<p> Nom : ".$nom." ".$prenom." exploitation : ".$nom_exploit."<br> tel : ".$tel." mail : ".$mail."</p>";

          $query_dem = "INSERT into demande (id_type_demande, id_profil, id_race, date_demande, date_debut, date_fin, quantite, criteres_supp,
            id_duree, id_statutDem, id_statutTran, reponse_demande)
            VALUES (2, $id_profil,$race_choix, '$date_dem','$debut_dem','$fin_dem',1,'$comment',$duree, 1, 0, '$rep')";


          }
          else{
            $quantite= $_POST['quantite'];
            $query_dem = "INSERT into demande (id_type_demande, id_profil, id_race, date_demande, date_debut, date_fin, quantite, criteres_supp,
              id_duree, id_statutDem, id_statutTran)
              VALUES (2, $id_profil,$race_choix, '$date_dem','$debut_dem','$fin_dem',$quantite,'$comment',$duree, 2, 0)";

            }
            //verifié se la demande etait ajouté a BDD avec sucess
            //si la demande est de bovin, ajouté a table attribuition des animaux et verification avec msg
            $result_dem= mysqli_query($link, $query_dem);
            if ($result_dem){
              echo "<div class='box'>
              <h3>Demande fait avec sucess.</h3><br>
              </div>";
              if ($race_choix>=1 && $race_choix<=5){
                $taureau=$_POST['taureau'];
                $query_id= "SELECT LAST_INSERT_ID() FROM demande";
                $result_id= mysqli_query($link, $query_id);
                $tab_id= mysqli_fetch_all($result_id);
                $id_demande= $tab_id[0][0];

                $query_attri="INSERT INTO attributiondesanimaux (id_demande, id_animal)
                VALUES ($id_demande, $taureau)";
                $resul_attri= mysqli_query($link, $query_attri);
                if($resul_attri){
                  echo "<div class='box'>
                  <h3>Atribuiton avec succes</h3>
                  </div>";
                }

              }
            }

            //ENVOYER MAIL

            // include_once ("../../Fonction/test_mail.php");
            //$to=$identifiant_profil;
            // $to= $identifiant_profil;
            // $subjet="Demande au Conservatoire des Races de Aquitaine";
            // $msg= '<html><head><meta content="text/html; charset=utf-8" /></head>
            // <body><b>Bonjour Mme/M'.$tab2[0][1].'</b>,<br>
            // Vous avez fait une demande sur le site VACA. <br>
            // Attendrez votre demande etre validé, BISU<br>
            // Pour plus info: <a href="mailto:conservatoire.race.aquitaine@gmail.com">conservatoire.race.aquitaine@gmail.com</a>
            // </body></html>';
            // send_mail($to,$subjet,utf8_encode($msg));

          }     //end of if submit=true

          ?>

        </div><!--fin div flex right -->
      </div></center>
    </div> <!--fin div corps-->

    <div class="footer">
      <?php include("../../Style/Pied.html"); ?>
    </div>
  </body>
</hmtl>
