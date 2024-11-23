<?php

$update_data = $rq_data -> data;
$table = $rq_data -> table;

$id = $update_data  -> id;
$selector = "`id` = '$id'";


foreach ($update_data as $key => $value){
    $data[$key] = $value;
}


$sql = crud_update($table, $data, $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>