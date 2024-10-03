<?php

$value = $rq_data -> data;

$data['value'] = $value;
crud_create('HOAI_versions', $data);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>