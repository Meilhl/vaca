<?php
//$lib => lib du bloc à modifier
 

function modifBDD_textconv($lib){
    $link=mysqli_connect('Localhost','root','','vaca');
    mysqli_set_charset($link,"utf8mb4_general_ci");

    $modification=htmlentities($_POST[$lib],ENT_QUOTES);           
            $require="UPDATE textconvention 
            SET text='".$modification."'
            WHERE lib_bloc='".$lib."'";
            mysqli_query($link,$require)
                or die ('Impossible d\'ouvrir la BDD oiseaudb: '.mysqli_error($link));
}                
?>