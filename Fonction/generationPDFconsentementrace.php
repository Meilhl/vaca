<?php
if (isset($_GET['id_race'])){
    $id_race=$_GET['id_race'];}

/*Connection à la BDD et modification*/   
$link=mysqli_connect('Localhost','root','','vaca'); 
mysqli_set_charset($link, " utf8mb4_general_ci") ;        
$require="UPDATE textconvention 
                SET text='".$id_race."'
                WHERE lib_bloc='racepdf'";
mysqli_query($link,$require)
        or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));

/*Redirection vers la page de génération de la fiche de consentement*/                
$redirect_page='generationPDFconsentement.php';
header('Location:'.$redirect_page);    
?>