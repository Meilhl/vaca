<?php
//ouverture de session
session_start();
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Authentification
  </title>
  <!--Nouvel en tête pour la page car pas de barre de navigation si profil pas encore identifié-->
  <div id="entete">
    <div class="gauche">
      <!-- Photo logo Conservatoire -->
      <img alt="" src="../../Image/logo_png.png" width="150" height="96" ALING="left">
    </div>
    <div class="center">
      <!-- Logo VACA -->
      <img alt="" src="../../Image/logo_VACA.png" width="250" height="100">
    </div>
  </div>

</head>

<body>
  <!--Boite de text d'introdution du site-->
  <div class='header' style='margin:0 12px;'>
    <div class='bienvenue'>
      <h1>Bienvenue sur VACA</h1>
      <center style='color:grey;font-size:0.8em'><i>Site de suivi du matériel et des animaux d'élevage</center></i>
    </div>

    <?php

    //si on venant déjà d'une autre page du site on recupere l'url d'e la page d'origine
    if (isset($_SESSION["url"]))
    {
      $url=$_SESSION["url"];
    }
    else
    {
      $url="valeur_par_defaut";
    }

    //Connexion classique à la BDD
    $link= mysqli_connect('localhost', 'root','','vaca');
    mysqli_set_charset($link, "utf8mb4_general_ci");

    mysqli_select_db($link, 'vaca')
    or die('Impossible de sélectionner la BDD vaca : '. mysqli_error($link));

    //Check if the mdp is in the BDD
    if(isset($_POST['identifiant_profil'])){

      $identifiant_profil=$_POST['identifiant_profil'];
      $mdp=$_POST['mdp'];

      //2 requetes: une pour verifier les identifiants et une pour les droits

      $sql= "select * FROM profil WHERE identifiant_profil='".$identifiant_profil."'
      AND mdp='".$mdp."' limit 1";
      $sql_droit="select id_type_profil, id_profil FROM profil WHERE identifiant_profil='".$identifiant_profil."'";

      $result=mysqli_query($link,$sql);
      $res_droit=mysqli_query($link, $sql_droit);
      $droit=mysqli_fetch_all($res_droit);


      //Si le requete a trouvé de correspondance, row=1 donc identifiant_profil et mdp est valide
      //Apres des autres if pour verifier aussi le droit de utilisation
      if (mysqli_num_rows($result)==1)
      {
        //on crée une variable pour indiquer qu'on est connecté
        $_SESSION["connexion"]=True;

        // on récupère des variables pour connaitre les droits de l'utilisateur connecté
        //qu'on gardera sur toute les pages
        $_SESSION["id_type_profil"]=$droit[0][0];
        $_SESSION["id_profil"]=$droit[0][1];


        //si on a pas récupéré l'identifiant du profil et que le droit est d'1 (=admin)
        if(!isset($_SESSION["identifiant_profil"]) && $droit[0][0]==1)
        {
          //on récupère l'identifiant du profil
          $_SESSION['identifiant_profil'] = $identifiant_profil;

          if ($url=="valeur_par_defaut")
          {
            //si on ne venait pas d'une autre page du site => aller à page d'accueil d'adm
            header("Location: ../Administrateur/Accueil_administrateur.php");
            exit();
          }
          else
          {
            //si on venait déjà d'une autre page du site on retourne vers la page d'où on venait
            header("Location: ".$url);
            exit();
          }
        }

        //si on a pas récupéré l'identifiant du profil et que le droit >1 (=utilisateur)
        if(!isset($_SESSION["identifiant_profil"]) && $droit[0][0]>1)
        {
          //on récupère l'identifiant du profil
          $_SESSION['identifiant_profil'] = $identifiant_profil;
          $id_profil=$_SESSION['id_profil'] ;
          $query_conv="SELECT consentement
          FROM profil
          WHERE id_profil=$id_profil";
          $res_conv=mysqli_query($link, $query_conv);
          $tab_conv=mysqli_fetch_all($res_conv);
          $conv=$tab_conv[0][0];

          if ($conv==0 OR $conv==NULL ){
            header("Location: ../Utilisateur/Validation_consentement.php");
            exit();
          }
          else{
            if ($url == "valeur_par_defaut")
            {
              //si on ne venait pas d'une autre page du site => aller à page d'accueil utilisateur
              header("Location: ../Utilisateur/Accueil_utilisateur.php");
              exit();
            }
            else
            {
              //si on venait déjà d'une autre page du site on retourne vers la page où on était
              header("Location: ".$url);
              exit();
            }
          }
        }
      }
      else{
        //si identifiant et mdp pas trouvé dans la bdd, on indique une erreur et on recharche la page de connexion
        echo'<script type="text/javascript">alert("Echec de connexion :(") </script>'; //alerte de non connexion
        header("Location: ../Autre/Authentification.php");
        exit();
      }

    }


    ?>
  </div>
  <div class="corps" style="background-color: rgba(159,185,153,0);">
    <center>
      <div class="border" style='width:40%;height:auto'>
        <form method="POST" action='#'>
          <h2 style='line-height:2em;width:auto;padding:5px;background:none;color:black'> Identification </h2>
          <input type="text" name="identifiant_profil" placeholder="Mail"> <br>
          <br>
          <input type="password" name="mdp" placeholder="Mot de passe">
          <br><br><br>
          <input type='SUBMIT' name='bt_submit' value='Connexion'><br>
          <!--<p>Mot de passe oublié?</p>-->
        </form>
      </div>
    </center><br>
  </div>

  <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
  </div>

</body>
</hmtl>
