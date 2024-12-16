<?php

function int2roman($n) {
    $M = ["","M","MM","MMM"];
    $C = ["","C","CC","CCC","CD","D","DC","DCC","DCCC","CM"];
    $X = ["","X","XX","XXX","XL","L","LX","LXX","LXXX","XC"];
    $I = ["","I","II","III","IV","V","VI","VII","VIII","IX"];

    return sprintf('%s%s%s%s', $M[$n/1000],$C[($n % 1000)/100],$X[($n % 100)/10],$I[($n % 10)]);
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

?>