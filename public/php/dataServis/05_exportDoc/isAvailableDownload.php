<?php
$type = $rq_data -> data -> type;
$id = $rq_data -> data -> id_download_project;
$id = $mysql->real_escape_string($id);

if($type==''||$type=='project') $type='projects';
if($type=='bill') $type='project_bills';

$downLoad_token = $rq_data -> data -> download_token;
$downLoad_token = $mysql->real_escape_string($downLoad_token);

$selector = "`id` = '$id' AND `downLoad_token`='$downLoad_token'";
$result = crud_read($type,"id", $selector)[0];
$result=isset($result);

$result = (object) [
    'success' => $result,
];

?>