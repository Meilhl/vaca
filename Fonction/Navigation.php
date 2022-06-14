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
            <li class="dropdown"><a class="non">Demande</a>
                <table class="ongletnav">
                    <tr><th>Animaux</th>    <th>Materiel</th></tr>
                    <tr><td><a class="black" href="../Administrateur/Demande_animaux_admin.php">Bovin</a></td>  <td><a class="black" href="../Administrateur/Demande_materiel_admin.php">Véhicule</a></td></tr>
                    <tr><td><a class="black" href="../Administrateur/Demande_animaux_admin.php">Ovin</a></td>   <td><a class="black" href="../Administrateur/Demande_materiel_admin.php">Petit materiel</td></tr>
                </table></li>
            <li class="dropdown"><a class="non">Bilan</a>
                <div class="ongletnav">
                    <a class="black" href="../Administrateur/3A_Animaux_admin.php">Animaux</a>
                    <a class="black" href="../Administrateur/3B_Materiel_admin.php">Materiel</a>
                </div></li>
            <li class="dropdown"><a class="non">Admin</a>
                <div class="ongletnav">
                    <a class="black" href="Creer_compte.php">Creation nouveau compte</a>
                </div></li>
         </ul>
	</div>
    <?php }
    else {?>
    <br><br><br><br>
    <!-- Navigation pour eleveur-->
    <div class="navigation">
		<ul>
			<li class="gauche"><a href="../Utilisateur/Accueil_utilisateur.php">Ma ferme</a></li>
            <li class="dropdown"><a>Faire une demande</a>
                <table class="ongletnav">
                        <tr><th>Animaux</th>    <th>Materiel</th></tr>
                        <tr><td><a href="../Utilisateur/1A_Demande_animaux.php">Bovin</a></td>  <td><a href="1B_Demande_materiel.php">Véhicule</a></td></tr>
                        <tr><td><a href="../Utilisateur/1A_Demande_animaux.php">Ovin</a></td>   <td><a href="1B_Demande_materiel.php">Petit materiel</td></tr>
                </table>
		</ul>
	</div>
<?php
    }
}

?>
