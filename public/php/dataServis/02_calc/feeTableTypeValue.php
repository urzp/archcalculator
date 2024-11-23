<?php
$id = $rq_data -> id_paragraph;
$selector = "`id_paragraph` = '$id'";
$selector = "`id_paragraph` = '$id'";
$data = crud_read('feeTableTypeValue',"*", $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>