<?php
$data = $rq_data -> data;

$table = $data -> table;
$selector_name = $data -> selector_name;
$id_selector = $data -> selector;

$selector = "`$selector_name` = '$id_selector' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read($table,"*", $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>