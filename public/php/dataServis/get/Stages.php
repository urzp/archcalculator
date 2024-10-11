<?php
$id = $rq_data -> id;
$selector = "`id_paragraph` = '$id'";
$selector = "`id_paragraph` = '$id' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('Stages',"*", $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>