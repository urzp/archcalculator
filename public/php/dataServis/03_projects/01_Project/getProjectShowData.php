<?php
$mysql = $mysql_calc;
$id = $rq_data ->  id;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$project_feelds = " `id`, `created`, `name`, `total` ";
$data['project'] = crud_read('projects',$project_feelds , $selector)[0];

$object_feelds = "`id`, `name`, `total_object` ";
$selector = "`project_id` = '$id' AND `user_id`='$user_id'";
$data['objects'] = crud_read('project_objects',$object_feelds, $selector);

$data['bills'] = [];

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>