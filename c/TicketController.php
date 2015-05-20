<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 3/05/15
 * Time: 10:13 PM
 */

require_once('m/Ticket.php');
require_once('c/Reservation.php');

class TicketController {

    public static function findTicket($id, $email) {

        $tickets = TicketController::readTickets();
        if ($tickets != null) {
            foreach ($tickets as $t) {
                if (strcmp($t->getID(),$id)==0 && strcmp($t->getEmail(),$email)==0) {

                    $html = '<div class="panel"><div class="left">'.
                        '<div class="clear-both">'.$t->getName().'</div>'.
                        '<div class="clear-both">'.$t->getEmail().'</div>'.
                        '<div class="clear-both">'.$t->getPhone().'</div></div>'.
                        '<div class="right"><div class="clear-both">&nbsp;</div><div class="clear-both">Silverado Cinema</div>'.
                        '<div class="clear-both">Reservation '.$t->getID().'</div>'.
                        '</div></div>';

                    foreach ($t->getCart()->getScreenings() as $scr) {
                        $html .= $scr->getTicketView($t->getID());
                    }

                    $vou = '20% Off';

                    $html .= '<div class="panel"><div class="left"><div class="clear-both">Total</div>'.
                        '<div class="clear-both">Voucher ('.$t->getCart()->getVoucher().')</div>'.
                        '<div class="clear-both dotted">Grand Total</div></div>'.
                        '<div class="right"><div class="clear-both">$'.$t->getCart()->getGrandTotal().'</div>'.
                        '<div class="clear-both">'.$t->getCart()->getVoucherOff().'</div>'.
                        '<div class="clear-both dotted grand-total">$'.$t->getCart()->getSuperTotal().'</div></div></div>';

                    return $html;

                }
            }
            return 'null';
        } else {
            return 'null';
        }
    }

    public static function addTicket($name, $phone, $email, $cart) {

        $tickets = TicketController::readTickets();

        if ($tickets==null) {
            $tickets = [];
        }
        do {
            $id = rand(0,99999);
        } while (TicketController::checkID($id));

        $sid = ''.$id;

        while (strlen($sid)<5)
            $sid = '0'.$sid;

        $t = new Ticket($sid, $name, $email, $phone, $cart);
        array_push($tickets, $t);

        foreach ($t->getCart()->getScreenings() as $scr) {
            Reservation::addMap($scr->getMovie(), $scr->getTime(), $scr->getTaken());
        }

        TicketController::writeTickets($tickets);

        return 'ticket.php?code='.$sid . '&email=' . $email;
    }

    static function checkID($id) {
        $tickets = TicketController::readTickets();

        if ($tickets==null)
            return false;

        foreach ($tickets as $t) {
            if ($t->getID() == $id) {
                return true;
            }
        }

        return false;
    }

    public static function readTickets() {
        $filePath = './m/TicketDB.php';

        if (file_exists($filePath)){
            $objData = file_get_contents($filePath);
            $obj = unserialize($objData);
            if (!empty($obj)){
                return $obj;
            }
        } else {
            return null;
        }
    }

    static function writeTickets($tickets) {
        $objData = serialize($tickets);
        $filePath = './m/TicketDB.php';
        if (is_writable($filePath)) {
            $fp = fopen($filePath, "w");
            fwrite($fp, $objData);
            fclose($fp);
        }
    }
}
?>