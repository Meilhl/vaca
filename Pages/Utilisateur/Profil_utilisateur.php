<?php session_start();?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />

    <title>
		gestion de profil utilisateurs
	</title>
</head>
<body>

    <div class= "header">
    <?php   $role=2; require("../../Style/Entete.php"); affiche_entete($role);   ?>
    </div>

    <center><div class="borderfond">


<?php

$id_profil = $_SESSION["id_profil"];

//Debut du code
//ouverture à la base de données et tout le tralalaala
$link = mysqli_connect('localhost', 'root', '', 'vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");
mysqli_select_db ($link , "vaca")
or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

//1.requêtes pour les informations du profil : nom, prénom et identifiant pour se connecter du gars
//non modifiable et unique par exploitation

$query_profil ="SELECT id_profil, nom, prenom, identifiant_profil
 FROM profil
 WHERE id_profil=".$id_profil ;

 $result_profil = mysqli_query($link, $query_profil)
 or die ("impossible requête" .mysqli_error($link));

 $tab_profil = mysqli_fetch_all($result_profil);


 echo "<div class='row' style='height:150px;margin-bottom:20px'><div class='borderprofil'style='float:left;height:100%'>";

//affichage des informations du profil

  echo "<h3><u>Informations du profil : </u></h3>  <p style='text-align:left'> ● Nom : </li>". $tab_profil[0][1] .
  "<br> ● Prénom  : " .$tab_profil[0][2] .
  "<br>● Identifiant :  " .$tab_profil[0][3]."</p>" ;

  echo "</div>";

  //1.2requêtes pour les informations le l'exploitation du Profil : nom_exploit, adresse, supplement_adresse, commune, code postal
  //non modifiable et unique par exploitation

  $query_exploitation ="SELECT ex.nom_exploit, ex.adresse, ex.supplement_adresse, c.code_postal, c.commune
   FROM commune c, exploitation ex, attributiondesexploitations at, profil p
   WHERE c.id_commune=ex.id_commune AND ex.id_exploit=at.id_exploit AND at.id_profil=p.id_profil AND at.id_profil=".$id_profil ;

   $result_exploitation = mysqli_query($link, $query_exploitation)
   or die ("impossible requête exploit" .mysqli_error($link));

   $tab_exploitation = mysqli_fetch_all($result_exploitation);

   echo "<div class='borderprofil' style='float:right;height:100%'>";

   //affichage des informations de l'exploitation
    echo "<h3><u>Informations de l'exploitation : </u></h3>  <p style='text-align:left'> ● Nom de l'exploitation: </li>". $tab_exploitation[0][0] .
    "<br> ● Adresse  : " .$tab_exploitation[0][2]." ".$tab_exploitation[0][1].$tab_exploitation[0][3]." ".$tab_exploitation[0][4]. "</p>" ;

    echo "</div></div>";


//2. ajouter un contact à la base de données

    if(isset($_GET["ajout1"])){
        $nom_contact1=$_GET["nom1"];
        $tel1=$_GET["tel1"];
        $mail1=$_GET["mail1"];


//requête ajout dans la base de données
      $ajout_contact="INSERT INTO `contact`(`id_profil`, `tel`, `mail`, `nom_contact`)
      VALUES ('".$id_profil."','".$tel1."','".$mail1."','".$nom_contact1."')";
      mysqli_query($link,$ajout_contact);
    }

//2.modifier un contact.
    if(isset($_GET["modif2"])){

    $nom_contact2=$_GET["nom2"];
    $tel2=$_GET["tel2"];
    $mail2=$_GET["mail2"];
    $id_contact2=$_GET["id_contact2"];

//requête de modification de base de données
    $modif_contact="UPDATE contact SET tel= '".$tel2."', mail= '".$mail2."', nom_contact='".$nom_contact2."',id_contact='".$id_contact2."' WHERE id_contact='".$id_contact2."'" ;
    mysqli_query($link,$modif_contact);

    }

//3. affiche informations du contact du profil : tel, mail et nom du contact.
// modifiable , voir les points 2.
$query_contact ="SELECT contact.id_profil, tel, mail, nom_contact, id_contact
 FROM contact JOIN profil ON profil.id_profil=contact.id_profil
 WHERE contact.id_profil=".$id_profil ;

 $result_contact = mysqli_query($link, $query_contact)
 or die ("impossible requête" .mysqli_error($link));

 $tab_contact = mysqli_fetch_all($result_contact);
 $nbli= mysqli_num_rows ($result_contact) ;

 for ($i=0 ; $i<$nbli ;$i++){
  echo "<div class='borderprofil' style='width:450px'>";
//affichage
  echo "<h3><u>Informations du contact ".($i+1) ." : </u></h3>  <p style='text-align:left'> 👤​ Nom : </li>". $tab_contact[$i][3] .
  "<br> 📞​ Téléphone : " .$tab_contact[$i][1] .
  "<br> 🔗​ Adresse mail :  " .$tab_contact[$i][2]."</p>";


// 4. Personnalisation de son profil = changement des contacts.
  // 4.1 Formulaire pour modifier un contact. Ouvre une deuxième page Modifications.php
  //reprend l'id_contact dans l'URL pour modification spécifique
echo "<form action='Modifications.php' method='GET'>";
echo " <input type='hidden' name='id_contact' value='" .$tab_contact[$i][4]."'>";
echo " <input type='submit' name='modif' value='Modifier'>
      </form>  </div>";
}

//4.2 Formulaire pour ajouter un contact. quand on appuie sur OK, ajoute contact.

echo "<h2>Ajouter  un contact : </h2>";
echo" <div class='borderajout'>" ;

  echo "<form style='margin:0' name='form_ajout' method='GET' action='Profil_utilisateur.php'>
  <p style='text-align:left' >👤​ Nom : <input type='text' name='nom1' value=''>
  <br><br>📞​ Téléphone : <input type='text' name ='tel1' value=''>
  <br><br>🔗​ Adresse mail : <input type='text' name='mail1' value=''></p>";
  echo "<input type='submit' name='ajout1' value='OK'>
  </form> " ;
echo " </div>";



?>

    </div> </center>


    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>
