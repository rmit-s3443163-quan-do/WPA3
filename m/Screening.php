<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 12:49 PM
 */
include_once('Seat.php');

class Screening {
    private $movie;
    private $time;
    private $seats;
    private $subTotal;
    private $slSeats;

    function Screening($movie, $time) {
        $this->movie = $movie;
        $this->time = $time;
        $this->seats = [];
    }

    function getTaken() {
        $taken = '';
        foreach ($this->seats as $s) {
            $taken .= $s->getSeat().',';
        }
        return $taken;
    }

    function addSlSeats($seats) {
        $this->slSeats = $seats;
    }

    function getSlSeats() {
        return $this->slSeats;
    }

    function addSeat($seat) {
        if ($seat->getQuantity()>0) {
            array_push($this->seats,$seat);
        }
    }

    function getMovieCode() {
        return substr($this->movie, 1, 2);
    }

    function getMovie() {
        return $this->movie;
    }

    function getTime() {
        return $this->time;
    }

    function getSeats() {
        return $this->seats;
    }

    function getTicketView($tid) {
        $html = '<div class="screen"><div class="panel"><div class="whole">'.
            '<div class="clear-both"><h3>'.$this->getMovie().'</h3></div>'.
            '<div class="clear-both session">Showing at '.$this->getTime().'</div>'.
            '</div></div><div class="panel"><div class="space"><div class="left">';

        foreach ($this->seats as $s) {
            $html .= $s->getSeatView1();
        }

        $html .= '<div class="clear-both dotted">Total</div></div><div class="right">';

        foreach ($this->seats as $s) {
            $html .= $s->getSeatView2();
        }


        $html .= '<div class="clear-both dotted">$'.$this->getSubTotal().'</div></div></div></div>';

        foreach ($this->seats as $s) {
            $html .= $s->getSeatViewEach($tid, $this->movie, $this->time);
        }

        return $html;

    }

    function getSubTotal() {
        $this->subTotal = 0;
        foreach ($this->seats as $s) {
            $this->subTotal += $s->getTotalPrice();
        }
        return $this->subTotal;
    }

    function view() {
        echo $this->movie.' - '.$this->time.' - '.$this->subTotal.'<br/>';
        foreach ($this->seats as $s) {
            $s->view();
        }
        echo 'SubTotal: '.$this->getSubTotal();
        echo '<br/>';
    }
}

?>