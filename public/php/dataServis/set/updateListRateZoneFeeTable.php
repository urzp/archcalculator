<?php

$update_data = $rq_data -> data;

foreach ($update_data as $key => $item){
    $id = $item  -> id;
    $selector = "`id` = '$id'";
    $data['value'] = $item -> value;
    $sql = crud_update('feeTableHonorarZonesRateValue', $data, $selector);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];
