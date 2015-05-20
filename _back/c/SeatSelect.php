<?php
/**
 * Created by PhpStorm.
 * User: JayDz
 * Date: 4/05/15
 * Time: 1:56 AM
 */
    require_once('./m/SeatMap.php');
    require_once('./m/Seat.php');

    class SeatSelect {

        public static function setCell($row, $cell, $data) {
            $map = SeatSelect::readMap();

            $map->getRow($row)->setCell($cell, $data);

            SeatSelect::writeMap($map);
        }

        public static function getContent() {
            $map = SeatSelect::readMap();

            $html = '<div id="st-screen">SCREEN</div>';


            foreach ($map->getRows() as $row) {

                $html .= '<div class="row center">'.
                    '<div class="seat cell rowno">'.$row->getRow().'</div>';
                $count = 0;
                for ($i=0; $i<14; $i++) {
                    $id = '';
                    switch ($row->getCell($i)) {
                        case 'a':
                            $style = 'avail';
                            $count++;
                            $id = ' id="'.$row->getRow().$count.'"';
                            break;
                        case 'r':
                            $style = 'na reserved';
                            $count++;
                            $id = ' id="'.$row->getRow().$count.'"';
                            break;
                        default:
                            $style = 'hidden';
                            break;
                    }
                    $cate = Seat::getType($row->getRow().$count);
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

        public static function readMap() {
            $filePath = './m/SeatMapDB.php';

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

        public static function writeMap($map)
        {

            $objData = serialize($map);
            $filePath = './m/SeatMapDB.php';
            if (is_writable($filePath)) {
                $fp = fopen($filePath, "w");
                fwrite($fp, $objData);
                fclose($fp);
            }
        }
    }
?>