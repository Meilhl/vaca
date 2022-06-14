<?php
    //ouverture de session
    session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <title>
		Validation de création de compte
	</title>
</head>
<body>
    <div class= "header">
    <?php
    $role=0;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
    <br>
    </div>

    <div class="corps">
        <center><div class='border' style='width:40%;height:auto'>
            <h1 class="box-title">Validation du consentement du partage  d'informations</h1>
            <br><br>
            <form method='POST' action='Validation_consentement.php' name='form_validation_consentement'>
            <?php
                /*Connexion à la base de données*/
                $link=mysqli_connect('Localhost','root','','vaca');
                mysqli_set_charset($link,"utf8mb4_general_ci");
                mysqli_select_db($link,'vaca')
                    or die ('impossible d\'ouvrir la BDD: '. mysqli_error($link));

                /* RECUPERATION DES INFORMATIONS DU PROFIL*/

                $id_profil=$_SESSION['id_profil'];
                //$id_profil=$_GET['id_profil'];

                /* RECUPERATION DES RACES EN LIEN AVEC LE PROFIL*/
                $queryRace="SELECT race, race.id_race
                    FROM race
                    JOIN accesrace ON race.id_race=accesrace.id_race
                    WHERE id_profil=".$id_profil." and acces_race=1";
                $resultRace=mysqli_query($link, $queryRace)
                    or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
                $tabRace=mysqli_fetch_all($resultRace);
                mysqli_free_result($resultRace);


                /*Affichage des races accessible et des pdfs de consentement*/

                for ($i=0;$i<count($tabRace);$i++){
                    echo "<center>";
                    echo $tabRace[$i][0]." ";
                    echo "<button type='submit' formtarget='_blank' name='ouvrirpdf' method='GET' formaction='../../Fonction/generationPDFconsentementrace.php?id_race=".$tabRace[$i][1]."'>Télécharger la fiche de consentement.</button><br><br>";
                }
                /*Informations du contact*/
                if (isset($_POST["consentement"])){

                    echo"<center><input type='checkbox' id='consentement' name='consentement' checked><label for='consentement'>
                    Je certifie avoir pris connaissances des informations présente sur la/les fiche(s) de consentement(s) et je m'engage à la retourner signée  au Conservatiore des races d'Aquitaine.
                    </label></center>
                    <br><br>";
                }
                else{
                    echo"<center><input type='checkbox' id='consentement' name='consentement' ><label for='consentement'>
                    Je certifie avoir pris connaissances des informations présente sur la/les fiche(s) de consentement(s) et je m'engage à la retourner signée  au Conservatiore des races d'Aquitaine.
                    </label></center>
                    <br><br>";
                }
                ?>

                <input type='submit' name='valider' value='Validation inscription'> <br><br>
            </form>

            <form method='POST' action='Accueil_utilisateur.php' name='form_retour_accueil'>

                <?php
                //Mettre seulement des required et vérification mdp et bouton
                /*Modification des informations du profil dans la BDD*/
                if (isset($_POST["valider"]) and isset($_POST["consentement"])){
                    /*MODIFIER*/
                    $query = "UPDATE `profil` SET `consentement`='1' WHERE `id_profil`='".$id_profil."'";
                    $result = mysqli_query($link, $query);
                    echo"<input type='submit' name='go_acceuil' value='Redirection Acceuil'>";
                }
        ?>
</form>
        <?php
        mysqli_close($link);
        ?>
      </div></center>
    </div>
    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>
