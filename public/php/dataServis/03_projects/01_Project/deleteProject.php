<?php

$mysql = $mysql_calc;
$id = $rq_data ->  id;
$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

crud_delete('projects',$selector);

$selector = "`project_id` = '$id' AND `user_id`='$user_id'";
crud_delete('project_objects',$selector);

$result = (object) [
    'success' => true,
];


?>