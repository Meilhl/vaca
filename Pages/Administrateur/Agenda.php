<?php
    //ouverture de session
    session_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="../../Style/Style.css" media="all" />
    <link rel="stylesheet" type="text/css" href="../../Style/Agenda.css" media="all" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Script pour recharger le calendrier -->
    <script type="text/javascript">
    	function afficherCalendrier(str){
            //alert(document.Calendrier_form.datefin.value);

    		$.ajax({

    			type: 'get',
    			dataType: 'html',
    			url: '../../Fonction/creationAgenda.php', // Si on fait une erreur dans le nom du fichier php, la requête échoue.
    			timeout: 1000, //délai (en ms) pour que la requête soit exécutée. Si ce délai est dépassé, on exécute la fonction spécifiée dans le paramètre "error".
    			data: {
    				ind :str
    				},
    			success: function (response) {
    				document.getElementById("ZoneCalendrier").innerHTML=response;
    			},
    			error: function () {
    				alert('La requête a échouée');
    			}
    		});
    	}
    </script>
    <title>
		Agenda
	 </title>
</head>
<body onload="afficherCalendrier(0)">
    <div class= "header">
    <?php
    $role=1;
    require("../../Style/Entete.php");
    affiche_entete($role); ?>
    <br>
    </div>

    <div class="corps" style="background-color: rgba(159,185,153,0);">
      <div class = "border" style="height:auto;margin:0px;">
        <center><span id='ZoneCalendrier'></span></center>
          <?php if (isset($_SESSION["datecache"])){unset($_SESSION["datecache"]);}
        ?>
        <h3 style="margin-left:20px;font-size:1.3em;">Rechercher une convention : <a style='font-size:1.3em;text-decoration:none' href='Historique_convention.php'>🔎</a></h3>
        </div>
    </div>
  </div>

    <div class="footer">
    <?php include("../../Style/Pied.html"); ?>
    </div>
</body>
</hmtl>
