<?php
//$link : lien pour BDD
//$tab_id_demande : table avec les id des demandes animal
//$id : boucle sur les indices de tab_id_demande
//$id_statutDem : id selon le statut de la demnde validé en cours refusé
function Affiche_demande_animaux($link, $tab_id_demande, $id, $id_statutDem){
    
        $id_demande=$tab_id_demande[$id][0];
        /* Récupération des informations sur la demande*/
        $query1="SELECT demande.id_demande, date_demande, race, quantite, lib_duree, date_debut,date_fin,Libelle_demande,id_statutTran,reponse_demande, demande.id_race, demande.id_duree, reponse_demande
        FROM demande, profil, race, dureeconvention,statutdemande
        WHERE race.id_race = demande.id_race 
        AND demande.id_profil = profil.id_profil
        AND demande.id_duree = dureeconvention.id_duree
        AND demande.id_demande =".$id_demande." AND statutdemande.id_statutDem = ".$id_statutDem; 

        $result1 = mysqli_query($link, $query1)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
        $info_demande = mysqli_fetch_all($result1);
        
// affichage 
        echo "<h3>Demande d'animaux n°" . $info_demande[0][0] . "</h3>";
        echo "<p>Date de la demande: " . $info_demande[0][1] . "<BR>";
        echo "Race : " . $info_demande[0][2] . "<BR>";
        echo "Quantité : " . $info_demande[0][3] . "<BR>";
        echo "Durée de la convention : ". $info_demande[0][4]."<br>";
        echo "Date de début de la convention : ". $info_demande[0][5]."<br>";
        echo "Date de fin de la convention : ".$info_demande[0][6]."<br>";
        echo "la demande est <b>".$info_demande[0][7]."</b><br>";
        if ($info_demande[0][8]==0){
            echo"Contacter : ".$info_demande[0][9];
            echo "<p>le transport n'a pas été effectué</p>";
        }
        else {
            echo "le transport a été effectué</p>";
        }
        // echo $info_demande[0][9];
        
}

//$link : lien pour BDD
//$tab_id_demande : table avec les id des demandes animal
//$id : boucle sur les indices de tab_id_demande
//$id_statutDem : id selon le statut de la demnde validé en cours refusé
function Affiche_demande_materiel($link, $tab_id_demande_mat, $id, $id_statutDem){
    $id_demande_mat=$tab_id_demande_mat[$id][0];
    /* Récupération des informations sur la demande*/
    $query_mat2="SELECT id_demande, date_demande, lib_materiel, quantite, lib_duree, date_debut,date_fin,Libelle_demande, demande.id_materiel, demande.id_duree
    FROM demande, profil, materiel, dureeconvention,statutdemande,typedemateriel
    WHERE materiel.id_materiel = demande.id_materiel 
    AND demande.id_profil = profil.id_profil
    AND demande.id_duree = dureeconvention.id_duree
    AND statutdemande.id_statutDem = demande.id_statutDem 
    AND demande.id_materiel=materiel.id_materiel
    AND materiel.id_type_mat=typedemateriel.id_type_mat
    AND id_demande = ".$id_demande_mat;

    $result2 = mysqli_query($link, $query_mat2)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
    $info_demande_mat2 = mysqli_fetch_all($result2);

    // affichage des informations 

    //$num_race = $info_demande[0][8];
    echo "<h3>Demande de matériel n°" . $info_demande_mat2[0][0] . "</h3>";
    echo "<p>Date de la demande: " . $info_demande_mat2[0][1] . "<BR>";
    echo "Type de matériel : " . $info_demande_mat2[0][2] . "<BR>";
    echo "Quantité : " . $info_demande_mat2[0][3] . "<BR>";
    echo "Durée de la convention : ". $info_demande_mat2[0][4]."<br>";
    echo "Date de début de la convention : ". $info_demande_mat2[0][5]."<br>";
    echo "Date de fin de la convention : ".$info_demande_mat2[0][6]."<br>";
    echo "la demande est <b>".$info_demande_mat2[0][7]."</b></p>";
}
?>