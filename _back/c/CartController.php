<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 2:49 PM
 */

include_once('./m/Cart.php');
include_once('./m/Seat.php');
include_once('./m/Screening.php');

class CartController {

    public static function getScreenings($cart) {
        $html = '';

        $server = 'jupiter.csit.rmit.edu.au';
        if (isset($_SERVER['SERVER_NAME'])) {
            if ($_SERVER['SERVER_NAME'] != 'localhost')
                $server = $_SERVER['SERVER_NAME'];
        }


        foreach ($cart->getScreenings() as $scr) {
            $html .= '<div class="cart-movie"><div class="movie-left"><img src="http://'.$server.'/~e54061/wp/movie-service/' . $scr->getMovieCode() . '.jpg"></div>' .
                '<div class="movie-right"><div class="movie-title">' . $scr->getMovie() . '</div>'.
                '<div class="movie-session">Showing at ' . $scr->getTime() . '</div>' .
                '<table class="movie-table"><tr><th>Ticket Type</th><th>Cost</th><th>Qty</th><th>Seats</th><th>Subtotal</th></tr>';

            $count = 0;
            foreach ($scr->getSeats() as $seat) {
                if ($count%2==1)
                    $odd = ' class="odd"';
                else $odd = '';

                $html .= '<tr'.$odd.'><td>'.$seat->getTyp().'</td><td>$'.$seat->getPrice().'</td><td>'.$seat->getQuantity().'</td><td>'.$seat->getSeat().'</td><td>$'.$seat->getTotalPrice().'</td></tr>';
                $count++;
            }

            $html.= '<tr><td colspan="4" align="right">Sub Total:</td><td><b>$'.$scr->getSubTotal().'</b></td></tr></table>'.
                '<div id="rm'.$scr->getMovieCode().'-'.$scr->getTime().'" class="movie-remove">Remove from cart</div></div></div>';

        }

        return $html;
    }
} 