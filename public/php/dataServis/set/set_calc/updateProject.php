<?php

$input_data = $rq_data -> data;
$id = $input_data -> id;
include 'json_encode.php';

$selector = "`id` = '$id'";
$mysql = $mysql_calc;
crud_update('projects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>