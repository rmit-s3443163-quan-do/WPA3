<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 4:23 PM
 */


    include_once('m/Cart.php');

    $v = explode('-',$_POST['v']);
    $cls = 'err';

    if (strcmp(getSum($v[0]).getSum($v[1]),$v[2])==0) {
        if (isset($_SESSION['cart'])) {
            $cart = unserialize($_SESSION['cart']);
            $cart->addVoucher($_POST['v']);
            $cls = 'ok';
            $_SESSION['cart'] = serialize($cart);
        }
    }

    function getSum($s) {
        $c1 = (int) $s[0];
        $c2 = (int) $s[1];
        $c3 = (int) $s[2];
        $c4 = (int) $s[3];
        $c5 = (int) $s[4];

        $sum = (($c1*$c2+$c3)*$c4+$c5)%26;
        $c = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return $c[$sum];
    }

?>
