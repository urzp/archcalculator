<?php

$id = $rq_data -> id;
$value = $rq_data -> value;

$data['value']=$value;
$selector = "`id` = '$id'";
crud_update('HOAI_versions', $data, $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>