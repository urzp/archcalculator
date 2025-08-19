<?php

$input_data = $rq_data -> data;
$id = $input_data->id;
$key = $input_data->key;
$value = $input_data->value;

$selector = "`id`='$id'";

if($key=='data'){
    $updateData[$key]=json_encode($value);
}else{
    $updateData[$key]=$value;
}

crud_update('tariffs', $updateData, $selector);

$result = (object) [
    'success' => true,
    'data' => $updateData,
];

?>