<?php session_start() ; ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <title>
        Suppression de matériel
    </title>
</head>

<body>
    <div class= "header">
        <?php
        $role=1;
        require("../../Style/Entete.php");
        affiche_entete($role); 
        ?>
    </div>

    <div class="corps">
        
        <center><div class="border" style="width:40%;height:auto">

        <?php

        // Lien et ouverture de la base de données vaca

        $link = mysqli_connect('localhost', 'root', '', 'vaca') ;
        mysqli_set_charset($link, "utf8mb4_general_ci") ;
        
        mysqli_select_db($link, 'vaca')      
            or die("Impossible d'ouvrir la BDD vaca : " . mysqli_error($link)) ;

        echo "<h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Supprimer un matériel</h2><hr>";

        // Récupération de l'id et du nom du matériel concerné pour la suppression
        $id = $_GET['id'] ;
        $nom = $_GET['nom'] ;
        
        echo "<h2 style='font-size:1.3em;width:auto;padding:5px;background:none;color:black;text-align:left'>Sélectionner la quantité de \"$nom\" à supprimer : </h2><br><br>" ;

        // Formulaire pour sélectionner la quantité et la transmettre, ainsi que retransmettre le nom et l'id
        echo '<form method="GET" name="form_suppr" action="3Bbis_Petit_materiel_admin.php">' ;
            
            echo '<input type="number" name="nb_suppr" value="0">' ;
            
            echo '<input type="hidden" name="id" value="' . $id . '">' ;
            echo '<input type="hidden" name="nom" value="' . $nom . '">' ;
            
            echo '<br><br><input type="submit" name="bt_suppr" value="Supprimer">' ;
        
        echo '</form>' ;


        ?>

    </div></center>
    </div>

    <div class="footer">
        <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>
