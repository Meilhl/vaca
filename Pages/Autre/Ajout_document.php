<?php 
    session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <title>
		Ajout document
	</title>
</head>
<body>
    <div class= "header">
    <?php 
        //on récupère l'id du profil pour savoir qui est connecté et de ne lui montrer que ce qu'il a le droit de voir
        $id_profil= $_SESSION["id_profil"];
        $id_type_profil = $_SESSION["id_type_profil"];
        
        $role=2;
        require("../../Style/Entete.php");
        affiche_entete($role);
    ?>
    <br>
    </div>
    
    <div class="corps">
     <?php
        // Connexion à la base de données
        $link=mysqli_connect('localhost','root','','vaca');
        mysqli_set_charset($link,"utf8mb4_general_ci");

        // Choix d'une BDD et message d'erreur si connexion impossible 
        mysqli_select_db($link,'vaca')
          or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link)); 
          
        //appel des fonctions dont on aura besoin
        require "../../Fonction/creerListeHTML2.php";
    ?> 
    <br>
    <H2>Ajout d'un nouveau document</H2>
    <br>
    <!--formulaire pour récupérer le type de document à ajouter-->    
    <form method="POST" action="Ajout_document.php" onsubmit="Ajouter" enctype="multipart/form-data" name="form_ajout_doc">
    <table>
        <tr>
            <td><p>Choisissez le type de document à ajouter : </p></td>
            <td>
            <?php
                
                //creation de variables pour controler ce qui est afficher en premier dans la liste deroulante selon ce qui est selectionne
                $affiche_type_doc=0;
                
                //si on a selectionne qqc dans la liste deroulante on affecte la valeur selec à la variable crée précédemment
                if (isset($_POST["liste_type_doc"]))
                {
                    $affiche_type_doc=$_POST["liste_type_doc"];
                }
                
                //requete pour recuperer les libelés des types de docs 
                $query_type_doc="SELECT id_typeP, lib_docsP
                                FROM typedocsprofil";
                                
                //Exécution de la requête et production d'un recordset
                $result_type_doc=mysqli_query($link,$query_type_doc) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
                $tab_type_doc=mysqli_fetch_all($result_type_doc);
                
                //on nomme la future liste qu'on va creer en stockant son nom dans une variable
                $liste_type_doc="liste_type_doc";
                        
                //affichage de la liste déroulante des types de documents
                creerListeHTML2($liste_type_doc,$tab_type_doc,$affiche_type_doc);
    
            ?> 
            </td>
        </tr>    
        <br>
        <!--Gestion de l'ajout d'un document-->
        <tr>
            <td>
            <p><label for="fileupload"> Veuillez choisir un document</label></p> 
            </n>(image ou pdf de moins de 2Mo)  
            </td>
            <td>
            <input type="file" name="fileupload" value="fileupload" id="fileupload" accept="application/pdf, image/*" >
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
            <input type="submit" name="bt_submit" value="Valider">
            </td>
        </tr>
    </table>
    </form>
    
    <?php
        if(isset($_POST["bt_submit"]))
        {
            //RECUP DES VARIABLES
            $id_type_doc=$_POST["liste_type_doc"];
            
            //ENREGISTREMENT DU DOCUMENT
            
            
            //pour changer la taille max autorisé
           /*  $upload_max_filesize = 3M;
            $post_max_size = 3M; */
            
            //vérification de la taille

            $taille_fichier = filesize($_FILES['fileupload']['tmp_name']);
            
            if ($taille_fichier == '')
            
            {
                echo "Le fichier est tros gros... Veuillez réessayer avec un fichier de moins de 2 Mo. ";
            }
            else
            { 
            
                //nom du dossier où on enregistre le document
                $uploaddir = 'C:/wamp64/www/VACA/vaaca/Documents_profil/'; 
                //nom de l'emplacement sur le serveur (lien pour y accéder)
                $uploadfilelocalhost = 'http://vaca/vaaca/Documents_profil/';
                //nom de l'emplacement du document qu'on enregistre (chemin du dossier ($uploaddir) + nom du fichier (basename($_FILES['fileupload']['name'])))
                $uploadfile = $uploaddir . basename($_FILES['fileupload']['name']);
                //nom de l'emplacement sur le serveur du document qu'on enregistre
                $uploadfilelocalhost = $uploadfilelocalhost . basename($_FILES['fileupload']['name']);
                //on déplace l'image téléchargée dans ce dossier
                move_uploaded_file($_FILES['fileupload']['tmp_name'], $uploadfile); 
                
                //récupération de l'emplacement du doc, du lien sur le serveur et du nom du doc pour pouvoir les réutiliser plus tard
                $_SESSION["filename"] = $uploadfile;
                $_SESSION["lien"]= $uploadfilelocalhost;
                $_SESSION["nom_document"] = basename($_FILES['fileupload']['name']);
                
                /*echo "<br>nom document (basename(_FILES['fileupload']['name'])) : ".$_SESSION["nom_document"].
                    "<br>lien (uploadfilelocalhost) : ".$uploadfilelocalhost."<br> filename(uploadfile) : ".$uploadfile; */
                
                //AJOUT DANS LA BDD
                
                //requete pour vérifier si le doc est pas déjà dans la bdd
                $query_verif= "SELECT * FROM docsprofil WHERE emplacementP='".$uploadfile."'limit 1";
                
                $result_verif=mysqli_query($link,$query_verif) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));  
                
                //si le fichier existe déjà dans la bdd
                
                if ((mysqli_num_rows($result_verif)==1))
                {
                    // NE FONCTIONNE PAS VRAIMENT A REVOIR...
                    echo "<br><p>Le fichier existe déjà. 
                    <br> Vous pouvez ajouter un autre document ou consulter tous vos documents : <a href='Mes_documents.php'>Accéder à mes documents</a></p>";
                }    
                
                else                
                { 
                    $query_ajout_doc="INSERT into docsprofil (id_profil,id_typeP,emplacementP,lienP) VALUES (".$id_profil.",".$id_type_doc.",'".$uploadfile."','".$uploadfilelocalhost."')";
                                    
                    //Exécution de la requête et production d'un recordset
                    mysqli_query($link,$query_ajout_doc) or die("<br>Impossible d'ouvrir la BDD vaca : ".mysqli_error($link));
                    
                    echo "<br><p>Votre document a été ajouté avec succès! 
                    <br> Vous pouvez ajouter un autre document ou consulter tous vos documents : <a href='Mes_documents.php'>Accéder à mes documents</a> </p>";   
                }
            }
            
            
        }
    ?>
    
    <?php
        //fermer le recordset et la bdd
        mysqli_free_result($result_type_doc);
        mysqli_close($link);
    ?>
    
    <br style="clear:both;">   
        
    </div>
    
    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>