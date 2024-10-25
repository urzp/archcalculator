<?php

$input_data = $rq_data -> data;
$id = $input_data -> id;

foreach ($input_data as $key => $value){$newdata[$key] = $value;}
$selector = "`id` = '$id'";
$mysql = $mysql_calc;
crud_update('objects', $input_data, $selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>