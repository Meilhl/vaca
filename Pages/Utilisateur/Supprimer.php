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
$id_contact=$_GET["id_contact"];
$id_profil = $_SESSION["id_profil"];
//ouverture à la base de données et tout le tralalaala
$link = mysqli_connect('localhost', 'root', '', 'vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");
mysqli_select_db ($link , "vaca")
or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

$query_contact ="SELECT contact.id_profil, tel, mail, nom_contact, id_contact
 FROM contact JOIN profil ON profil.id_profil=contact.id_profil
 WHERE contact.id_contact=".$id_contact ;

 $result_contact = mysqli_query($link, $query_contact)
 or die ("impossible requête" .mysqli_error($link));

 $tab_contact = mysqli_fetch_all($result_contact);
 $nbli= mysqli_num_rows ($result_contact) ;

$nom_contact=$tab_contact[0][3];
$tel=$tab_contact[0][1];
$mail=$tab_contact[0][2] ;

//formulaire de renvoie pour supprimer les données, GET en page "Profil_utilisateur.php avec le if isset"

echo"<h3 style='text-align:left'> Contact à supprimer : </h3> <br>";
echo"<form action ='Profil_utilisateur.php'>
  <p style='text-align:left' >👤​ Nom : <input type='text' name='nom2' value='".$nom_contact."'>
  <br><br>📞​ Téléphone : <input type='text' name ='tel2' value='".$tel."'>
  <br><br>🔗​ Adresse mail : <input type='text' name='mail2' value='".$mail."'>
  <input type='hidden' name='id_contact2' value='".$id_contact."'></p>";

echo "<input type='submit' name='supp2' value='OK'>
  </form>";
?>

    </div> </center>

      <div class="footer">
      <?php include("../../Style/Pied.html"); ?>
      </div>
</body>
</hmtl>
