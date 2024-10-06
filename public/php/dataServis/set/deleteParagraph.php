<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('paragraphs',$selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>