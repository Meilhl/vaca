<?php

//Section de Menu : à insérer sur chacune des pages pour eleveur
function affichenav($role)
{

if ($role==1){?>
    <!-- Navigation pour admin-->
    <div class="navigation">
		<ul>
			<li class="gauche"><a class="oui" href="../Administrateur/Accueil_administrateur.php">Conservatoire</a></li>
            <li class="gauche"><a class="oui" href="../Administrateur/Agenda.php">Agenda</a></li>
            <li class="dropdown"><a class="non">Faire une demande</a>
                <table class="ongletnav">
                    <tr><th>Animaux</th>    <th>Matériel</th></tr>
                    <tr><td><a class="black" href="../Administrateur/Demande_bovins_admin.php?id_espece=1">Bovin</a></td> 
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=1">Remorque</a></td></tr>
                    <tr><td><a class="black" href="../Administrateur/Demande_animaux_admin.php?id_espece=3">Ovin</a></td>
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=2">Contention d'animaux</a></td></tr>
                    <tr><td><a class="black" href="../Administrateur/Demande_animaux_admin.php?id_espece=4">Caprin</a></td>
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=3">Volaille</a></td></tr>
                    <tr><td><a class="black" href="../Administrateur/Demande_bovins_admin.php?id_espece=2">Equin</a></td>
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=4">Support de communication</a></td></tr>
                    <tr><td></td>
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=5">Apiculteur</a></td></tr>
                    <tr><td></td>
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=6">Transport des animaux</a></td></tr>
                    <tr><td></td>
                    <td><a class="black" href="../Administrateur/Demande_materiel_admin.php?id_type_mat=7">Autres</a></td></tr>

                </table></li>
            <li class="dropdown"><a class="non">Bilan</a>
                <div class="ongletnav">
                    <a class="black" href="../Administrateur/3A_Animaux_admin.php">Animal</a>
                    <a class="black" href="../Administrateur/3B_Materiel_admin.php">Matériel</a>
                    <a class="black" href="../Administrateur/3Bbis_Petit_materiel_admin.php">Petit matériel</a>
                    <a class="black" href="../Administrateur/Interface_Bilan.php">Bilan</a>
                </div></li>
            <li class="dropdown"><a class="non">Admin</a>
                <div class="ongletnav">
                    <a class="black" href="../Administrateur/Creer_compte.php">Création nouveau compte</a>
                    <a class="black" href="../Administrateur/Ajout_exploit.php">Création nouvelle exploitation</a>
                    <a class="black" href="../Administrateur/Modif_Acces_Race_Eleveur.php">Attribution des droits</a>
                    <a class="black" href="../Administrateur/attribution_exploit_profil.php">Attribution des exploitations</a>
                    <a class="black" href="../Administrateur/Attribution_Reproducteur.php">Attribution des reproducteurs</a>
                    <a class="black" href="../Administrateur/Modification_Consentement.php">Modification du consentement</a>
                    <a class="black" href="../Administrateur/Modification_valeur_reproducteur.php">Modification de la valeur du reproducteur</a>
                </div></li>
             <li class="droite"><a href="../Administrateur/3C_Requete.php">Les demandes</a></li>

         </ul>
	</div>
    <?php }
    else {?>
    <!-- Navigation pour eleveur-->
    <div class="navigation">
		<ul>
			<li class="gauche"><a href="../Utilisateur/Accueil_utilisateur.php">Ma ferme</a></li>
            <li class="dropdown"><a>Faire une demande</a>
                <table class="ongletnav">
                    <tr><th>Animaux</th>    <th>Matériel</th></tr>
                    <tr><td><a class="black" href="../Utilisateur/1A_Demande_animaux.php?id_espece=1">Bovin</a></td> 
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=1">Remorque</a></td></tr>
                    <tr><td><a class="black" href="../Utilisateur/1A_Demande_animaux.php?id_espece=3">Ovin</a></td>
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=2">Contention d'animaux</a></td></tr>
                    <tr><td><a class="black" href="../Utilisateur/1A_Demande_animaux.php?id_espece=4">Caprin</a></td>
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=3">Volaille</a></td></tr>
                    <tr><td><a class="black" href="../Utilisateur/1A_Demande_animaux.php?id_espece=2">Equin</a></td>
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=4">Support de communication</a></td></tr>
                    <tr><td></td>
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=5">Apiculteur</a></td></tr>
                    <tr><td></td>
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=6">Transport des animaux</a></td></tr>
                    <tr><td></td>
                    <td><a class="black" href="../Utilisateur/1B_Demande_materiel.php?id_type_mat=7">Autres</a></td></tr>

                </table></li>
                </table>
            <li class="droite"><a href="../Utilisateur/2A_Mes_demandes.php">Mes demandes</a></li>
            <li class="droite"><a href="../Utilisateur/2B_Animaux_eleveur.php">Mes animaux</a></li>

		</ul>
	</div>
<?php
    }
}

?>