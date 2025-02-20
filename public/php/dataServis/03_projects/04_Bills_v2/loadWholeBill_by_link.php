<?php
$mysql = $mysql_calc;

$id = $rq_data -> data -> id;
$downLoad_token = $rq_data -> data -> download_token;

$id = $mysql->real_escape_string($id);
$downLoad_token = $mysql->real_escape_string($downLoad_token);
$selector = "`id` = '$id' AND `downLoad_token`='$downLoad_token'";

$data['project'] = crud_read('project_bills',"*", $selector)[0];

if(empty($data['project'])){
    $result = (object) [
        'success' => false,
    ];    
}else{

    $data = json_decode( fixJsonUTF8($data['project']['data']) );

    $result = (object) [
        'success' => true,
        'data' => $data,
    ];
}




?>