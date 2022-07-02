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
  $espece=$_GET['id_espece'];
  //echo "<input type='hidden' name='id_espece' value='".$espece."'>";

  // connexion à la base de donnée
  $link=mysqli_connect('Localhost','root','','vaca');
  mysqli_set_charset($link,"utf8mb4_general_ci");
  mysqli_select_db($link,'vaca')
  or die ('impossible d\'ouvrir la BDD: '. mysqli_error($link));
  ?>

  <div class= "corps">
    <center><div class="border" style="width:40%;height:auto;padding:15px">
      <!-- Création du premier formulaire  -->

      <?php

      // Requete utilisateur
      $query2 = "SELECT  profil.id_profil, nom, prenom
      FROM profil
      JOIN accesrace ON profil.id_profil= accesrace.id_profil
      JOIN race ON race.id_race =accesrace.id_race
      WHERE acces_race = 1
      AND race.id_espece = $espece";

      // execution de la requête 2  et production d'un recordset 2
      $result2 =mysqli_query($link,$query2);
      $tab2 = mysqli_fetch_all($result2);
      ?>
      <div class="item-left">

        <!-- Boite de choix pour l'utilisateur a qui on attribue les animaux -->
        <form method="GET" name="formEleveur">
          <br><h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Choix utilisateur concerné par la demande : </h2><hr>
          <?php
          $val=-1; // Pour la liste déroulante

          // Le if permet de garder la valeur sélectionnée affichée dans la cellule pour le reste
          require ("../../fonction/creerListeHTML.php");

          if (isset($_GET["eleveur"])==NULL)
          {
            $val=NULL;
          }
          else {
            $val= $_GET['eleveur'];
          }

          $nom0="eleveur";

          echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Eleveur : </h2>";
          creerListeHTML($nom0, $tab2, $val);

          //On garde les valeurs de l'URL
          $espece=$_GET['id_espece'];
          //echo $espece;
          echo "<br><input type='hidden' name='id_espece' value='".$espece."'>"; //On recupere ID espece dans l'URL pour la suite
          ?>

          <br><input type = "submit", value ="Valider", name="bt_submit1">

        </form>
        <!--Fin premier formulaire -->

        <?php
        if (isset($_GET["bt_submit1"])==TRUE){

          $eleveur = $_GET['eleveur'];

          $espece=$_GET['id_espece'];

          //echo $eleveur;
          echo "<input type='hidden' name='eleveur' value='".$eleveur."'>";
          // Requete race qui apparaissent selon l'utilisateur
          $query = "SELECT race.id_race, race.race FROM race
          JOIN accesrace ON race.id_race= accesrace.id_race
          JOIN espece ON espece.id_espece = race.id_espece
          WHERE accesrace.acces_race=1 && accesrace.id_profil=$eleveur
          AND espece.id_espece = $espece";


          // execution de la requête et production d'un recordset
          $result =mysqli_query($link,$query);
          $tab = mysqli_fetch_all($result);

          //Production de la nouvelle liste deroulante

          $val=-1;
          // Le if permet de garder la valeur sélectionnée affichée dans la cellule pour le reste
          //require ("../../fonction/creerListeHTML.php");

          if (isset($_GET["eleveur"])==NULL)
          {
            $val=NULL;
          }
          else {
            $val= $_GET['eleveur'];
          }

          // On utilise la fonction creer liste dans le dossier Fonctions pour faire la liste déroulante
          echo"<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choix de l'exploitation et de la race :</h2>";

          //ajout d'une requête pour choisir l'exploitation
          $query11 = "SELECT exploitation.id_exploit, nom_exploit FROM exploitation
          JOIN attributiondesexploitations
          ON attributiondesexploitations.id_exploit=exploitation.id_exploit
          WHERE attributiondesexploitations.id_profil=$eleveur";

          // execution de la requête et production d'un recordset
          $result11 =mysqli_query($link,$query11);
          $tab11 = mysqli_fetch_all($result11);
          echo '<form method="GET">';

          $nom="exploitation";
          echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Exploitation ou site : </h2>";
          creerListeHTML($nom, $tab11, $val);
          echo "<br><br><br>";
          echo "<h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Race : </h2>";
          $nom="race";
          creerListeHTML($nom, $tab, $val);

          $eleveur = $_GET['eleveur'];
          echo "<input type='hidden' name='eleveur' value='".$eleveur."'>";
          $espece=$_GET['id_espece'];
          echo "<input type='hidden' name='id_espece' value='".$espece."'>";

          ?>

          <!--bouton pour valider les infos -->

          <br><br>
          <center><input type = "submit", value ="Afficher les animaux", name="bt_submit2"></center>

        </form>

        <?php
      } //isset($_GET["bt_submit1"])==TRUE)


      if (isset($_GET["bt_submit2"])==TRUE){
        $race =$_GET['race'];
        $eleveur = $_GET['eleveur'];
        $exploitation = $_GET['exploitation'];
        $espece = $_GET['id_espece'];
        //echo $race;
        //echo $eleveur;

        // Affichage des animaux correspondants

        // Requete animal
        $query3 = "SELECT id_animal, identifiant_animal, id_sexe, surnom, nom_exploit, attribution
        FROM animal, exploitation, race
        WHERE animal.id_exploit= exploitation.id_exploit
        AND animal.id_race = race.id_race
        AND animal.id_race =$race
        AND race.id_espece = $espece";

        // execution de la requête et production d'un recordset
        $result3 =mysqli_query($link,$query3);
        $tab3 = mysqli_fetch_all($result3);
        $nblig= mysqli_num_rows($result3) ;

        // Création d'un tableau avec les animaux concernés.

        echo '<form method="POST">';
        echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Sélection des animaux</h2>";
        //echo "<div class='resulat'>";
        echo "<table class='resulat' border='1'> <tr>";
        echo "<th>  </th> <th> <a>Identifiant VACA </a> </th>
        <th><a> Identifiant National</a></th>
        <th><a> Sexe</a></th>
        <th><a> Surnom</a></th>
        <th><a> Localisation actuelle</a></th> </tr>";
        for ($i=0; $i<$nblig; $i++){
          echo '<td> <input type="checkbox" name="selected[]"
          value="'.$tab3[$i][0].'"></td>';
          echo "<td>".$tab3[$i][0]."<br></td>";
          echo "<td>".$tab3[$i][1]."<br></td>";
          echo "<td>".$tab3[$i][2]."</td>";
          echo "<td>".$tab3[$i][3]."</td>";
          echo "<td>".$tab3[$i][4]."</td>";
          echo "</tr>";
        }
        echo "</table>";
        //echo"</div>";
        ?>
      </div> <!--fin div left-->
      <!--Durée  -->
      <div class= "item-right">

        <div class="date">
          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Durée de la convention </h2>
          <h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Date de début :</h2>
          <input type="date" name ="date_deb" list="date_demande">
          <datalist id="date_debut">
          </datalist>


          <!-- Durée convention pour trier dans la BDD -->

          <h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Durée de la convention :</h2><br>
          <label for='radio1'> <p><b>1 an</b></p> </label>
          <input type="radio" name="duree" class="radio" id='radio1' value="2" required>

          <label for='radio2'> <p><b>2 an</b></p> </label>
          <input type="radio" name="duree" class="radio" id='radio2' value="3" required>

          <label for='radio3'> <p><b>Autre</b></p> </label>
          <input type="radio" name="duree" class="radio" id='radio3' value="4" required>
          
         <!--  <input type="radio" name="duree" class="radio" value=2>
          <label>1 an</label>

          <input type="radio" name="duree" class="radio" value=3>
          <label>2 ans</label>

          <input type="radio" name="duree" class="radio" value=4>
          <label>Autre durée</label> -->
        
          <!--choix date de fin si duree autre-->


          <h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Choix de la date de fin de la convention
            <i>/!\ que si la duree est autre /!\ </i>:<br> </h2>
            <br>
            <input type="date" name ="date_fin2" list="date_demande">
            <datalist id="date_fin2">
            </datalist>
          </div> <!--fin div date-->


          <!--Commentaire-->

          <h2 style='font-size:1em;width:auto;padding:5px;background:none;color:black;text-align:left'>Remarque :</h2>
          <textarea name="remarque_demande" row=3 cols=40></textarea>

          <br><br>
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

              //Récupérartion des id des animaux sélectionnés
              $query5 = "SELECT LAST_INSERT_ID() FROM demande"; //On recupere l'identifiant de la demande pour l'associer a chaque animal.
              $result5 =mysqli_query($link,$query5);
              $tab5 = mysqli_fetch_all($result5);
              $id_demande = $tab5[0][0];

              //Récupération du tableau fait a partir des données issues des checkbox
              $id_test=$_POST['selected'];

              //Récupération des id des animaux sélectionnés
              $query5 = "SELECT LAST_INSERT_ID() FROM demande"; //On recupere l'identifiant de la demande pour l'associer a chaque animal.
              $result5 =mysqli_query($link,$query5);
              $tab5 = mysqli_fetch_all($result5);
              $id_demande = $tab5[0][0];


              //Récupération du tableau fait a partir des données issues des checkbox
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
                  <p>Cliquez ici pour faire <a href='http://vaca/vaaca/Pages/Administrateur/Demande_animaux_admin.php?id_espece=3>une nouvelle attribution</a></p>
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

      <!--pied de page -->
      <div class="footer">
        <?php
        include("../../Style/Pied.html"); ?>
      </div>

    </body>
  </hmtl>
