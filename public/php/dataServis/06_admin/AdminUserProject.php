<?php

$id = $rq_data ->  id;

$mysql = $mysql_calc;
$selector = "`user_id` = '$id'";
$collums='id, created, user_id, status, name, downLoad_token';
$projects = crud_read('projects', $collums, $selector);

foreach($projects as $key=>$item){
    $id_project = $item['id'];
    $selector="`project_id`='$id_project'";
    $projects[$key]['bills'] = crud_count('project_bills', $selector);
}


$result = (object) [
    'success' => true,
    'projects' => $projects,
];

?>