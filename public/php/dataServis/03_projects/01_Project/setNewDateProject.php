<?php

$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id;
$date = $input_data -> date;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$time = strtotime($date);
$newformat = date('Y-m-d',$time);
$newdata['created'] = $newformat;


crud_update('projects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>