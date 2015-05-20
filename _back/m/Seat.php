<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 2/05/15
 * Time: 12:42 PM
 */

    class Seat {
        private $type;
        private $quantity;
        private $seat;
        private $price;

        function Seat($type, $quant, $seat, $time) {
            $this->type = $type;
            $this->quantity = $quant;
            $this->seat = $seat;
            $this->price = $this->getPr($time);
        }

        function getSeatViewEach($tid,$movie,$session) {
            $html = '';
            $arr = explode(',',$this->seat);
            foreach ($arr as $a) {
                $html .= '<div class="panel ticket"><div class="left">'.
                    '<div class="clear-both">['.$tid.'] Silverado Cinema</div>'.
                    '<div class="clear-both dotted">01 x '.$this->getTypeFull().'</div>'.
                    '<div class="clear-both"><b>'.$movie.'</b></div></div><div class="right">'.
                    ' <div class="clear-both">ADMIT ONE</div>'.
                    '<div class="clear-both dotted light-coral">Seat '.$a.'</div>'.
                    '<div class="clear-both">'.$session.'</div></div></div>';
            }

            return $html;
        }

        function getSeatView1() {

            return '<div class="clear-both">'.$this->quantity.' x '.$this->getTypeFull().'</div>';

        }

        function getSeatView2() {
            return '<div class="clear-both">$'.$this->getPrice().'</div>';
        }

        function getTypeFull() {
            switch ($this->type) {
                case 'SA':
                    return 'Standard Adult';
                    break;
                case 'SP':
                    return 'Standard Concession';
                    break;
                case 'SC':
                    return 'Standard Child';
                    break;
                case 'FA':
                    return 'First Class Adult';
                    break;
                case 'FC':
                    return 'First Class Adult';
                    break;
                case 'B1':
                    return 'Bean bag for 1';
                    break;
                case 'B2':
                    return 'Bean bag for 2';
                    break;
                case 'B3':
                    return 'Bean bag for 3';
                    break;
            }
        }


        function getPric($id, $session) {
            $p1 = [12, 10, 8, 25, 20, 20, 20, 20];
            $p2 = [18, 15, 12, 30, 25, 30, 30, 30];
            $day = explode(' ',$session)[0];
            $time = explode(' ',$session)[1];
            switch ($day) {
                case 'Wednesday':
                    if (strcmp($time,'1pm')==0)
                        return $p1[$id];
                    else
                        return $p2[$id];
                break;
                    case 'Thursday':
                    case 'Friday':
                    case 'Saturday':
                    case 'Sunday':
                        return $p2[$id];
                break;
                    default:
                        return $p1[$id];
                break;
            }
        }

        function getPr($time) {
            switch ($this->type) {
                case 'SA':
                    return $this->getPric(0,$time);
                case 'SP':
                    return $this->getPric(1,$time);
                case 'SC':
                    return $this->getPric(2,$time);
                case 'FA':
                    return $this->getPric(3,$time);
                case 'FC':
                    return $this->getPric(4,$time);
                case 'B1':
                    return $this->getPric(5,$time);
                case 'B2':
                    return $this->getPric(6,$time);
                case 'B3':
                    return $this->getPric(7,$time);
            }
            return 10;
        }

        function getTyp() {
            return $this->type;
        }

        public static function getType($code) {
            switch ($code[0]) {
                case 'A':
                case 'B':
                case 'C':
                    return 'b';
                case 'G':
                    return 's';
                default:
                    $num = substr($code,1,strlen($code)-1);
                    if ($num > 5 && $num < 10)
                        return 'f';
                    else
                        return 's';
                    break;
            }
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function getSeat() {
            return $this->seat;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getTotalPrice() {
            return $this->price * $this->quantity;
        }

        public function view() {
            echo $this->quantity.' x ['.$this->type.'] = '.$this->getTotalPrice().
                ' '.$this->seat.
                '<br/>';
        }

        public function getCate() {
            echo $this->type;
            if ($this->type == 'SA' || $this->type == 'SP' || $this->type == 'SC')
                return 's';
            else if ($this->type == 'FA' || $this->type == 'FC')
                return 'f';
            else
                return 'b';
        }

        public static function isSeatType($type, $seat) {
            $row = $seat[0];
            $no = (int)substr($seat, 1, strlen($seat));
            switch ($type) {
                case 'SA':
                case 'SP':
                case 'SC':
                    if ($row == 'A' || $row == 'B' || $row == 'C')
                        return false;
                    else if ($no > 5 && $no < 10 && $row != 'G')
                        return false;
                    else
                        return true;
                    break;
                case 'FA':
                case 'FC':
                if ($row == 'A' || $row == 'B' || $row == 'C')
                    return false;
                else if ($no < 6 && $no > 9 )
                    return false;
                else
                    return true;
                break;
                default:
                    if ($row != 'A' && $row != 'B' && $row != 'C')
                        return false;
                    else
                        return true;
                    break;
            }
        }

        public static function getSeatFromString($type, $quant, $s) {
            $arr = explode(',',$s);
            $seat = '';
            $count = 0;
            foreach ($arr as $a) {
                if ($count == $quant)
                    break;
                if (strlen($a)>0) {
                    if (Seat::isSeatType($type, $a)) {
                        $count++;
                        $seat .= ','.$a;
                    }
                }
            }
            $seat = substr($seat,1,strlen($seat));
            return $seat;
        }

        public static function removeSeatsFromString($seats, $str) {
            foreach (explode(',',$seats) as $s) {
                $str = str_replace($s,'',$str);
            }
            $str = str_replace(',,',',',$str);
            if (!empty($str))
                if ($str[0]==',')
                    $str = substr($str, 1, strlen($str));
            return $str;
        }

    }

?>