<?php


foreach($objects as $key => $item){
    $num_obj = $key+1;
    $bill_object = $item;

    include '01_honorar.php';
    include '02_leistungen.php';
    include '03_besonderleistungen.php';
}

include '04_zusatzlicheLeistungen.php';
include '05_nebenkosten.php';


?>