<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id_save;
$owner_token = $input_data -> owner_token;
if($owner_token=='') $owner_token = '-1';
include $_SERVER['DOCUMENT_ROOT'].'/php/dataServis/03_projects/01_Project/json_encode.php';

$id = $mysql->real_escape_string($id);
$owner_token = $mysql->real_escape_string($owner_token);
$selector = "`id` = '$id' AND `user_id`='-1' AND `owner_token`='$owner_token'";

unset($newdata['id']);
unset($newdata['created']);
unset($newdata['updated']);
unset($newdata['user_id']);
unset($newdata['unsaved']);
unset($newdata['id_save']);

crud_update('projects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => $newdata,
];

?>