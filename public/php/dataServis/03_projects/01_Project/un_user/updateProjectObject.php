<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data -> obj;
$id = $input_data -> id;

$project_id = $rq_data -> project_id;

$number = $input_data('number');

$id = $mysql->real_escape_string($id);
$project_id = $mysql->real_escape_string($project_id);
$number = $mysql->real_escape_string($number);

$selector = "`id` = '$id' AND `user_id`='-1' AND `project_id`='$project_id' AND `number`='$number'";

$newdata['name'] = $input_data -> name;
$newdata['number'] = $input_data -> number;
$newdata['total_object'] = $input_data -> total_object;
$newdata['data'] = json_encode($input_data);

unset($newdata['id']);
unset($newdata['created']);
unset($newdata['updated']);
unset($newdata['project_id']);
unset($newdata['user_id']);

crud_update('project_objects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => $input_data,
];

?>