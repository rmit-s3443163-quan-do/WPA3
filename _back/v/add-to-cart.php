<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 1:24 PM
 */

    include_once('m/Session.php');
    include_once('m/Screening.php');
    include_once('m/Cart.php');
    include_once('m/Seat.php');

    $scr = new Screening($_POST['title'],$_POST['session']);

    $sess = $_POST['seats'];

    $quan = (int)$_POST['SA'];
    $seat = Seat::getSeatFromString('SA',$quan,$sess);
    $scr->addSeat(new Seat('SA',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['SP'];
    $seat = Seat::getSeatFromString('SP',$quan,$sess);
    $scr->addSeat(new Seat('SP',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['SC'];
    $seat = Seat::getSeatFromString('SC',$quan,$sess);
    $scr->addSeat(new Seat('SC',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['FA'];
    $seat = Seat::getSeatFromString('FA',$quan,$sess);
    $scr->addSeat(new Seat('FA',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['FC'];
    $seat = Seat::getSeatFromString('FC',$quan,$sess);
    $scr->addSeat(new Seat('FC',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['B1'];
    $seat = Seat::getSeatFromString('B1',$quan,$sess);
    $scr->addSeat(new Seat('B1',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['B2'];
    $seat = Seat::getSeatFromString('B2',$quan,$sess);
    $scr->addSeat(new Seat('B2',$quan,$seat,$_POST['session']));

    $sess = Seat::removeSeatsFromString($seat, $sess);
    $quan = (int)$_POST['B3'];
    $seat = Seat::getSeatFromString('B3',$quan,$sess);
    $scr->addSeat(new Seat('B3',$quan,$seat,$_POST['session']));

    if (isset($_SESSION['cart'])) {
        $cart = unserialize($_SESSION['cart']);
    } else {
        $cart = new Cart();
    }

    $scr->addSlSeats(substr($_POST['seats'],1,strlen($_POST['seats'])));

    $cart->addScreening($scr);
    $_SESSION['cart'] = serialize($cart);

?>

<script type="application/javascript">window.location.href = 'index.php?p=cart';</script>