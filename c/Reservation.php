<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 5/05/15
 * Time: 11:11 PM
 */

require_once('m/SeatMap.php');
require_once('m/Seat.php');

class Reservation {

    public static function setTaken($res) {
        $rows = [
            ['A','-----a--a-----'],
            ['B','----a--a-a----'],
            ['C','---a-a--a-a---'],
            ['D','aaaaaaaaaaaaaa'],
            ['E','aaaaaaaaaaaaaa'],
            ['F','aaaaaaaaaaaaaa'],
            ['G','aaaaa----aaaaa']
        ];

        foreach ($res as $s) {
            if ($s != '' && strlen($s)>1) {
                $x = Reservation::getXY($s);
                $seat = (int)substr($x, 1, strlen($x));
                $count = 0;
                foreach ($rows as $r) {
                    if ($r[0] == $x[0]) {
                        $rows[$count][1][$seat] = 'r';
                    }
                    $count++;
                }
            }
        }
//        echo '<pre>';
//        print_r($res);
//        echo '</pre>';

        return $rows;
    }

    public static function getXY($seat) {
//        echo $seat . ' ';
        switch ($seat) {
            case 'A1':
                return 'A5';
                break;
            case 'A2':
                return 'A8';
                break;
            case 'B1':
                return 'B4';
                break;
            case 'B2':
                return 'B7';
                break;
            case 'B3':
                return 'B9';
                break;
            case 'C1':
                return 'C3';
                break;
            case 'C2':
                return 'C5';
                break;
            case 'C3':
                return 'C8';
                break;
            case 'C4':
                return 'C10';
                break;
        }

        $x = $seat[0];
        if ($x=='G') {
            $y = (int)substr($seat,1,strlen($seat));
            if ($y>5)
                $y += 3;
            else
                $y -= 1;
        } else
            $y = (int)substr($seat,1,strlen($seat))-1;
        return $x.$y;
    }

    public static function getContent($movie, $session) {
        $maps = Reservation::readMaps();

        $html = '<div id="st-screen">SCREEN</div>';

        $reserved = [];
        foreach ($maps as $map) {
            if ($map->compare($movie, $session))
                $reserved = $map->getTaken();
        }

        $rows = Reservation::setTaken($reserved);

        foreach ($rows as $r) {

            $html .= '<div class="row center">'.
                '<div class="seat cell rowno">'.$r[0].'</div>';
            $count = 0;
            for ($i=0; $i<14; $i++) {
                $id = '';
                switch ($r[1][$i]) {
                    case 'a':
                        $style = 'avail';
                        $count++;
                        $id = ' id="'.$r[0].$count.'"';
                        break;
                    case 'r':
                        $style = 'na reserved';
                        $count++;
                        $id = ' id="'.$r[0].$count.'"';
                        break;
                    default:
                        $style = 'hidden';
                        break;
                }
                $cate = Seat::getType($r[0].$count);
                if ($count<10)
                    $count = '0'.$count;
                $style .= ' '.$cate;
                $html .= '<div'.$id.' class="seat cell '.$style.'">'.$count.'</div>';
            }
            $html .= '</div>';

        }

        $html .= '<div id="st-desc">'.
            '<div class="default-cur seat cell avail"></div>'.
            '<div class="seat-desc seat-desc-left">Seat Available</div>' .
            '<div class="default-cur seat cell na info"></div>'.
            '<div class="seat-desc">Seat Unavailable</div>' .
            '</div>';

        $html .= '<div id="st-select-seat">'.
            '<div class="label">Please select</div>'.
            '<div id="remaining-seats" class="seats-selected">'.
            '</div></div>';

        return $html;

    }

    public static function addMap($movie, $session, $taken) {
        $maps = Reservation::readMaps();

        foreach ($maps as $map) {
            if ($map->compare($movie, $session)) {
                $map->addTaken($taken);
                Reservation::writeMaps($maps);
                return;
            }
        }
        $map = new SeatMap($movie, $session);
        $map->addTaken($taken);

        array_push($maps, $map);
        Reservation::writeMaps($maps);
    }

    public static function readMaps() {
        $filePath = './m/ReservationDB.php';

        if (file_exists($filePath)){
            $objData = file_get_contents($filePath);
            $obj = unserialize($objData);
            if (!empty($obj)){
                return $obj;
            } else
                return [];
        } else {
            return null;
        }
    }

    public static function writeMaps($map)
    {
        $objData = serialize($map);
        $filePath = './m/ReservationDB.php';
        if (is_writable($filePath)) {
            $fp = fopen($filePath, "w");
            fwrite($fp, $objData);
            fclose($fp);
        }
    }

} 