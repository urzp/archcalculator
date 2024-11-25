<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;

$newdata['project_id'] = $input_data -> project_id;
$newdata['user_id'] = $user_id;
$newdata['name'] = $input_data -> name;
$newdata['number'] = $input_data -> number;
$newdata['data'] = json_encode($input_data);

crud_create('project_objects', $newdata);

$result = (object) [
    'success' => true,
    'data' => $newdata,
];

?>