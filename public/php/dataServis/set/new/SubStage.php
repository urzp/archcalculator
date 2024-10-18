<?php

$input_data = $rq_data -> data;

foreach ($input_data as $key => $value){
    $data[$key] = $value;
}
crud_create('subStage', $data);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>