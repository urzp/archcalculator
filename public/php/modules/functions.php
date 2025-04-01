<?php

function int2roman($n) {
    $M = ["","M","MM","MMM"];
    $C = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM"];
    $X = ["","X","XX","XXX","XL","L","LX","LXX","LXXX","XC"];
    $I = ["","I","II","III","IV","V","VI","VII","VIII","IX"];

    return sprintf('%s%s%s%s', $M[$n/1000],$C[($n % 1000)/100],$X[($n % 100)/10],$I[($n % 10)]);
}

function number_to_leter($str){
    $alpha = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
    $newName = '';
    do {
        $str--;
        $limit = floor($str / 26);
        $reminder = $str % 26;
        $newName = $alpha[$reminder].$newName;
        $str=$limit;
    } while ($str >0);
    return $newName;
}



function newOrder($newOrderData, $tableName, $selector){
    $newOrderData = crud_read($tableName,"*", $selector);
    foreach($newOrderData as $index=>$item){
        foreach ($item as $key => $value){
            if($key!='id'){
                $update_data[$key] = $value;
            }else{
                $selector = "`id` = '$value'";
            }
            $update_data['number']=$index;
        }
        crud_update($tableName, $update_data, $selector);
    }
}

function fixJsonUTF8($data){
    return iconv('UTF-8', 'UTF-8//IGNORE', utf8_encode($data) );
}

function generatePinCode($chars) {
    $pin = "";
    while ($chars != 0) {
        $pin .= rand(0,9);
        $chars--;
    }
    return $pin;
}

function toMoney($value, $sumbol='€'){
    $result = '';
    $result = number_format($value, 2)." ".$sumbol;
    $result = str_replace(',', ' ', $result);
    $result = str_replace('.', ',', $result);
    return $result;
}

function toFormat($value, $sumbol=""){
    if($value - floor($value) != 0) {
        $point = 2;
    } else {
        $point = 0;
    }
    $result = '';
    $result = number_format($value, $point).$sumbol;
    $result = str_replace(',', ' ', $result);
    $result = str_replace('.', ',', $result);
    return $result;
}

?>