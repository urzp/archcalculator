<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$project_id = $input_data -> project_id;

$newdata['project_id'] = $project_id;
$newdata['user_id'] = $user_id;
$newdata['name'] = $input_data -> name;
$newdata['number'] = $input_data -> number;
$newdata['total'] = $input_data -> total;
$newdata['data'] = json_encode($input_data);

crud_create('project_bills', $newdata);

$selector = "`project_id`='$project_id' AND `user_id`='$user_id'";
$newProject = end(crud_read('project_bills',"*", $selector));
$id_project = $newProject['id'];

$result = (object) [
    'success' => true,
    'data' => $id_project,
];

?>