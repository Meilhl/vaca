<?php

$link = mysqli_connect('localhost', 'root', '', 'vaca') ;
mysqli_set_charset($link, "utf8mb4_general_ci") ;

mysqli_select_db($link, 'vaca') 
    or die("Impossible d'ouvrir la BDD vaca : " . mysqli_error($link)) ;

$id = $_GET['id'] ;

$query_supp = 'DELETE FROM materiel WHERE id_materiel = ' . $id ;

mysqli_query($link, $query_supp) 
    or die(mysqli_error()) ;


?>