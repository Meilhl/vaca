<?php session_start();?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Ajout materiel
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
    <center><div class="border" style="width:40%;height:auto;padding:15px">
      <?php

      //connection a la base
      $link=mysqli_connect('localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");

      //choix d'une BDD et message erreur si connection impossible
      mysqli_select_db($link,'vaca')
      or die('Impossible d\'ouvrir la BDD vaca:'.mysqli_error($link));

      ?>
      <!--Creation de l'ajout de materiel -->
      <br><h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'> Modification de matériel </H2><hr>
        <?php
        if (isset($_GET["id"])){
          $id_materiel=$_GET["id"];

          echo '<form method="GET" action="3B1_Ajout_materiel.php" name= ajout_parametre_mat>';

          //$type_materiel=$_GET["type_materiel"];

          //recuperation id_max selon type de materiel
          $query_id_conservatoire="SELECT id_conservatoire, id_type_mat, nom_materiel, valeur_achat, annee_achat, date_prochainControle, plaque,lieu_stockage, disponibilite, commentaire_materiel
          FROM materiel
          WHERE id_materiel=".$id_materiel;
          $result_id_conservatoire=mysqli_query($link,$query_id_conservatoire) or die("impossible recup id conservatoire".mysqli_error($link));
          $tab_id_conservatoire=mysqli_fetch_all($result_id_conservatoire);
          $max=$tab_id_conservatoire[0][0];
          $type_materiel=$tab_id_conservatoire[0][1];
          $nom=$tab_id_conservatoire[0][2];
          $valeur_achat=$tab_id_conservatoire[0][3];
          $annee_achat=$tab_id_conservatoire[0][4];
          $dateControle=$tab_id_conservatoire[0][5];
          $plaque=$tab_id_conservatoire[0][6];
          $stockage=$tab_id_conservatoire[0][7];
          $commentaire=$tab_id_conservatoire[0][9];


          // test pour afficher les differents formulaires
          if($type_materiel==1)
          {
            echo "<INPUT type= 'hidden' name='type_materiel' value=$type_materiel>";
            echo "<INPUT type= 'hidden' name='id_conservatoire' value=".$max.">";
            ?>
            <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Identifiant: CRA-0<?php echo $type_materiel."-0".$max;?></h2>
            <INPUT type=text name="nom_materiel" placeholder="Nom du matériel..." size=20 <?php echo "value=".$nom;?>><br><br>
              <INPUT type=text name="plaque_imatriculation" placeholder="Plaque d'immatriculation..." size=20 <?php echo "value=".$plaque;?>>
                <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Date du prochain contrôle technique : </h2>
                <INPUT type=date name="date_prochain_controle_technique" size=20 <?php echo "value=".$dateControle;?> >
                  <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Date d'achat :</h2>
                  <?php
                  $tab_annee=[];
                  for ($j=0;$j<20;$j++)
                  {
                    $tab_annee[$j] = date('Y') -19 +$j;
                  }
                  $list_annee="list_annee";
                  echo "<select name =".$list_annee.">";
                  for ($i=0; $i < count($tab_annee); $i++)
                  {
                    echo "<option value = '" .$tab_annee[$i] .  "' >" . $tab_annee[$i] ." </option> ";
                    echo "<option value = '" .$annee_achat .  "' selected>" . $annee_achat ." </option> ";
                  }
                  echo"</select>";
                  ?>
                  <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Valeur d'achat : </h2>
                  <INPUT type=text name="valeur_achat_mat" size="20" <?php echo "value=".$valeur_achat;?>><br><br>
                    <INPUT type=text name="lieu_stockage" placeholder="Lieu de stockage..." size="20" <?php echo "value=".$stockage;?>><br><br>
                      <label class='container' style="text-align:left"> Disponible pour les éleveurs
                        <input  type='checkbox' name="dispo_materiel" value='1' checked>
                        <span class='checkmark'></span>
                      </label>
                      <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Informations : </h2>
                      <textarea name="info_materiel" row=1 cols=40 <?php echo "value=".$commentaire;?>> </textarea>
                      <br><INPUT type="submit" name="valid_ajout_materiel" value="Valider">
                      </form>
                      <?php
                    }
                    elseif($type_materiel==2 OR $type_materiel==3 OR $type_materiel==4 OR $type_materiel==5 OR $type_materiel==6)
                    {
                      echo "<INPUT type= 'hidden' name='type_materiel' value=".$type_materiel.">";
                      echo "<INPUT type= 'hidden' name='id_conservatoire' value=".$max.">";
                      ?>
                      <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Identifiant: CRA-0<?php echo $type_materiel."-0".$max;?></h2>
                      <INPUT type=text name="nom_materiel" placeholder="Nom du matériel..." size=20 <?php echo "value=".$nom;?>><br><br>

                        <!-- création d'une liste évolutive avec les années-->
                        <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Date d'achat :</h2>
                        <?php
                        $tab_annee=[];
                        for ($j=0;$j<20;$j++)
                        {
                          $tab_annee[$j] = date('Y') -19 +$j;
                        }
                        $list_annee="list_annee";
                        echo "<select name =".$list_annee.">";
                        for ($i=0; $i < count($tab_annee); $i++)
                        {
                          echo "<option value = '" .$tab_annee[$i] .  "' >" . $tab_annee[$i] ." </option> ";
                          echo "<option value = '" .$annee_achat .  "' selected>" . $annee_achat ." </option> ";
                        }
                        echo"</select>";
                        ?>
                        <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Valeur d'achat : </h2>
                        <INPUT type=text name="valeur_achat_mat" size="20" <?php echo "value=".$valeur_achat;?>><br><br>
                          <INPUT type=text name="lieu_stockage" placeholder="Lieu de stockage..." size="20" <?php echo "value=".$stockage;?>><br><br>
                            <label class='container' style="text-align:left"> Disponible pour les éleveurs
                              <input  type='checkbox' name="dispo_materiel" value='1' checked>
                              <span class='checkmark'></span>
                            </label>
                            <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Informations : </h2>
                            <textarea name="info_materiel" row=1 cols=40 <?php echo "value=".$commentaire;?>> </textarea>
                            <br><INPUT type="submit" name="valid_ajout_materiel" value="Valider">
                          </form>
                          <?php
                        }
                        else{
                          echo "<INPUT type= 'hidden' name='type_materiel' value=".$type_materiel.">";
                          echo "<INPUT type= 'hidden' name='id_conservatoire' value=".$max.">";
                          ?>
                          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Identifiant: CRA-0<?php echo $type_materiel."-0".$max;?></h2>
                          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'> Nom du matériel :</h2>
                          <?php
                          $nom_materiel = "SELECT id_materiel,nom_materiel FROM materiel
                          WHERE id_type_mat=4";
                          $result_nom_mat=mysqli_query($link,$nom_materiel) or die("impossible extraire list type materiel".mysqli_error($link));
                          $tab_nom_mat=mysqli_fetch_all($result_nom_mat);
                          echo "<select name ='numero_materiel'>";
                          for ($j=0; $j < count($tab_nom_mat); $j++)
                          {
                            echo "<option value = '" .$tab_nom_mat[$j][1] .  "' selected>" . $tab_nom_mat[$j][1] ." </option> ";
                          }
                          echo"</select>";
                          ?>
                          <!--<INPUT type=text name="nom_materiel" size=20>-->
                          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Date d'achat :</h2>
                          <?php
                          $tab_annee=[];
                          for ($j=0;$j<20;$j++)
                          {
                            $tab_annee[$j] = date('Y') -19 +$j;
                          }
                          $list_annee="list_annee";
                          echo "<select name =".$list_annee.">";
                          for ($i=0; $i < count($tab_annee); $i++)
                          {
                            echo "<option value = '" .$tab_annee[$i] .  "' >" . $tab_annee[$i] ." </option> ";
                            echo "<option value = '" .$annee_achat .  "' selected>" . $annee_achat ." </option> ";
                          }
                          echo"</select>";
                          ?>
                          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Valeur d'achat par unité : </h2>
                          <INPUT type=text name="valeur_achat_mat" size="20" <?php echo "value=".$valeur_achat;?>><br><br>
                            <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Quantite : </h2>
                            <INPUT type=text name="quantite" size="20" <?php echo "value=".$quantite;?>>
                              <INPUT type=text name="lieu_stockage" placeholder="Lieu de stockage..." size="20" <?php echo "value=".$stockage;?>><br><br>
                                <label class='container' style="text-align:left"> Disponible pour les éleveurs
                                  <input  type='checkbox' name="dispo_materiel" value='1' checked>
                                  <span class='checkmark'></span>
                                </label>
                                <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Informations : </h2>
                                <textarea name="info_materiel" row=1 cols=40 <?php echo "value=".$commentaire;?>> </textarea>
                                <br><INPUT type="submit" name="valid_ajout_materiel" value="Valider">
                                </form>
                                <?php

                              }
                              ?>

                              <!--ajout à la BDD-->
                              <?php
                              if (isset($_GET["valid_ajout_materiel"])==TRUE)
                              {
                                // récupération des selections

                                $type_materiel=$_GET["type_materiel"];
                                $nom_materiel=$_GET["nom_materiel"];
                                $id_conservatoire=$_GET["id_conservatoire"];

                                if(isset($_GET["plaque_imatriculation"]))
                                {
                                  $plaque_imatriculation=$_GET["plaque_imatriculation"];
                                }
                                else
                                {
                                  $plaque_imatriculation=NULL;
                                }
                                if(isset($_GET["date_prochain_controle_technique"]))
                                {
                                  $date_prochain_controle_technique=$_GET["date_prochain_controle_technique"];
                                }
                                else
                                {
                                  $date_prochain_controle_technique=NULL;
                                }
                                $list_annee=$_GET["list_annee"];

                                $valeur_achat_mat=$_GET["valeur_achat_mat"];

                                if(isset($_GET["dispo_materiel"]))
                                {
                                  $disponibilite_eleveur=$_GET["dispo_materiel"];
                                }
                                else
                                {
                                  $disponibilite_eleveur=0;
                                }
                                if (isset($_GET["dispo_materiel"]))
                                {
                                  $disponibilite_materiel=$_GET["dispo_materiel"];
                                }
                                else
                                {
                                  $disponibilite_materiel=0;
                                }
                                if (isset($_GET["info_materiel"]))
                                {
                                  $information=$_GET["info_materiel"];
                                }
                                else
                                {
                                  $information=NULL;
                                }
                                if (isset($_GET["retour_depot"]))
                                {
                                  $retour_depot=$_GET["retour_depot"];
                                }
                                else
                                {
                                  $retour_depot=NULL;
                                }
                                if (isset($_GET["lieu_stockage"]))
                                {
                                  $lieu_stockage=$_GET["lieu_stockage"];
                                }
                                else
                                {
                                  $lieu_stockage=NULL;
                                }
                                if (isset($_GET["quantite"]))
                                {
                                  $quantite=$_GET["quantite"];
                                }
                                else
                                {
                                  $quantite=NULL;
                                }

                                // à rajouter dans la base de donnée selon le type de materiel
                                //formulaire pour le type remorque

                                if($type_materiel==1)
                                {
                                  $ajout="INSERT materiel (id_conservatoire,id_type_mat,nom_materiel,valeur_achat,annee_achat,date_prochainControle,plaque,
                                    disponibilite,commentaire_materiel)
                                    VALUES ('$id_conservatoire','$type_materiel','$nom_materiel','$valeur_achat_mat','$list_annee',
                                      '$date_prochain_controle_technique','$plaque_imatriculation','$disponibilite_eleveur','$information')";
                                      mysqli_query($link,$ajout)or die ('erreur sql 307'.$ajout.mysqli_error($link));
                                    }
                                    // forumalire pour les autres type d'élements
                                    elseif($type_materiel==2 OR $type_materiel==3 OR $type_materiel==4 OR $type_materiel==5 OR $type_materiel==6){
                                      $ajout="INSERT materiel ($id_conservatoire,id_type_mat,nom_materiel,valeur_achat,annee_achat,disponibilite,commentaire_materiel)
                                      VALUES ('$id_conservatoire','$type_materiel','$nom_materiel','$valeur_achat_mat','$list_annee','$disponibilite_eleveur','$information')";
                                      mysqli_query($link,$ajout)or die ('erreur sql 313'.$ajout.mysqli_error($link));
                                    }
                                    else
                                    {
                                      for ($i=0;$i<=$quantite;$i++)
                                      // boucle pour ajouter plusieurs fois le même élément
                                      {

                                        $ajout="INSERT materiel ($id_conservatoire,materiel.id_type_mat,nom_materiel,valeur_achat,annee_achat,disponibilite,commentaire_materiel)
                                        VALUES ('$id_conservatoire','$type_materiel','$nom_materiel','$valeur_achat_mat','$list_annee','$disponibilite_eleveur','$information')";
                                        mysqli_query($link,$ajout)or die ('erreur sql 313'.$ajout.mysqli_error($link));
                                      }
                                    }
                                  }
                                }// fin if isset id_mat
                                ?>
                              </div></center>
                            </div>
                            <div class="footer">
                              <?php include("../../Style/Pied.html"); ?>
                            </div>
                          </body>
                          </html>
