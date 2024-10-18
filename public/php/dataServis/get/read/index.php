<?php
$id = $rq_data -> id;

$table = $rq_data -> table;
$selector_name = $rq_data -> selector_name;
$id_selector = $rq_data -> id_selector;

$selector = "`$selector_name` = '$id_selector' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read($table,"*", $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>