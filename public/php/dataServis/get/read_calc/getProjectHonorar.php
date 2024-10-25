<?php
$id = $rq_data -> data -> id;
$selector = "`object_id` = '$id'";

$mysql = $mysql_calc;
$data = crud_read('paragraph',"*", $selector);


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>