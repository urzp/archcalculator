<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$project = $input_data -> project;
$project_id = $project -> id; 

$newdata['project_id'] = $project_id;
$newdata['user_id'] = $user_id;
$newdata['name'] = $project -> name;
$newdata['number'] = $project -> number;
$newdata['total'] = $project -> total;
$newdata['data'] = json_encode($input_data);
$newdata['version'] = 'v_2.0';
$newdata['payment_date'] = $project -> payment_date -> bis;
$newdata['invoice_number'] = $project -> invoice_number;

crud_create('project_bills', $newdata);

$selector = "`project_id`='$project_id' AND `user_id`='$user_id'";
$newProject = end(crud_read('project_bills',"*", $selector));
$id_project = $newProject['id'];

$result = (object) [
    'success' => true,
    'data' => $id_project,
];

?>