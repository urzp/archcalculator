<?php
$mysql = $mysql_calc;
$project = $rq_data -> data -> project;
$objects = $rq_data -> data -> objects;
$user_id = '-1';
$downLoad_token = generatePinCode(20);
$owner_token = generatePinCode(20);

$data['user_id']=$user_id;
$data['name'] = $project -> name;
$data['discription'] = $project -> discription;
$data['customer'] = json_encode($project -> customer);
$data['total_AdditionalServices'] = $project -> total_AdditionalServices;
$data['total_ExtraCosts'] = $project -> total_ExtraCosts;
$data['tax'] = $project -> tax;
$data['total_tax'] = $project -> total_tax;
$data['total_net'] = $project -> total_net;
$data['total'] = $project -> total;
$data['downLoad_token'] = $downLoad_token;
$data['owner_token'] = $owner_token;

crud_create('projects', $data);

$selector = "`user_id`='$user_id'";
$newProject = end(crud_read('projects',"*", $selector));
$id_project = $newProject['id'];

$return_data['project'] = $id_project;
$return_data['objects'] = [];

foreach($objects as $item){
    $obj_data = [];
    $obj_data['project_id'] = $id_project;
    $obj_data['user_id'] = $user_id;
    $obj_data['name'] = $item -> name;
    $obj_data['number'] = $item -> number;
    $obj_data['total_object'] = $item -> total_object;

    $item -> project_id = $id_project;
    $obj_data['data'] = json_encode($item);
    crud_create('project_objects', $obj_data);

    $newObject = end(crud_read('project_objects',"*", $selector));
    $id_object = $newObject['id'];
    array_push($return_data['objects'],$id_object);
}

$return_data['downLoad_token'] = $downLoad_token;
$return_data['owner_token'] = $owner_token;

$result = (object) [
    'success' => true,
    'data' => $return_data,
];

?>