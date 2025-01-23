<?php



$id = $rq_data -> id;
$id = $mysql->real_escape_string($id);

$selector = "`id` = '$id' AND `user_id`='$user_id'";
$downLoad_token = crud_read('project_bills',"downLoad_token", $selector)[0]['downLoad_token'];
if($downLoad_token==''){
    $downLoad_token = GeneratePinCode(20);
    $newdata['downLoad_token'] = $downLoad_token;
    crud_update('project_bills', $newdata, $selector);
}

$result = (object) [
    'success' => true,
    'downLoad_token' => $downLoad_token,
];

?>