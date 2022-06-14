<?php session_start(); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <script type="text/javascript">
    function closeW(){
        window.close();}
    </script>
    <title>
		Ajout de commune
	</title>
</head>
<body>
    <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
    <br>
    </div>

    <div class="corps">
        <center><div class="border" style="width:40%;height:auto;padding:5px">
          <h2 style='line-height:1.5em;width:auto;padding:5px;background:none;color:black'>Ajout d'une commune à la Base de Données</h2><hr><br>
            <form method='POST' action='Ajouter_commune.php' name='form_ajouter_commune'>
            <?php
            /*Connexion à la base de données*/
            $link=mysqli_connect('Localhost','root','','vaca');
            mysqli_set_charset($link,"utf8mb4_general_ci");
            mysqli_select_db($link,'vaca')
                or die ('impossible d\'ouvrir la BDD: '. mysqli_error($link));

            /* RECUPERATION DES COMMUNES EN LIEN AVEC LE PROFIL POUR COMPARAISON*/
            $queryCommune="SELECT *
                FROM commune";
            $resultCommune=mysqli_query($link, $queryCommune)
                or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
            $tabCommune=mysqli_fetch_all($resultCommune);
            mysqli_free_result($resultCommune);


             /*Affichage des inputs*/
            if (isset($_POST['ajout_commune'])){
                $ajout_commune=$_POST['ajout_commune'];
                echo "<input type='text' name='ajout_commune' value ='".$ajout_commune."'placeholder=' Commune...' required><br><br> ";
            }else{
                echo "<input type='text' name='ajout_commune' placeholder=' Commune...' required><br><br>";}
            if (isset($_POST['code'])){
                $code=$_POST['code'];
                echo "<input type='number' name='code' placeholder='Code postal' value='".$code."'required><br><br> ";
            }else{
                echo "<input type='number' name='code' placeholder='Code postal' required><br><br> ";}

            echo "<input type='submit' name='submit' value='Ajouter la commune'> <br><br></form>";

            /*Modification de la BDD*/

            if (isset($_POST['submit'])){
                $ajout_commune=$_POST['ajout_commune'];
                $code=$_POST['code'];
                $erreur=0;
                for ($i=0;$i<count($tabCommune);$i++){
                    if ($tabCommune[$i][1]==$ajout_commune){
                        echo "<div class='box'>
                                <h3>La commune existe déjà dans la base de donnée</h3>
                                </div>";
                        $erreur=1;
                    }
                }
                if ($erreur==0){
                    $query = "INSERT INTO `commune`(`commune`, `code_postal`)
                        VALUES ('".$ajout_commune."','".$code."')";
                    $result = mysqli_query($link, $query);
                    if ($result){
                        echo "<div class='box'>
                            <h3>La commune a été ajoutée avec succés</h3>";
                        echo "</div>";
                    }
                }
            }
          /*JS POUR FERMER ONGLET*/      ?>

        <?php
        mysqli_close($link);
        ?>
        <a href="Ajout_exploit.php">Retour sur creer exploitation</a>
      </div></center>
    </div>
    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>
