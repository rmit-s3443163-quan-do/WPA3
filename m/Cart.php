<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 1:13 PM
 */

include_once('Screening.php');

class Cart {
    private $screenings;
    private $grandTotal;
    private $voucher='';
    private $superTotal;

    function Cart() {
        $this->screenings = [];
    }

    function calcTotal() {
        $this->grandTotal=0;
        foreach ($this->screenings as $s) {
            $this->grandTotal += $s->getSubTotal();
        }

        $this->superTotal = $this->grandTotal*(1-$this->checkVoucher());
    }

    function hasVoucher() {
        if ($this->voucher == '')
            return false;
        else
            return true;
    }

    function getVoucher() {
        if ($this->voucher == '')
            return 'Not Applied';
        else
            return $this->voucher;
    }

    function getVoucherOff() {
        if ($this->voucher == '')
            return '&nbsp;';
        else
            return '20% OFF';
    }

    function addVoucher($s) {

        $this->voucher = $s;
    }

    function checkVoucher() {
        if (strcmp($this->voucher,'')==0)
            return 0;
        else
            return 0.2;
    }

    function getSuperTotal() {
        $this->calcTotal();

        return number_format($this->superTotal,2);
    }

    function getGrandTotal() {
        $this->calcTotal();

        return number_format($this->grandTotal,2);
    }

    function addScreening($scr) {
        foreach ($this->screenings as $s) {
            if(strcmp($s->getMovieCode(),$scr->getMovieCode())==0 &&
                strcmp($s->getTime(),$scr->getTime())==0) {
                return false;
            }
        }
        array_push($this->screenings, $scr);
    }

    function removeScreening($scr, $time) {
        foreach ($this->screenings as $s) {
            if(strcmp($s->getMovieCode(),$scr)==0 && strcmp($s->getTime(),$time)==0) {
                $key = array_search($s, $this->screenings);
                unset($this->screenings[$key]);
            }
        }

    }

    function getScreenings() {
        return $this->screenings;
    }

    function getSize() {
        return count($this->screenings);
    }

    function view() {
        foreach ($this->screenings as $s) {
            echo $s->view();
        }
        echo 'Total: '.$this->getGrandTotal().'<br/>';
        echo 'Voucher: '.($this->checkVoucher() * 100).'<br/>';
        echo 'Grand-total: '.$this->getSuperTotal().'<br/>';
    }

}
?>