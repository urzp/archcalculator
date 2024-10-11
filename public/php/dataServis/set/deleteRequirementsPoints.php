<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('requirementsPoints',$selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>