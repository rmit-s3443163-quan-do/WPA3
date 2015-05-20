<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 1:05 PM
 */

class Session {

    function Session() {

    }

    public static function getName() {
        return $_SESSION['name'];
    }

    public static function getEmail() {
        return $_SESSION['email'];
    }

    public static function getPhone() {
        return $_SESSION['phone'];
    }

    public static function getCart() {
        return $_SESSION['cart'];
    }

    public static function setName($s) {
        $_SESSION['name'] = $s;
    }

    public static function setEmail($s) {
        $_SESSION['email'] = $s;
    }

    public static function setPhone($s) {
        $_SESSION['phone'] = $s;
    }

    public static function setCart($s) {
        $_SESSION['cart'] = $s;
    }


}

?>