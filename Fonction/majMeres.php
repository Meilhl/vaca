<?php
// Définition du tableau de prénoms
require('creerListeHTML1val.php');
require('creerListeHTML2.php');
require('creerListeHTMLfin.php');
require("creerTabHTML.php");
// Connexion à la base de données
$link=mysqli_connect('localhost','root','','vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");

// Choix d'une BDD et message d'erreur si connexion impossible
mysqli_select_db($link,'vaca')
  or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));

// Récupération du début du prénom tapé

$chaine=$_GET["debut"];
$chaine2=$_GET["type"];
$debut=strval($chaine);

$query3= "SELECT identifiant_animal
FROM animal, sexe
WHERE  animal.id_race=$chaine2 and animal.id_sexe=sexe.id_sexe and sexe.id_sexe='F'";



//Exécution de la requête et production d'un recordset
$result3=mysqli_query($link,$query3) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
$a=mysqli_fetch_all($result3); // Création d'un tableau php
$nbligne=mysqli_num_rows($result3);
$nbcol=mysqli_num_fields($result3);

// On attend 5 secondes...
//sleep(5);

$propositions=array();
// Recherche de prénoms dans le tableau correspondant au texte saisie

	for($i=0; $i<$nbligne; $i++)
	{
		for ($j=0; $j<$nbcol;$j++)
		{
		if (strtolower($debut)==strtolower(substr($a[$i][$j],0,strlen($debut))))
		{
				//Construction de la phrase de requête puis mise à la fin d'un tableau
				$stp='animal.identifiant_animal="'. $a[$i][$j].'" ';
				array_push($propositions,$stp);
		}

		}
	}
	$phrase="";
	/*Parcours le tableau des propositions avec les morceaux de requête
	et construit la phrase de condition sql*/
		for ($i=0; $i<count($propositions); $i++)
		{
			if ($i==count($propositions)-1)
			{
				$phrase=$phrase.$propositions[$i];
			}
			else
			{
				$phrase=$phrase.$propositions[$i];
				$phrase=$phrase.'or ';
			}
		}
		if($phrase!="")
		{
			$query="SELECT id_animal, identifiant_animal, surnom, annee_naissance
		FROM animal
		Where $phrase";


		$result=mysqli_query($link,$query) or die("Impossible d'ouvrir la BDD race:".mysqli_error($link));
		$c=mysqli_fetch_all($result); // Création d'un tableau php
		$nblig=mysqli_num_rows($result);
		$nbco=mysqli_num_fields($result);
		$t=array('id_sql','race','id_animal','nom','année-naissance');
		creerListeHTMLfin("id_mere",$c,$nbco,$nblig,'---');

		}
		else
		{
			echo "<h2 style='font-size:0.8em;font-style:italic;width:auto;padding:5px;background:none;color:black;'>L'identifiant que vous avez tapé ne correspond à aucun animal connu.</h2>";
		}



?>
