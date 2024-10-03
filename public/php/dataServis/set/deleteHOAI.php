<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('HOAI_versions',$selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>