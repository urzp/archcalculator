<?php
$id = $rq_data -> data -> id;
$selector = "`id` = '$id'";

$mysql = $mysql_calc;
$data = crud_read('objects',"*", $selector);


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>