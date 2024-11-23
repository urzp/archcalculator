<?php

$id = $rq_data -> data;
$table = $rq_data -> table;

$selector = "`id` = '$id'";
crud_delete($table, $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>