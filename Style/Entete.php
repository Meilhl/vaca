<?php

function affiche_entete($role){

//<!--GESTION DE LA CONNEXION A LA SESSION ET RECUPERATION DES DONNEES DE CONNEXION-->


                //on crée une variable $url qui contiendra l'url de la page sur laquelle on est si on est pas déjà connecté au site
                $url = "valeur_par_defaut";

                // Si la variable de connexion existe et qu'elle est vraie (= l'utilisateur est bien connecté)
                if (isset($_SESSION["connexion"])&&($_SESSION["connexion"] == true))
                {
                    //on récupère les variables de connexion qui permettront de toujours savpir qui est connecté
                    //et de ne lui montrer que ce qu'il a le droit de voir
                    $id_profil= $_SESSION["id_profil"];
                    $id_type_profil = $_SESSION["id_type_profil"];
                    $identifiant_profil=$_SESSION["identifiant_profil"];
                }
                else {
                    //si l'utilisateur n'est pas connecté
                    // on va récupérer l'url de la page

                    // protocole utilisé : http ou https ? ==> on modifie la variable $url
                    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                    {
                        $url = "https://";
                    }
                    else
                    {
                        $url = "http://";
                    }

                    // hôte (nom de domaine voire adresse IP) => on ajoute à la variable $url
                    $url.= $_SERVER['HTTP_HOST'];

                    // emplacement de la ressource (nom de la page affichée) => on ajoute à la variable $url
                    $url.= $_SERVER['REQUEST_URI'];

                    // on affiche l'URL de la page courante
                    //echo "<br>".$url;

                    //on récupère la valeur de l'url dans la SESSION pour pouvoir la récupérer et savoir de quelle page on vient
                    $_SESSION["url"]=$url;

                    // on dirige l'utilisateur non connecté sur la page de connexion
                    header("Location:../Autre/Authentification.php");
                    exit();
                }
            ?>

        <div id="entete">

			<div class="gauche">
				<!-- Photo logo Conservatoire -->
				<img alt="" src="../../Image/logo_png.png" width="150" height="96">
			</div>

			<div class="droite">
				<!-- photo profil -->
				<li class="dropdown"><img  class="profil" alt="" src="../../Image/profil.png" width="40" height="40">
                    <div class="gauche">
                    <?php
                        if(isset($_SESSION["id_profil"])){
                            $id_profil= $_SESSION["id_profil"];
                        /* Connexion à la base de données*/
                        $link=mysqli_connect('localhost','root','','vaca');
                        mysqli_set_charset($link,"utf8mb4_general_ci");
                        mysqli_select_db($link,'vaca') or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
                        $query="SELECT nom, prenom, nom_exploit
                                FROM profil
                                LEFT JOIN attributiondesexploitations ON attributiondesexploitations.id_profil=profil.id_profil
                                LEFT JOIN exploitation ON attributiondesexploitations.id_exploit=exploitation.id_exploit
                                WHERE profil.id_profil=".$id_profil;

                        $result= mysqli_query($link, $query)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
                        $tab= mysqli_fetch_all($result);
                        echo"<div class='sous-titre'>".$tab[0][0]." ".$tab[0][1]."<br>".$tab[0][2]."</div>";
                        }

                     ?>
                    </div>
                        <div class="ongletentete">
                            <a href="../Utilisateur/Profil.php">Profil</a><br>
                            <a href="../Autre/Mes_documents.php">Mes documents</a><br>
                            <a href="../Autre/Deconexion.php">Deconnexion</a><br>
                        </div></li>
                <!-- récuperer le nom du gars-->

			</div>


            <div class="center">
				<!-- Logo VACA -->
				<img alt="" src="../../Image/logo_VACA.png" width="250" height="100">

            </div>


		</div>

        <?php
        require ("Navigation.php");
        affichenav($role);

}
        ?>
