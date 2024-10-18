<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('allowableCosts',$selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>