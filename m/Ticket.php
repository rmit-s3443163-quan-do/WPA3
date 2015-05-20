<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 3/05/15
 * Time: 9:55 PM
 */


include_once('Cart.php');

class Ticket {
    private $id;
    private $name;
    private $email;
    private $phone;
    private $cart;

    function Ticket($id, $name, $email, $phone, $cart) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->cart = $cart;
    }

    public function getID() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getCart() {
        return $this->cart;
    }


    public function getEmail() {
        return $this->email;
    }

    public function view() {
        echo '<br/>['.$this->id.'] '.$this->name.' - '.$this->email.' - '.$this->phone.'<br/><pre>';
        $this->cart->view();
        echo '</pre>';
    }
} 