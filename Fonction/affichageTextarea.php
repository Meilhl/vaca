<?php
// $lib_bloc => libéllé du bloc à afficher dans 
// $texte => texte étant dans la BDD
// $rows => nombre de ligne du textarea
// $cols => nombre de colonne du textarea

function affichageTextarea($lib_bloc,$texte,$rows,$cols) 
{
    if (isset($_POST[$lib_bloc])){  //titre page 1
            $value=$_POST[$lib_bloc];
            echo "<center><textarea id='".$lib_bloc."' name='".$lib_bloc."' rows=".$rows." cols=".$cols.">".$value."</textarea></center>";
        }else{
            echo "<center><textarea id='".$lib_bloc."' name='".$lib_bloc."' rows=".$rows." cols=".$cols.">".$texte."</textarea></center>";
        }
}    
?>