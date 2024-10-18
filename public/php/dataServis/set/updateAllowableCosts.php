<?php

$update_data = $rq_data -> data;

$id = $update_data  -> id;
$selector = "`id` = '$id'";


foreach ($update_data as $key => $value){
    $data[$key] = $value;
}


$sql = crud_update('allowableCosts', $data, $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>