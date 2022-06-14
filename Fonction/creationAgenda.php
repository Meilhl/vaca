<?php
    include 'Calendar.php';
    include 'datesConvention.php';
    session_start();
    $ind=$_GET["ind"];
    if (isset($_SESSION["datecache"])){$date=$_SESSION["datecache"];}
    else{$date=date('Y-m-d');}

    switch($ind){
        case -1:
                    $date=date('Y-m-d', strtotime("-1 month",strtotime($date)));
                    break;
        case 1:
                    $date=date('Y-m-d', strtotime("+1 month",strtotime($date)));
                    break;
        case 0:
                    $date=date('Y-m-d');
                    break;
    }
    $_SESSION["datecache"]=$date;

    $calendar=new Calendar($date);
    $calendar->set_agenda(TRUE);
    datesConvention($calendar,$date);

    echo "<div class='content home'>".$calendar."</div>";
?>
