<?php

$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id;
$name = $input_data -> name;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$newdata['name'] = $name;
$jsonData['name'] = 'name';
$jsonData['value'] = $name;
$sql = crud_update('project_objects', $newdata, $selector, 'data', $jsonData);

$result = (object) [
    'success' => true,
    'data' => $sql,
];

?>