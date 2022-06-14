<?php
$id_profil=$_GET['id_profil'];
$quantite=$_GET['quantite'];
$duree=$_GET['duree'];
$identifiant="";
for ($i=0;$i<$quantite;$i++){
    $identifiant.=$_GET['animal'.$i];
    $identifiant.=",";
}

/*Connection à la BDD et modification*/   
$link=mysqli_connect('Localhost','root','','vaca'); 
mysqli_set_charset($link,"utf8mb4_general_ci");
 
 
 
$require="UPDATE textconvention 
                SET text='".$id_profil."'
                WHERE lib_bloc='Conv_id_profil'";
mysqli_query($link,$require)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));


$require="UPDATE textconvention 
                SET text='".$duree."'
                WHERE lib_bloc='Conv_duree'";
mysqli_query($link,$require)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));


$require="UPDATE textconvention 
                SET text='".$identifiant."'
                WHERE lib_bloc='Conv_identifiant_animal'";
mysqli_query($link,$require)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));

/*Redirection vers la page de génération de la fiche de consentement*/                
$redirect_page='generationPDFconvention.php';
header('Location:'.$redirect_page);    
?>