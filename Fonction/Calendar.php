<?php
setlocale (LC_TIME, 'fr_FR.utf8','fra');


class Calendar {
    private $active_year, $active_month, $active_day;
    private $events = [];
    public $agenda;

    function set_agenda($agenda){
    $this->agenda = $agenda;
    }
    /*Récupération de la date*/
    public function __construct($date = null) {
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    /*Ajout d'un événement à une date*/
    public function add_event($txt, $date, $days = 1, $color = '') {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    /*Affichage du calendrier*/
    public function __toString() {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));

        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));

        $jour = [1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi', 7 => 'Dimanche'];

        //$days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $days = [6 => 'Sun', 0 => 'Mon', 1 => 'Tue', 2 => 'Wed', 3 => 'Thu', 4 => 'Fri', 5 => 'Sat'];

        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);

        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        if($this->agenda==TRUE){
          $html .= "<input type='button' style='border:0px' name='boutonzero' value='↩️' onclick='afficherCalendrier(0)'><br>";
          $html .= "<input type='button' style='border:0px' name='bouton-' value='⏪' onclick='afficherCalendrier(-1)'><span style='width : 30%;font-size:1em'>";
        }
        $html .= utf8_encode(strftime('%B %Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day)));
        if($this->agenda==TRUE){
          $html .= "</span><input type='button' style='border:0px' name='bouton-' value='⏩' onclick='afficherCalendrier(+1)'>";
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';


        foreach ($jour as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        /*Affiche jour du mois précédent*/
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        /*Affichage des jours du mois en cours*/
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if (($i == $this->active_day) and (date('m')==$this->active_month) and (date('Y')==$this->active_year)){

                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';
            /*Ajout des évènements*/
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        /*Ajout des jours du mois d'après*/
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }


        return $html;
    }
}
?>