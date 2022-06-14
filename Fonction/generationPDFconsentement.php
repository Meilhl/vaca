<?php
// Besoin de récupérer le titre, les blocs et les infos sélectionnée
/*Récupération des données*/
$link=mysqli_connect('Localhost','root','','vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");
mysqli_select_db($link,'vaca') or die ("impossible d'ouvrir la BDD: ". mysqli_error($link));
/*Récupération des titres et des différents blocs de text */
$queryText="SELECT id_bloc_convention, text FROM textconvention";
$resultText=mysqli_query($link, $queryText) or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
$tabText=mysqli_fetch_all($resultText);
mysqli_free_result($resultText);

/*Extraction des données à afficher*/
for ($i=0;$i<count($tabText);$i++){
    switch($tabText[$i][0]){
        case 1:
            $titre_fiche_consentement=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 2:
            $page_consentement_1=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 3:
            $bloc_1=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 4:
            $page_consentement_2=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 5:
            $bloc_2=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 6:
            $bloc_3=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 7:
            $bloc_4=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
        case 8:
            $id_racepdf=iconv('UTF-8', 'windows-1252',html_entity_decode($tabText[$i][1],ENT_QUOTES));
            break;
    }
}


/*Récupération du nom de la race*/

$queryRace="SELECT race
            FROM race
            WHERE id_race=".$id_racepdf;
$resultRace=mysqli_query($link, $queryRace)
            or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
$tabRace=mysqli_fetch_all($resultRace);
        mysqli_free_result($resultRace);

$racepdf=iconv('UTF-8', 'windows-1252',$tabRace[0][0]); // Problème d'encodage

/*Récupération des noms des associations en lien avec la race */
$queryAsso="SELECT profil.nom
            FROM profil
            INNER JOIN accesrace ON profil.id_profil=accesrace.id_profil
            WHERE accesrace.id_race=".$id_racepdf." and accesrace.acces_race=1 and profil.id_type_profil=3";
        $resultAsso=mysqli_query($link, $queryAsso)
            or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
        $tabAsso=mysqli_fetch_all($resultAsso);
        mysqli_free_result($resultAsso);


/*Appel librairie fpdf*/
require("../Library/fpdf/fpdf.php");


/*Definition des fonctions pour générer le pdf*/
class PDF extends FPDF
{

// En-tête
function Header()
{
    global $titre;
    // Logo
    $this->Image('../Image/adresseconservatoire_png.png',5,10,50);
    $this->Image('../Image/logo_png.png',170,6,30);
    // Police Arial gras 15
    $this->SetFont('Arial','B',14);
    // Décalage à droite
    $this->Cell(45);
    // Titre
    $this->MultiCell(110,15,$titre,1,'C',0);
    // Saut de ligne
    $this->Ln(20);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/2',0,0,'C');
}

function writeBloc($bloc)
{
    //Times 12
    $this->SetFont('Times','',11);
    //Sortie du texte justifie
    $this->MultiCell(0,5,$bloc);
    //Saut de ligne
    $this->Ln();
}

function TitrePage($titreChap)
{
    //Arial 12
    $this->SetFont('Arial','',12);
    //Couleur de fond
    $this->SetFillColor(200,220,255);
    //Titre
    $this->MultiCell(0,6, $titreChap,0,1,'C',1);
    //Saut de ligne
    $this->Ln(4);
}
}

// activation du pdf
$titre=$titre_fiche_consentement;
$pdf = new pdf();
$pdf->SetFont('Times','',11);
$pdf->AddPage();
$pdf->TitrePage($page_consentement_1);
$pdf->writeBloc($bloc_1);
$pdf->TitrePage($page_consentement_2.$racepdf);
$pdf->writeBloc($bloc_2.$racepdf);
$pdf->writeBloc($bloc_3);
foreach ($tabAsso as $value)
    $pdf->writeBloc($value[0].',');
$pdf->writeBloc($bloc_4);
mysqli_close($link);
$pdf->Output('D','Fiche consentement : '.$racepdf.'.pdf');
?>
