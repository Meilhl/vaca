
<meta charset="UTF-8">

	<?php
	include ("creerListeHTMLjava.php") ;

	$link = mysqli_connect('localhost', 'root', '', 'vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");

//Ouverture BDD
mysqli_select_db ($link , "vaca")
or die ("impossible d'ouvrir la BDD Vaca : ". mysqli_error($link)) ;

/* requête pour afficher le matériel de type 1 (véhicule) et disponible */
$query_materiel = "SELECT DISTINCT id_materiel, nom_materiel FROM materiel WHERE id_type_mat = 1 AND disponibilite = 1" ;
$result_materiel = mysqli_query($link, $query_materiel)
	or die ("impossible requête" .mysqli_error($link));

	$tab_mat = mysqli_fetch_all($result_materiel);   	// le tableau PHP

	echo "<form method='GET' action='1B_Demande_materiel.php'>" ;
	echo "<br> <h3> 🚚​​ Selectionner le véhicule : </h3> <br>" ;

			$nom_liste_materiel = "ListeMateriel" ;
			$liste_materiel = creerListeHTML($nom_liste_materiel, $tab_mat);

 echo "</form>";

	?>
	<!-- Ci-dessous la section réservée à l'affichage de la bulle -->
	<div id="infobulle">
	<!-- Pour le moment, cette section est vide... -->
	</div>
