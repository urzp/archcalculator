<?php
$input_data = $rq_data -> data;
include 'json_encode.php';

$mysql = $mysql_calc;
crud_create('objects', $newdata);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>