<?php
$id = $rq_data -> id;
$selector = "`id_stage` = '$id'";
$selector = "`id_stage` = '$id' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('subStage',"*", $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>