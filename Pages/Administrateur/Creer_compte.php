<?php session_start(); ?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
  <title>
    Creation de compte
  </title>
</head>
<body>
  <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
  </div>

  <div class="corps" style="background-color: rgba(159,185,153,0);">
    <center><div class="border" style='width:35%;height:auto'>
      <?php
      //Connexion à la base de données
      $link=mysqli_connect('Localhost','root','','vaca');
      mysqli_set_charset($link,"utf8mb4_general_ci");
      mysqli_select_db($link,'vaca')
      or die ('impossible d\'ouvrir la BDD: '. mysqli_error($link));


      //Formulaire création de compte
      if (isset($_POST['id_type_profil'],$_POST['nom'], $_POST['prenom'], $_POST['identifiant_profil'],$_REQUEST['mdp'])){
        // récupérer le nom d'utilisateur et supprimer les antislashes ajoutés par le formulaire
        $identifiant_profil = stripslashes($_POST['identifiant_profil']);
        $identifiant_profil = mysqli_real_escape_string($link, $identifiant_profil);
        $_SESSION["new_profil"]=$identifiant_profil;
        // récupérer le nom et supprimer les antislashes ajoutés par le formulaire
        $nom = stripslashes($_POST['nom']);
        $nom = mysqli_real_escape_string($link, $nom);
        // Ainsi de suite
        $prenom = stripslashes($_POST['prenom']);
        $prenom = mysqli_real_escape_string($link, $prenom);
        $mdp = stripslashes($_POST['mdp']);
        $mdp = mysqli_real_escape_string($link, $mdp);
        $id_type_profil = stripslashes($_POST['id_type_profil']);
        $id_type_profil = mysqli_real_escape_string($link, $id_type_profil);

        //requéte SQL + mot de passe crypté
        $query = "INSERT into profil (id_type_profil, nom, prenom, identifiant_profil, mdp)
        VALUES ($id_type_profil, '$nom', '$prenom', '$identifiant_profil', '$mdp')";

        // Exécuter la requête sur la base de données
        //Sucess de creation de compt
        if (mysqli_query($link, $query)){
          echo "<div class='box'>
          <h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>L'inscription a été réalisée avec succès !</h2>
          <h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;'>Cliquer <a href='Acces_Race_Eleveur.php'>ici</a> pour attribuer les droits au profil</h2>
          </div>";
        }
      }else{
        ?>
        <!-- Formulaire de saisie-->
        <form style='padding:10px' action="#" method="POST">
          <h2 style='line-height:2em;width:auto;margin:0;background:none;color:black;font-size:2em'>Création d'un profil</h2><hr>
          <!--Case a cocher -->
          <label style='float:left;font-size:1em;font-family:Verdana;font-weight: bold;'> Choix du type de compte:<br> <br></label>
          <br style='clear:both'>
          <input style='float:left' type="radio" name="id_type_profil" value=1>
          <label style='float:left;font-size:1em;font-family:Verdana;font-weight: bold;'> Administrateur<br> </label>
          <br style='clear:both'>
          <input style='float:left' type="radio" name="id_type_profil" value=2>
          <label style='float:left;font-size:1em;font-family:Verdana;font-weight: bold;'> Eleveur <br></label>
          <br style='clear:both'>
          <input style='float:left' type="radio" name="id_type_profil" value=3>
          <label style='float:left;font-size:1em;font-family:Verdana;font-weight: bold;'> Association <br></label>
          <br><br><br>
          <input type="text" name="nom" placeholder="Nom" required /> <br><br>
          <input type="text" name="prenom" placeholder="Prénom" required /> <br><br>
          <input type="email" name="identifiant_profil" placeholder="Mail" required /> <br><br>
          <input type="password"  name="mdp" placeholder="Mot de passe" required /> <br><br>
          <br>
          <input type="submit" name="submit" value="Valider l'inscription"  />
        </form>
      <?php }
      mysqli_close($link);
      ?>


    </div></center>


  </div>
  <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
  </div>
</body>
</hmtl>
