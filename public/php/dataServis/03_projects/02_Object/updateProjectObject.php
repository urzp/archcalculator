<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id;
$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$newdata['project_id'] = $input_data -> project_id;
$newdata['user_id'] = $user_id;
$newdata['name'] = $input_data -> name;
$newdata['number'] = $input_data -> number;
$newdata['data'] = json_encode($input_data);

crud_update('project_objects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => $input_data,
];

?>