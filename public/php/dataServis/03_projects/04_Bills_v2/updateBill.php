<?php

$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$project = $input_data -> project;
$id = $project -> id;
$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$newdata['name'] = $project -> name;
$newdata['number'] = $project -> number;
$newdata['total'] = $project -> total;
$newdata['data'] = json_encode($input_data);
$newdata['payment_date_vom'] = $project -> payment_date -> vom;
$newdata['payment_date_bis'] = $project -> payment_date -> bis;
$newdata['invoice_number'] = $project -> invoice_number;

unset($newdata['id']);
unset($newdata['created']);
unset($newdata['updated']);
unset($newdata['project_id']);
unset($newdata['user_id']);

crud_update('project_bills', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => $input_data,
];



?>