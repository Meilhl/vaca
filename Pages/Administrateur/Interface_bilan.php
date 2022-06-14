<?php
	session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />

    <!--Pour afficher la carte-->
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

    <title>
		Bilan
	</title>
    <!--style de la carte-->
    <style>
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>
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

        <center><div class="border" style="width:40%;height:auto">
			<form method = 'POST' action = 'Interface_bilan.php' name = 'form_date'>
			<div class="flex-item-right">
                <!--Dates-->


            </form>
			<?php
				require("../../Fonction/creerListeHTML2.php");

				/* Connexion à la base de données*/
				$link=mysqli_connect('localhost','root','','vaca');
				mysqli_set_charset($link,"utf8mb4_general_ci");

				/* Choix d'une BDD et message d'erreur si connexion impossible*/
				mysqli_select_db($link,'vaca')
				  or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));

				$query1="SELECT id_race, race
				FROM race";

				$result1 = mysqli_query($link, $query1)or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
				$lib_race = mysqli_fetch_all($result1);
				$valeur1 = '__';


				if (isset($_GET['lst_race'])==TRUE){
				$valeur1 = $_GET['lst_race'];
				}

				echo "<td>";
					echo "<form method = 'GET' action = 'Interface_bilan.php' name = 'form_race'>";
						//Sélection du mode de création de bilan//
						echo "<input type = 'radio' name='tri' value = '1'> Bilan par race";
						echo "<input type = 'radio' name='tri' value = '2'> Bilan par animal";
						//Période concernée pour le Bilan//
						echo "<label for='debut_dem'> <p>Bilan pour la période :</p> <br></label>";
                        echo "<input type='date' name= 'debut' list='date_debut' >";
                            echo "<datalist id='debut'>";
                            echo "</datalist>";
                        echo "<input type='date' name= 'fin' list='date_fin'>";
                            echo "<datalist id='fin'>";
                            echo "</datalist>";

					echo "<BR><BR> Race : <BR>";
						creerListeHTML2('lst_race', $lib_race, $valeur1);
						echo "<br><br><input type = submit name = 'sub_race1' value = 'Enregistrer'>";
					echo "</form>";
			?>
			<?php
				//Quand il y a sélection d'un bilan par animal la condition est vérifié
				if(isset($_GET['tri'])==TRUE AND $_GET['tri']==2){
					if (isset($_GET['lst_race'])==TRUE AND isset($_GET['debut'])==TRUE AND isset($_GET['fin'])==TRUE AND isset($_GET['lst_race'])){
						$id_race = $_GET['lst_race'];
						$debut_periode = $_GET['debut'];
						$fin_periode = $_GET['fin'];
						$bilan_par = $_GET['tri'];

						$query2="SELECT id_animal, identifiant_animal
						FROM animal
						WHERE id_race = " . $id_race . "";

						$result2 = mysqli_query($link, $query2);
						$lib_animal = mysqli_fetch_all($result2);
						$valeur2 = '__';

						if (isset($_GET['lst_animal'])==TRUE){
						$valeur2 = $_GET['lst_animal'];
						}

						echo "<td>";
							echo "Animal : ";
							echo "<form method = 'GET' action = 'Interface_bilan.php' name = 'form_animal'>";
								creerListeHTML2('lst_animal', $lib_animal, $valeur2);
								echo "<input type = hidden name = 'lst_race' value = $id_race>";
								echo "<input type = hidden name = 'tri' value = $bilan_par>";
								echo "<input type = hidden name = 'debut' value = $debut_periode>";
								echo "<input type = hidden name = 'fin' value = $fin_periode>";
								echo "<input type = submit name = 'sub_animal' value = 'Générer Bilan'>";
							echo "</form>";
					}
			?>
			<?php

				if (isset($_GET['lst_animal'])==TRUE AND isset($_GET['debut'])==TRUE AND isset($_GET['fin'])==TRUE AND isset($_GET['lst_race']))

                {


                    $id_animal = $_GET['lst_animal'];

                    //TABLEAU DES DISTANCES
                    //requête pour récupérer les coordonnées géo associées aux demandes concernant l'animal sélectionné
                    //durant la période sélectionnée et uniquement si la demande a été validée
                    $query_coord="SELECT nom_exploit, coordX, coordY, date_debut,date_fin FROM demande
                                    INNER JOIN attributiondesanimaux ON demande.id_demande=attributiondesanimaux.id_demande
                                    INNER JOIN animal ON attributiondesanimaux.id_animal=animal.id_animal
                                    INNER JOIN profil ON demande.id_profil=profil.id_profil
                                    INNER JOIN attributiondesexploitations ON profil.id_profil=attributiondesexploitations.id_profil
                                    INNER JOIN exploitation ON attributiondesexploitations.id_exploit=exploitation.id_exploit
                                    INNER JOIN statutdemande ON demande.id_statutDem=statutdemande.id_statutDem
                                    WHERE attributiondesanimaux.id_animal='".$id_animal."'
                                    AND date_debut >='".$debut_periode."'
                                    AND date_fin <='".$fin_periode."'
                                    AND statutdemande.id_statutDem='1'
                                    ORDER BY date_debut";

                    $result_coord = mysqli_query($link, $query_coord) or die ('pb : ' . mysqli_error($link)) ;
                    $tab_coord = mysqli_fetch_all($result_coord) ;
                    $nblig_coord = mysqli_num_rows($result_coord) ;
                    $nbcol_coord=mysqli_num_fields($result_coord);

                    require ("../../Fonction/calculDistance.php");
                    //si pas de trajets effectués
                    if ($nblig_coord==1)
                    {
                       echo "<p><b>Aucun trajet n'a été effectué avec cet animal pour la période sélectionnée.</b></p>";

                    }
                    //sinon on affiche la carte
                    else
                    {
                        //CREATION DU TABLEAU DES DISTANCES


                        echo "<br><br>";
                        echo "<h2><p>Trajets effectués pour l'animal sélectionné : </p></h2>" ;
                        echo "<br><br>";

                        //création du tableau
                        echo "<CENTER><TABLE BORDER = 1>";

                        // crée l'en-tête du tableau avce les noms des champs de la requête
                        echo "<THEAD>";
                        echo "<TR>";
                        echo "<TD>". $tab_nom[0][0]= "Point de départ </TD>";
                        echo "<TD>". $tab_nom[0][1]="Point d'arrivée </TD>";
                        echo "<TD>". $tab_nom[0][2]="Distance (en km)</TD>";
                        echo "</TR>";
                        echo "</THEAD>";

                        // crée le corps du tableau
                        echo "<TBODY>";
                            for ($i=0; $i < $nblig_coord-1; $i++)
                            {

                                echo "<TR>";
                                //on rempli la première colonne avec les exploit de départ
                                echo "<TD>". $tab_distance[$i][0]=$tab_coord[$i][0]."</TD>";
                                //on rempli la deuxième colonne avec les exploit d'arrivée

                                echo "<TD>". $tab_distance[$i][1]=$tab_coord[$i+1][0]."</TD>";
                                //on rempli la 2ème colonne avec les distances entre départ et arrivée
                                 echo "<TD>". $tab_distance[$i][2]= round(calculDistance($tab_coord[$i][2], $tab_coord[$i][1], $tab_coord[$i+1][2] , $tab_coord[$i+1][1], 'k'),2)."</TD>";

                                echo "</TR>";

                            }
                        echo "</TBODY>";
                        echo "</TABLE></CENTER>";

                        // calcul de la somme des distances
                        $somme=0;
                        for ($i=0; $i<count($tab_distance); $i++)
                        {
                            $somme+=floatval($tab_distance[$i][2]);
                        }

                        // affichage du total de la distance parcourue
                        echo "<CENTER><TABLE>";
                        echo "<TR>";
                        echo "<TD> <p>Total de la distance parcourue : </p></TD>";
                        echo "<TD><p><b>" .round($somme, 2)." km </b></p></TD>";
                        echo "</TR>";
                        echo "</TABLE></CENTER>";


                        echo "<BR><BR>";

                        // CREATION DE LA CARTE

                        //calcul des moyennes des coordonnées des exploitations pour centrer la carte dessus
                        $somme_lat=0;
                        $somme_long=0;

                        for ($i=0;$i < $nblig_coord;$i++)
                        {
                            $somme_lat += $tab_coord[$i][2];
                            $somme_long += $tab_coord[$i][1];
                        }

                        $moy_lat=($somme_lat)/$nblig_coord;
                        $moy_long=($somme_long)/$nblig_coord;

                        //affichage de la carte

                        echo "<p><b>Carte des exploitations</b></p>";
                        echo "<CENTER><TABLE>";

                ?>

                        <div id='map'>;

                        <script>

                        <?php
                            //positionnement du centre de la carte (lat, long, zoom)
                            echo "var map = L.map('map').setView([".$moy_lat.", ".$moy_long."], 8);";
                        ?>
                            //insertion d'une zone carto d'open street map
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                            }).addTo(map);

                            //paramètres de l'icône de localisation
                            var myIcon = L.Icon.extend({
                                options: {
                                    iconSize:     [55, 70],
                                    iconAnchor:   [22, 94],
                                    popupAnchor:  [-3, -76]
                                }
                            });

                            // def de l'image de l'icône de localisation
                            var localisation = new myIcon({iconUrl: '../../Image/placeholder.png'});

            <?php
                        //boucle pour créer les points
                            for ($i=0; $i<$nblig_coord; $i++)
                            {
                                echo 'var mPt = L.marker(['.$tab_coord[$i][2].', '.$tab_coord[$i][1].'], {icon: localisation}).addTo(map).bindPopup(" Exploitation '.($i+1).' : '.$tab_coord[$i][0].'");';
                            }


                        echo "</script>";
                        echo "</div>";

                        echo "</TABLE></CENTER>";
                    }
					
                
					
					
					$fichier = 'C:/wamp64/www/projet_vaca/Bilan/Bilan.csv';
					//Vérification de l'existence d'un Bilan précédement généré et suppression
				    
					if(file_exists($fichier)){
						unlink( $fichier );
					}
					
					$id_animal = $_GET['lst_animal'];
					$id_race = $_GET['lst_race'];
					$debut_periode = $_GET['debut'];
					$fin_periode = $_GET['fin'];

					//Requête pour la génération de bilan pour la période et le race
					$query3= "SELECT demande.id_demande, date_debut, surnom, identifiant_animal, id_sexe, espece, nom_exploit, coordX, coordY
					FROM  animal, race, espece, exploitation, demande, attributiondesanimaux, etape
					WHERE animal.id_animal = '" . $id_animal . "'
					AND date_validation > '" . $debut_periode . "'
					AND date_validation < '" . $fin_periode . "'
					AND demande.id_demande = attributiondesanimaux.id_demande
					AND animal.id_animal = attributiondesanimaux.id_animal
					AND animal.id_race = race.id_race
					AND race.id_espece = espece.id_espece
					AND demande.id_demande = etape.id_demande
					AND etape.id_exploit = exploitation.id_exploit";
					$gen_bilan = mysqli_query($link, $query3);
					$bilan = mysqli_fetch_all($gen_bilan);
					$entete = array('id demande', 'date_debut', 'surnom', 'id animal', 'idsexe', 'espece', 'exploitation', 'coordX', 'coordY');

					//Ecriture du fichier bilan
					$file = fopen($fichier, 'w');
					//création de la ligne d'entête
					fputcsv($file, $entete, ';');
					//Remplissage avec le résultat de la requête ligne par ligne
					foreach ($bilan as $row){
						fputcsv($file, $row, ';');
					}
					fclose($file);

					//lien pour accéder au fichier pour le téléchargement
					echo "<a href = '/../../Bilan/Bilan.csv' > Bilan de l'animal </a>";

					echo "<form method = 'GET' action = 'Interface_bilan.php' name = 'form_animal'>";
						echo "<input type = hidden name = 'lst_animal' value = $id_animal>";
						echo "<input type = hidden name = 'lst_race' value = $id_race>";
					echo "</form>";

					mysqli_close($link);
				}
				}

            ?>


			<?php
				if(isset($_GET['tri']) AND $_GET['tri'] == 1){
					if (isset($_GET['lst_race'])==TRUE AND isset($_GET['debut'])==TRUE AND isset($_GET['fin'])==TRUE){

						$fichier = 'C:/wamp64/www/VACA/vaca/Bilan/Bilan.csv';
						if(file_exists($fichier)){
							unlink( $fichier );
						}

					$id_race = $_GET['lst_race'];
					$debut_periode = $_GET['debut'];
					$fin_periode = $_GET['fin'];

					//Requête pour la génération de bilan pour la période, la race et l'animal
					$query4= "SELECT demande.id_demande, date_validation, surnom, identifiant_animal, id_sexe, espece, nom_exploit, coordX, coordY
					FROM animal, race, espece, exploitation, demande, attributiondesanimaux, etape
					WHERE animal.id_race = '" . $id_race . "'
					AND date_validation > '" . $debut_periode . "'
					AND date_validation < '" . $fin_periode . "'
					AND demande.id_demande = attributiondesanimaux.id_demande
					AND animal.id_animal = attributiondesanimaux.id_animal
					AND animal.id_race = race.id_race
					AND race.id_espece = espece.id_espece
					AND demande.id_demande = etape.id_demande
					AND etape.id_exploit = exploitation.id_exploit";
					$gen_bilan_race = mysqli_query($link, $query4);
					$bilan_race = mysqli_fetch_all($gen_bilan_race);
					$entete = array('id demande', 'date_validation', 'surnom', 'id animal', 'idsexe', 'espece', 'exploitation', 'coordX', 'coordY');

					//Ecriture du fichier bilan
					$file = fopen($fichier, 'w');
					//création de la ligne d'entête
					fputcsv($file, $entete, ';');
					//Remplissage avec le résultat de la requête ligne par ligne
					foreach ($bilan_race as $row){
						fputcsv($file, $row, ';');
					}
					fclose($file);
					//lien pour accéder au fichier pour le téléchargement
					echo "<a href = '/../../Bilan/Bilan.csv' > Bilan de la race </a>";





				}

					echo "<form method = 'GET' action = 'Interface_bilan.php' name = 'form_animal'>";
						echo "<input type = hidden name = 'lst_race' value = $id_race>";
					echo "</form>";

					mysqli_close($link);
					}


			?>

		</div>

    </div>
</center>
    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>
