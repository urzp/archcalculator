<?php

$update_data = $rq_data -> data;

$id = $update_data  -> id_paragraph;
$selector = "`id_paragraph` = '$id'";

foreach ($update_data as $key => $value){
    $data[$key] = $value;
}

crud_update('feeTableTypeValue', $data, $selector);


$result = (object) [
    'success' => true,
    'data' => '',
];

?>