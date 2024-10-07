<?php

$incom_data = $rq_data -> data;

foreach ($incom_data as $key => $value){
    $data[$key] = $value;
}
crud_create('feeTableHonorarZones', $data);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>