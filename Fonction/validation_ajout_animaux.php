<?php

require("creerListeHTMLfin.php");

/* Connexion à la base de données*/
$link=mysqli_connect('localhost','root','','vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");


/* Choix d'une BDD et message d'erreur si connexion impossible*/
mysqli_select_db($link,'vaca')
  or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));

if (isset($_GET["valid"]))
{
    $id=$_GET["animal"];
    $valid= "UPDATE animal SET en_attente='0'
    WHERE id_animal=$id";
    $push=mysqli_query($link,$valid);
}

/* Récupération des identifiant des observateurs ainsi que leurs nom */
$query1="SELECT id_animal, id_race, identifiant_animal, surnom, id_sexe, annee_naissance 
FROM animal
WHERE en_attente='1'";

//Exécution de la requête et production d'un recordset
$result1=mysqli_query($link,$query1) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
$tab1=mysqli_fetch_all($result1); // Création tableau php

$nbligne=mysqli_num_rows($result1);
$nbcol=mysqli_num_fields($result1);

echo "<form>";
for ($i=0; $i < $nbligne; $i++)				//boucle parcourant chaque colonne du recordset, 
		{
            for ($j=1; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
			    {
                    if ($j==1)
                    {
                        $query2="SELECT race FROM race WHERE id_race=".$tab1[$i][$j]."";
                        //Exécution de la requête et production d'un recordset
                        $result2=mysqli_query($link,$query2) or die("Impossible d'ouvrir la BDD vaca:".mysqli_error($link));
                        $tab2=mysqli_fetch_all($result2); // Création tableau php
                        echo $tab2[0][0]; echo " / ";
                    }
                    else
                    {
                    if ($j==$nbcol-1)
                        {echo $tab1[$i][$j];echo " ";}

                    else
                        {echo $tab1[$i][$j];echo " / ";}
                    }
                    
                }
            echo "<form>";
            echo "<input type='hidden' name='animal' value=".$tab1[$i][0].">";
            echo "<input type='submit' name='valid' value='ok'>";
            echo "<br>";
        }
echo "</form>";
mysqli_close($link);
?>