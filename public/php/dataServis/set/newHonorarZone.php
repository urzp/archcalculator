<?php

$id_paragraph = $rq_data -> data;

$selector = "`id_paragraph` = '$id_paragraph'";
$selector = "`id_paragraph` = '$id_paragraph' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('feeTableHonorarZones',"*", $selector);

if(empty($data)){
    $new_element['number']  = 0;
    $new_element['name']  = '';
    $new_element['id_paragraph'] = $id_paragraph;
    crud_create('feeTableHonorarZones', $new_element);

    $new_element['number']  = 1;
    $new_element['name']  = 'Honorarzone '.int2roman(1);
    $new_element['id_paragraph'] = $id_paragraph;
    crud_create('feeTableHonorarZones', $new_element);
}else{
    $LastElement = end($data);
    $number = (int)$LastElement['number'] + 1;
    $name = 'Honorarzone '.int2roman($number);

    $new_element['number']  = $number;
    $new_element['name']  = $name;
    $new_element['id_paragraph'] = $id_paragraph;
    crud_create('feeTableHonorarZones', $new_element);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>