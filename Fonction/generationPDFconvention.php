<?php
/*Récupération des données dans BDD pour creer la convention*/
$link=mysqli_connect('Localhost','root','','vaca');
mysqli_set_charset($link,"utf8mb4_general_ci");
mysqli_select_db($link,'vaca') or die ("impossible d'ouvrir la BDD: ". mysqli_error($link));

$queryBDD="SELECT text 
FROM textconvention
WHERE lib_bloc='Conv_id_profil' or lib_bloc='Conv_identifiant_animal' or lib_bloc='Conv_duree'"; 
$resultBDD=mysqli_query($link, $queryBDD) or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));     
$tabBDD=mysqli_fetch_all($resultBDD); 
mysqli_free_result($resultBDD);

$id_profil=$tabBDD[0][0];
$identifiantanimal=$tabBDD[1][0];
$duree=$tabBDD[2][0];

/*Récupération des infos en lien avec le profil et l'exploitation */
$queryInfo="SELECT nom_exploit, nom, prenom, adresse, supplement_adresse, code_postal, commune FROM profil LEFT JOIN attributiondesexploitations ON profil.id_profil=attributiondesexploitations.id_profil LEFT JOIN exploitation on attributiondesexploitations.id_exploit=exploitation.id_exploit LEFT JOIN commune ON exploitation.id_commune=commune.id_commune WHERE profil.id_profil='".$id_profil."'";

$resultInfo=mysqli_query($link, $queryInfo) or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));     
$tabInfo=mysqli_fetch_all($resultInfo); 
mysqli_free_result($resultInfo);



/*Récupération de tous les identifiants*/
$ind=0;
$a=0;
$chaine="";
while($a==0){
    if (isset($identifiantanimal[$ind])){
            if ($identifiantanimal[$ind]==","){
                $listeidentifiant[]=$chaine;     
                $chaine="";
            }else{
                $chaine.=$identifiantanimal[$ind];
            }              
    }else{
        $a=1;
    }    
    $ind++;
}


/*Récupération des infos en lien avec le(s) animales */
for($k=0;$k<count($listeidentifiant);$k++){
    
    $queryAnimal="SELECT race, espece, surnom, annee_naissance, id_sexe, identifiant_animal, prix_animal, espece.id_espece FROM animal LEFT JOIN race ON animal.id_race=race.id_espece LEFT JOIN espece ON race.id_espece=espece.id_espece WHERE identifiant_animal='".$listeidentifiant[$k]."'";
    $resultAnimal=mysqli_query($link, $queryAnimal) or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));     
    $tabIntermediaire=mysqli_fetch_all($resultAnimal); 
    mysqli_free_result($resultAnimal);
    $tabAnimal[]=$tabIntermediaire;
    
}

/*Définition des variables*/
$exploitation=$tabInfo[0][0];//
$nom=$tabInfo[0][1];//
$prenom=$tabInfo[0][2];//
$adresse=$tabInfo[0][3];//
$completadresse=$tabInfo[0][4];//
$codepostal=$tabInfo[0][5];//
$commune=$tabInfo[0][6];//

$id_espece=$tabAnimal[0][0][7];
$espece=$tabAnimal[0][0][1];
$race=$tabAnimal[0][0][0];
$prix=$tabAnimal[0][0][6];
$idsexe=$tabAnimal[0][0][4];


switch($id_espece){
    case '1': // on regarde la race //bovin
        switch($tabAnimal[0][0][4]){ // et le sexe
            case 'F':
                $animal='vache';
                break;
            case 'M':
                $animal='taureau';
                break;
            case 'H':
                $animal='hongre';
                break;
        }
    break;
    case '3': //ovin
        switch($tabAnimal[0][0][4]){
            case ' F':
                $animal='brebis';
                break;
            case ' M':
                $animal='belier';
                break;
            case ' H':
                $animal='hongre';
                break;
        }
    break;        
    case '2': //equidé
        switch($idsexe){
            case 'F':
                $animal='jument';
                break;
            case 'M':
                $animal='étalon';
                break;
            case 'H':
                $animal='hongre';
                break; 
        }
    break;        
    case '4': //caprin
        switch($tabAnimal[0][0][4]){
            case 'F':
                $animal='chèvre';
                break;
            case 'M':
                $animal='bouc';
                break;
            case 'H':
                $animal='hongre';
                break;
        }
    break;   
}

/*Définition du type de convention male ou femelle*/
if ($idsexe=="F" ){
    $typeconvention=0;
}else{
    $typeconvention=1;
}   
 

/*Affectation des blocs en fonction du type de convention et des données spécifique à l'animal*/
$bloc1=iconv('UTF-8', 'windows-1252',"Entre les soussignés : 

Le Conservatoire des Races d’Aquitaine, Association Loi 1901, dont le siège social est fixé 6 rue Massena, 33700 Mérignac,
représenté par son président, Régis RIBEREAU-GAYON, 
désigné sous le terme \"le Conservatoire\"
d'une part et");


$bloc2=iconv('UTF-8', 'windows-1252',$exploitation.", représenté par ".$nom." ".$prenom." , ".$adresse.", ".$completadresse.", ".$codepostal.", ".$commune." désigné sous le terme \"l'éleveur \"
D'autre part

Considérant que :
Le Conservatoire des Races d’Aquitaine a pour objectifs la conservation, le développement et la valorisation des races locales et régionales d’animaux domestiques. L'éleveur accepte de participer et collaborer aux objectifs du Conservatoire.
La convention ne s’adresse pas exclusivement aux membres adhérents du Conservatoire des Races d’Aquitaine. La signature de la convention n’implique pas le statut de membre du Conservatoire. Toute personne pourra adhérer en effectuant une démarche auprès du Conservatoire et en s’acquittant d’une cotisation annuelle, indépendamment de la convention.

Il est convenu ce qui suit :
");

if($typeconvention==0){
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Objet de la convention :");
    $article[]=iconv('UTF-8', 'windows-1252',"Le Conservatoire des Races d’Aquitaine prête à l’éleveur un(e) ".$animal." de la race".$race." pour une durée de".$duree.". Il est convenu que les animaux font partie d'une race menacée et la présente convention a pour but de les sauvegarder et de les multiplier. L'usage des animaux se fait dans le respect des objectifs du Conservatoire des Races d'Aquitaine définis ci-dessus. L’éleveur s'engage à faire connaître la contribution du Conservatoire dans le cadre de sa communication et des informations délivrées concernant les animaux.");
}else{    
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Objet de la convention :");
    $article[]=iconv('UTF-8', 'windows-1252',"Le Conservatoire des Races d’Aquitaine prête à l'éleveur un(e)".$espece." de la race ".$race.".
    Il est convenu entre les parties que l’animal fait partie d'une race menacée et la présente convention à pour but prioritaire de les sauvegarder, en dehors de tout objectif économique. L'éleveur devra tout mettre en œuvre afin de favoriser cette conservation, dans la mesure de ses possibilités. L'usage de l’animal se fait dans le respect des objectifs du Conservatoire des Races d'Aquitaine définis ci-dessus.  
    Le prêt est consenti à titre gracieux afin de favoriser le développement de la race ".$race.".");
}

$titre_article[]=iconv('UTF-8', 'windows-1252',"Définition de l’animal :");
$partie=iconv('UTF-8', 'windows-1252',"Le conservatoire des races d'Aquitaine est propriétaire de l’animal qu'il met à disposition de l’éleveur sous son entière responsabilité. Le(s) animal concerné(s) est/sont le(s) suivant(s) : ");

foreach($tabAnimal as $unanimal){
    $partie.=iconv('UTF-8', 'windows-1252',"
    Nom : ".$unanimal[0][2]." , N° d’identification :".$unanimal[0][5]." , Année de naissance : ".$unanimal[0][3]." , Sexe ".$unanimal[0][4]);}	
       	
$partie=$partie.iconv('UTF-8', 'windows-1252',"
L’éleveur s’engage à prendre à sa charge l’élevage de l’animal et les transports aller et retour.
Il s’engage à signaler au Conservatoire toute information relative à l’animal, à sa conduite et à son état.");
$article[]=$partie;

$titre_article[]=iconv('UTF-8', 'windows-1252',"Gestion de l’animal : ");
$article[]=iconv('UTF-8', 'windows-1252',"L’animal doit être élevé dans les meilleures conditions conformément aux règles d'élevage et de bien-être des animaux; il doit être maintenu dans un état sanitaire et nutritionnel correct. La nourriture, les frais sanitaires et les soins y compris vétérinaires sont à la charge de l'éleveur. Aucune intervention ne peut être faite sur l’animal sans accord du Conservatoire des Races d’Aquitaine.
L'animal est placé sous la responsabilité entière de l'éleveur qui reconnaît l'accepter pour tous les risques. L’animal reste la propriété du Conservatoire des Races d'Aquitaine et ne peut être assimilé à un bien de l'éleveur ni être gagés ou immobilisé. L'éleveur s'obligera à informer toute personne utile de cette disposition afin que le Conservatoire n'ait aucune démarche à entreprendre pour faire valoir ses droits. L’animal sera inscrit sous le numéro de cheptel de l'éleveur. Dans le cahier d'élevage et sur les notifications de mouvements, l’éleveur doit clairement noter que l’animal est en prêt par le Conservatoire des Races d'Aquitaine. L'éleveur s'engage à signaler toute modification dans sa situation personnelle ou professionnelle susceptible de modifier ou d'influencer l'application de la présente convention. 
L’éleveur s’engage à fournir chaque année au Conservatoire, jusqu’au terme de la convention, un certificat vétérinaire attestant du bon état de santé du ou des animaux prêtés et du respect des règlements sanitaires en vigueur. Le Conservatoire des Races d’Aquitaine s’autorise à faire une visite annuelle dans l’élevage.
L’animal est prêté dans le cadre des objectifs du Conservatoire et ne pourra être déplacé du cheptel de l’éleveur, mis en prêt ou utilisé pour saillir des animaux qui n’appartiendraient pas à l’éleveur.
L’éleveur s’engage à faire part du soutien apporté par le Conservatoire des Races d’Aquitaine et à le citer lors de communication ou sur ses documents.");

if($typeconvention==0){
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Utilisation des données d’élevage : "); 
    $article[]=iconv('UTF-8', 'windows-1252',"Afin de favoriser la gestion, la promotion et le développement de la race ".$race.", le preneur autorise le Conservatoire à collecter, détenir et traiter toutes données sur la génétique, la généalogie, la zootechnie ou toutes caractéristiques de l’ensemble des animaux de race ".$race." de l’élevage du preneur. Il autorise expressément la transmission des données d’élevage le concernant au Conservatoire par tout organisme détenteur de données au titre du système national d’information génétique, à des fins de gestion, développement, études ou recherches concernant la race ".$race.".");
    
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Assurance - Disparition - Mortalité :");     
    $article[]=iconv('UTF-8', 'windows-1252',"L'éleveur prend à sa charge la responsabilité civile du fait des dommages susceptibles d'être provoqués par les animaux prêtés ou à naître que ce soit envers les biens ou les personnes. En aucun cas la responsabilité du Conservatoire ne pourra être recherchée pour quelques problèmes que ce soit provoqués par les animaux placés y compris en cas de déplacement ou de participation à des événements de toute nature. En cas de disparition d'un animal prêté (mort, vol…), il sera nécessairement remplacé par un produits né sur place que le Conservatoire récupérera au terme de la convention. La durée de la convention pourra être modifiée pour tenir compte de ce changement.  
Les frais d’équarrissage seront à la charge du preneur.
");

    $titre_article[]=iconv('UTF-8', 'windows-1252',"Prise d’effet et durée : ");
    $article[]=iconv('UTF-8', 'windows-1252',"La présente convention prend effet à compter de l'arrivée des animaux attestée par le bon de livraison signé par le preneur ou son représentant. Elle est conclue pour une durée de ".$duree.". A l'issue de cette période, la convention peut être reconduite par les parties");
    
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Dénonciation : ");
    $article[]=iconv('UTF-8', 'windows-1252',"La convention pourra être dénoncée avant son terme sur demande du preneur. Le Conservatoire récupérera de droit les animaux prêtés et les produits nés en cours de convention jusqu'à concurrence du nombre lui revenant normalement au terme de la convention.  La convention pourra également être dénoncée par accord entre les parties selon des modalités qu'ils détermineront conjointement.");
    
}else{
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Assurance – Mortalité : ");     
    $article[]=iconv('UTF-8', 'windows-1252',"L'éleveur sera assuré en responsabilité civile du fait des dommages provoqués par l’animal que ce soit envers les biens ou les personnes. En aucun cas la responsabilité du Conservatoire ne pourra être recherchée pour quelque problème que ce soit provoqué par l’animal placé sous la responsabilité de l'éleveur y compris lors de déplacement ou de participation à des évènements de toute nature.   
    En cas de mort pendant la période de prêt sur l'exploitation, lors des transports, déplacements ou toute autre manipulation, l'éleveur s'engage à rembourser l'animal sur la base de sa valeur de reproducteur qui est évaluée à".$prix." € ou, avec l'accord du Conservatoire, à remettre un animal de valeur équivalente. Les frais d’équarrissage seront pris en charge par l’éleveur.");
    
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Prise d’effet et durée : ");
    $article[]=iconv('UTF-8', 'windows-1252',"La présente convention prend effet à compter de l’arrivée de l’animal. Elle est conclue pour une durée de ".$duree.".");
    
    $titre_article[]=iconv('UTF-8', 'windows-1252',"Dénonciation : ");
    $article[]=iconv('UTF-8', 'windows-1252',"La convention pourra être dénoncée avant son terme uniquement en l’accord des deux parties qui détermineront conjointement les modalités de résiliation. Quel que soit le motif de résiliation, l'éleveur s'engage à restituer au Conservatoire l'animal prêté et à le faire transporter vers le lieu indiqué par le Conservatoire.");
}    
if ($typeconvention==0){$delai='6 mois';}else{$delai='3 mois';}

$titre_article[]=iconv('UTF-8', 'windows-1252',"Clause résolutoire : ");
$article[]=iconv('UTF-8', 'windows-1252',"En cas de manquement de l’une ou l’autre des parties aux conditions fixées à la présente convention, chacune des parties pourra y mettre fin sans indemnité d’aucune sorte un mois après mise en demeure d’avoir à y remédier restée sans effets. Cependant, il ne peut être exigé du Conservatoire de reprendre l’animal tant qu'un hébergement de substitution n'aura pas était trouvé dans un délai maximal de ".$delai.".");

$titre_article[]=iconv('UTF-8', 'windows-1252',"Cas de force majeure : "); 
$article[]=iconv('UTF-8', 'windows-1252',"En cas d'événement relevant de la force majeure et rendant inapplicable la présente convention, les parties se rapprocheront dans un esprit d’amiable conciliation afin de déterminer les conditions nécessaires à la poursuite ou la résiliation de la convention.
");

$Signature=iconv('UTF-8', 'windows-1252',"Fait le ....../....../......  à .................. 

M./Mme......................................................



 
");

   
/*Appel librairie fpdf*/
require("../Library/fpdf/fpdf.php");


/*Definition des fonctions pour générer le pdf*/
class PDF extends FPDF
{

// En-tête
function Header()
{
    global $titre, $espece, $exploitation, $nom, $prenom, $adresse, $completadresse, $codepostal, $commune, $animal, $nomanimal, $identifiantanimal, $anneenaissance, $idsexe, $prix, $duree;
    // Logo
    $this->Image('../Image/adresseconservatoire_png.png',5,15,50);
    $this->Ln(5);
    $this->Cell(70);
    $this->SetFont('Times','',11);
    $this->Cell(45,10,iconv('UTF-8', 'windows-1252','Convention prêt de '.$animal),0,0,'C');
    $this->Image('../Image/logo_png.png',170,6,30);
    // Police Arial gras 15
    // Décalage à droite
    $this->Ln(15);
}

// Pied de page
function Footer()
{
    // Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    // Police Arial italique 8
    $this->SetFont('Arial','I',8);
    // Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/3',0,0,'C');
}

function writeBloc($bloc)
{
    //Times 12
    $this->SetFont('Times','',11);
    //Sortie du texte justifie
    $this->MultiCell(0,5,$bloc);
    //Saut de ligne
    $this->Ln(10);
}

function TitreArticle($num,$titreArticle)
{
    //Arial 12
    $this->SetFont('Arial','B',12);
    //Couleur de fond
    $this->SetFillColor(200,220,255);
    //Titre
    $this->MultiCell(0,6,"Article ".$num." : ".$titreArticle,0,1,'C',1);
    //Saut de ligne
    $this->Ln(5);
}
}
 
// activation du pdf
$titre="CONVENTION DE MISE A DISPOSITION D'ANIMAUX DE RACES REGIONALES EN CONSERVATION";

$pdf = new pdf();
$pdf->SetFont('Times','',11);
$pdf->AddPage();

$pdf->Cell(20);
$pdf->SetFont('Arial','B',14);
// Titre
$pdf->MultiCell(150,7,$titre,1,'C',0);
// Saut de ligne
$pdf->Ln(10);
$pdf->writeBloc($bloc1);
$pdf->writeBloc($bloc2);

for($i=1;$i<=count($article);$i++){
    $pdf->TitreArticle($i,$titre_article[$i-1]);
    $pdf->writeBloc($article[$i-1]);}

$pdf->MultiCell(0,5,iconv('UTF-8', 'windows-1252',"Régis RIBEREAU-GAYON - Président du Conservatoire des Races d'Aquitaine
"));
$pdf->Ln(20);
$pdf->MultiCell(0,5,$Signature);
$pdf->SetFont('Times','',9);
$pdf->MultiCell(0,5,iconv('UTF-8', 'windows-1252',"Signature précédée de la mention « lu et approuvé »"));
$pdf->Output('D','Convention: '.$race.'.pdf');
?>