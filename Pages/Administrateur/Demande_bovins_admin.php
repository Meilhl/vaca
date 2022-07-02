<?php
session_start();
?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Demande animaux administrateur
  </title>
</head>

<body>
  <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
  </div>

  <?php
  //Choix de l'espèce concernée selon la barre de navigation
  $espece =  $_GET['id_espece'];

  // connexion à la base de donnée
  $link=mysqli_connect('Localhost','root','','vaca');
  mysqli_set_charset($link,"utf8mb4_general_ci");
  mysqli_select_db($link,'vaca')
  or die ('impossible d\'ouvrir la BDD: '. mysqli_error($link));
  ?>

  <div class= "corps">
    <center><div class="border" style="width:40%;height:auto;padding:5px">
      <!-- Création du premier formulaire  -->
      <?php
      // Requete exploitation
      $query2 = "SELECT  id_exploit, nom_exploit
      FROM exploitation ";

      // execution de la requête 2  et production d'un recordset 2
      $result2 =mysqli_query($link,$query2);
      $tab2 = mysqli_fetch_all($result2);
      ?>
      <div class="item-left">

        <!-- Boite de choix pour l'exploitation a qui on attribue les animaux -->
        <!-- Boite de choix pour l'utilisateur a qui on attribue les animaux -->
        <form method="GET" name="formExploit">
          <h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Choix utilisateur concerné par la demande : </h2><hr>
          <?php
          $val=-1; // Pour la liste déroulante

          // Le if permet de garder la valeur sélectionnée affichée dans la cellule pour le reste
          require ("../../fonction/creerListeHTML.php");

          if (isset($_GET["exploit"])==NULL)
          {
            $val=NULL;
          }
          else {
            $val= $_GET['exploit'];
          }

          $nom0="exploitation";

          echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Exploitation : </h2>";
          creerListeHTML($nom0, $tab2, $val);

          //On garde les valeurs de l'URL
          $espece=$_GET['id_espece'];
          //echo $espece;
          echo "<br><br><input type='hidden' name='id_espece' value='".$espece."'>"; //On recupere ID espece dans l'URL pour la suite
          ?>

          <input type = "submit", value ="Valider", name="bt_submit1">
        </form>
        <!--Fin premier formulaire -->

        <?php
        if (isset($_GET["bt_submit1"])==TRUE){

          $exploitation=$_GET["exploitation"];
          $espece=$_GET['id_espece'];

          //Production de la nouvelle liste deroulante
          //require ("../../fonction/creerListeHTML.php");
          if (isset($_GET["race"])==NULL)
          {
            $val=NULL;
          }
          else {
            $val= $_GET['race'];
          }

          // Requete race qui apparaissent selon l'exploitation
          $query ="SELECT race.id_race, race, attribution
          FROM race
          JOIN animal ON animal.id_race = race.id_race
          JOIN espece ON espece.id_espece = race.id_espece
          WHERE attribution = $exploitation
          AND race.id_espece = $espece";

          //Requete pour avoir l'utilsateur qui correspond
          $query1= "SELECT attributiondesexploitations.id_profil, nom, prenom
          FROM profil, attributiondesexploitations
          WHERE attributiondesexploitations.id_exploit=$exploitation";  //MARCHE PAS, il faut récupérer un id_profil qui correspond à l'exploit
          //Sert à remplir la partie demande à la fin.

          // execution de la requête et production d'un recordset
          $result =mysqli_query($link,$query);
          $tab = mysqli_fetch_all($result);
          // execution de la requête et production d'un recordset
          $result1 =mysqli_query($link,$query1);
          $tab1 = mysqli_fetch_all($result1);
          $val=-1;


          ?>
          <!--Production de la liste race -->
          <form method="GET">
            <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choix de la race :</h2>

            <?php

            $nom="race";
            echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Race : </h2>";
            creerListeHTML($nom, $tab, $val);
            $nom1="eleveur";
            echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Profil: </h2>";
            creerListeHTML($nom1, $tab1, $val);

            $exploitation = $_GET['exploitation'];
            echo "<input type='hidden' name='exploitation' value='".$exploitation."'>";
            $espece=$_GET['id_espece'];
            echo "<input type='hidden' name='id_espece' value='".$espece."'>";
            ?>


            <!--bouton pour valider les infos -->


            <br><br><input type = "submit", value ="Afficher les animaux", name="bt_submit2">

          </form>

          <?php
        } //isset($_GET["bt_submit1"])==TRUE)



        if (isset($_GET["bt_submit2"])==TRUE){
          $race=$_GET['race'];
          $exploitation=$_GET["exploitation"];
          $espece=$_GET['id_espece'];
          //$eleveur = $_GET['eleveur'];
          //echo $race;
          //echo $exploitation;

          // Affichage des animaux correspondants

          // Requete animal
          $query3 = "SELECT id_animal, identifiant_animal, id_sexe, surnom, nom_exploit
          FROM animal, exploitation, race
          WHERE animal.id_exploit = exploitation.id_exploit
          AND animal.id_race =$race
          AND attribution = $exploitation
          AND race.id_espece = $espece";



          // execution de la requête et production d'un recordset
          $result3 =mysqli_query($link,$query3);
          $tab3 = mysqli_fetch_all($result3);
          $nblig= mysqli_num_rows($result3) ;

          // Création d'un tableau avec les animaux concernés.

          echo '<form method="POST">';
          echo "<table <tr>";
          echo "<label><h2>Sélection des animaux</h2></label>";
          echo "<th>  </th> <th> <a>Identifiant VACA </a> </th>
          <th><a> Identifiant National</a></th>
          <th><a> Sexe</a></th>
          <th><a> Surnom</a></th>
          <th><a> Localisation actuelle</a></th> </tr>";
          for ($i=0; $i<$nblig; $i++){
            echo '<td> <input type="checkbox" name="selected[]"
            value="'.$tab3[$i][0].'" ></td>';
            echo "<td>".$tab3[$i][0]."<br></td>";
            echo "<td>".$tab3[$i][1]."<br></td>";
            echo "<td>".$tab3[$i][2]."</td>";
            echo "<td>".$tab3[$i][3]."</td>";
            echo "<td>".$tab3[$i][4]."</td>";
            echo "</tr>";
          }
          echo "</table>";
          ?>
        </div> <!--fin div left-->
        <!--Durée  -->
        <div class= "item-right">

          <div class="date">
            <label for="date"> <br><h2>Durée de la convention </h2></label>
            <p>Date de début</p>
            <input type="date" name ="date_deb" list="date_demande">
            <datalist id="date_debut">
            </datalist>


            <!-- Durée convention pour trier dans la BDD -->

            <h1 class="box-title"></h1>

            <label for="duree_conv"> <a>Durée de la convention</a><br> <br></label>
            <label for='radio1'> <p><b>1 an</b></p> </label>
            <input type="radio" name="duree" class="radio" id='radio1' value="2" required>

            <label for='radio2'> <p><b>2 an</b></p> </label>
            <input type="radio" name="duree" class="radio" id='radio2' value="3" required>

            <label for='radio3'> <p><b>Autre</b></p> </label>
            <input type="radio" name="duree" class="radio" id='radio3' value="4" required>

           <!--  <input type="radio" name="duree" class="radio" value=2>
            <label> 1 an <br> </label>

            <input type="radio" name="duree" class="radio" value=3>
            <label> 2 ans <br></label>

            <input type="radio" name="duree" class="radio" value=4>
            <label> Autre durée <br></label> -->

            <!--choix date de fin si duree autre-->


            <label for="date"> <br><a>Choix de la date de fin de la convention,
              <i> que si la duree est autre. <br> </i></a></label>
              <br>
              <input type="date" name ="date_fin2" list="date_demande">
              <datalist id="date_fin2">
              </datalist>
            </div> <!--fin div date-->


            <!--Commentaire-->

            <label for="remarque_demande"><label> <h2> Remarque </h2></label>
            <textarea name="remarque_demande" row=3 cols=40></textarea>

            <br>
            <input type = "submit", value ="Valider la demande", name="bt_submit3">
            <br>
          </form>

          <?php

          if (isset($_POST["bt_submit3"])==TRUE){

            // Traitement de la date
            $duree= $_POST['duree'];
            $date_deb=$_POST['date_deb'];
            $date_fin2= $_POST['date_fin2'];
            $eleveur = $_GET['eleveur'];
            $date_dem= date('Y-m-d');
            $commentaire=$_POST['remarque_demande'];
            $quantite= count($_POST["selected"]);
            


            // gestion de la duree
            if($duree==4){
              $date_fin=$date_fin2;
            }
            if($duree==2 ){
              $date_fin=date('Y-m-d', strtotime('+1 years',strtotime($date_deb)));
            }
            if($duree==3){
              $date_fin=date('Y-m-d', strtotime('+2 years',strtotime($date_deb)));
            }

          

            //création de la demande dans la base de donnée
            $query4 = "INSERT INTO `demande`(`id_type_demande`,`id_duree`, `id_statutTran`, `id_statutDem`,
              `id_profil`, `id_race`, `date_debut`, `date_fin`, `date_demande`, `quantite`, `criteres_supp`)
              VALUES (2,$duree,0,1,$eleveur,$race,'$date_deb','$date_fin',
                '$date_dem',$quantite,'$commentaire')";

                $result4 = mysqli_query($link,$query4);

                /* if ($result4){
                  echo "<div class='box'>
                  <h3> Ca marche la demande </h3>
                  </div>";
                }
                else{
                  echo 'Pas marche la demande ';
                } */

                //Récupérartion des id des animaux sélectionnés
                $query5 = "SELECT LAST_INSERT_ID() FROM demande"; //On recupere l'identifiant de la demande pour l'associer a chaque animal.
                $result5 =mysqli_query($link,$query5);
                $tab5 = mysqli_fetch_all($result5);
                $id_demande = $tab5[0][0];
                /* echo $tab5[0][0] ;
                echo $id_demande; */

                //recuperation du tableau afait a partir des données issues des checkbox
                $id_test=$_POST['selected'];

                //Récupérartion des id des animaux sélectionnés
                $query5 = "SELECT LAST_INSERT_ID() FROM demande"; //On recupere l'identifiant de la demande pour l'associer a chaque animal.
                $result5 =mysqli_query($link,$query5);
                $tab5 = mysqli_fetch_all($result5);
                $id_demande = $tab5[0][0];
                /* echo $tab5[0][0] ;
                echo $id_demande; */

                //recuperation du tableau fait a partir des données issues des checkbox
                $id_test=$_POST['selected'];

                if(isset($id_test)){
                  foreach($id_test as $id_animal){
                    //echo $id_animal ."<br>";
                    //echo $id_demande;
                    $query6 = "INSERT INTO `attributiondesanimaux`(`id_animal`, `id_demande`) VALUES ($id_animal,$id_demande)";
                    $result6=mysqli_query($link,$query6);
                    // on fait des requêtes au fur et a mesure que les identifiants sont relevés pour les ajouter dans la table attribution animaux
                    // on garde l'idntifiant de la demande qui a été créée précédemment



                  } //foreach($id_test as $id_animal)

                }//if(isset($id_test)){
                  if ($result6){
                    echo "<div class='box'>
                    <h3>Enregistrement fait avec avec succès.</h3>
                    <p>Cliquez ici pour vous <a href='http://vaca/vaaca/Pages/Administrateur/Demande_animaux_admin.php'>une nouvelle attribution</a></p>
                    </div>";
                  }
                  else{
                    echo "L'enregistrement a rencontré une erreur";
                  }
                } //if (isset($_GET["bt_submit3"])==TRUE
              } //isset($_GET["bt_submit2"])==TRUE)
              //Page
              ?>
            </div> <!--Fin div right -->

          </div></center>
        </div><!--Fin div corps -->
        <br>
        <br>

        <!--pied de page -->
        <div class="footer">
          <?php
          include("../../Style/Pied.html"); ?>
        </div>

      </body>
    </hmtl>
