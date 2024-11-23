<?php

$input_data = $rq_data -> data;
$table = $rq_data -> table;

foreach ($input_data as $key => $value){
    $data[$key] = $value;
}
crud_create($table, $data);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>