<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 4/05/15
 * Time: 2:06 AM
 */

class SeatMap {

    private $movie;
    private $session;
    private $taken;

    function SeatMap($movie, $session) {
        $this->movie = $movie;
        $this->session = $session;
        $this->taken = [];
    }

    function compare($movie, $session) {
        if ($this->movie == $movie && $this->session == $session)
            return true;
        else
            return false;
    }

    function getMovie() {
        return $this->movie;
    }

    function getSession() {
        return $this->session;
    }

    function isTaken($seat) {
        if (in_array($seat, $this->taken))
            return 'reserved';
        else
            return 'avail';
    }

    function addTaken($taken) {
        $seats = explode(',',$taken);
        foreach ($seats as $s) {
            if (!in_array($s,$this->taken))
                array_push($this->taken, $s);
        }
    }

    function getTaken(){
        return $this->taken;
    }

    function view() {
        foreach ($this->taken as $seat) {
            echo $seat;
        }
    }
} 