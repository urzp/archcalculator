<?php
$mysql = $mysql_calc;
$project = $rq_data -> data -> project;
$object = $rq_data -> data -> objects;
$object = $object[0];

$data['user_id']=$user_id;
$data['name'] = $project -> name;
crud_create('projects', $data);

$selector = "`user_id`='$user_id'";
$newProject = end(crud_read('projects',"*", $selector));
$id = $newProject['id'];

$object -> project_id = $id;

$obj_data['project_id'] = $id;
$obj_data['user_id'] = $user_id;
$obj_data['name'] = $object -> name;
$obj_data['number'] = $object -> number;
$obj_data['data'] = json_encode($object);

crud_create('project_objects', $obj_data);


$result = (object) [
    'success' => true,
    'data' => $id,
];

?>