<?php

    require_once('c/Reservation.php');

    Reservation::addMap('init','init','A200');
    echo '<pre>';

    print_r(Reservation::readMaps());

    echo '</pre>';
?>