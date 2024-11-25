<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id;
include 'json_encode.php';

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

crud_update('projects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>