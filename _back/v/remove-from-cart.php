<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 3:27 PM
 */

    include_once('m/Cart.php');
    if (isset($_SESSION['cart'])) {
        $cart = unserialize($_SESSION['cart']);

        $cart->removeScreening($_GET['id'],$_GET['time']);

        if ($cart->getSize()==0)
            session_unset();
        else
            $_SESSION['cart'] = serialize($cart);
    }
?>