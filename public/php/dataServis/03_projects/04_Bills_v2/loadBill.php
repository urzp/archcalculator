<?php
$mysql = $mysql_calc;

$id = $rq_data ->  id;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$data = crud_read('project_bills',"*", $selector)[0];

if(empty($data)){
    $result = (object) [
        'success' => false,
    ];    
}else{
    $data = json_decode( fixJsonUTF8($data['data']) );
    $result = (object) [
        'success' => true,
        'selector' => $selector,
        'data' => $data,
    ];

}


?>