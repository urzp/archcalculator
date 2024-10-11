<?php

$id_paragraph = $rq_data -> data;

$selector = "`id_paragraph` = '$id_paragraph'";
$selector = "`id_paragraph` = '$id_paragraph' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('feeTableHonorarZones',"*", $selector);

if(!empty($data)){
    $LastElement = end($data);
    $id = $LastElement['id'];
    $selector = "`id` = '$id'";
    crud_delete('feeTableHonorarZones',$selector);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>