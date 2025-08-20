<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data->id;
$key = $input_data->key;
$value = $input_data->value;

$selector = "`id`='$id'";

$updateData[$key]=$value;

crud_update('settings', $updateData, $selector);

$result = (object) [
    'success' => true,
];
?>