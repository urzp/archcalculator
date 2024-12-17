<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id;
$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$newdata['name'] = $input_data -> name;
$newdata['number'] = $input_data -> number;
$newdata['total'] = $input_data -> total;
$newdata['data'] = json_encode($input_data);

unset($newdata['id']);
unset($newdata['created']);
unset($newdata['updated']);
unset($newdata['project_id']);
unset($newdata['user_id']);

crud_update('project_bills', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => $input_data,
];

?>