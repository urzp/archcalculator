<?php

$input_data = $rq_data -> data;
$id = $input_data -> id;
$value = $input_data -> list;

$newdata['requirementsPoints'] = $value;
$selector = "`object_id` = '$id'";
$mysql = $mysql_calc;
crud_update('paragraph', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>