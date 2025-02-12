<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$project = $input_data -> project;
$project_id = $project -> id; 
$project_number = $project -> number;

$selector = "`project_id`='$project_id' AND `user_id`='$user_id' AND `version`='v_2.0' ORDER BY `number`";
$data_['bills'] = crud_read('project_bills',"id, number", $selector);

$i=0;
foreach($input_data as $key => $item){
    $i++;
    if($i==$project_number) $i++;
    $id = $item -> id;
    $id = $mysql->real_escape_string($id);
    $newdata['number'] = $i;
    $selector = "`id` = '$id' AND `user_id`='$user_id'";
    crud_update('project_bills', $newdata, $selector);
}

unset($input_data->bills);

$newdata['project_id'] = $project_id;
$newdata['user_id'] = $user_id;
$newdata['name'] = $project -> name;
$newdata['number'] = $project -> number;
$newdata['total'] = $project -> total;
$newdata['data'] = json_encode($input_data);
$newdata['version'] = 'v_2.0';
$newdata['payment_date_vom'] = $project -> payment_date -> vom;
$newdata['payment_date_bis'] = $project -> payment_date -> bis;
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