<?php
$mysql = $mysql_calc;

$id = $rq_data ->  id;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";


$data['project'] = crud_read('projects',"*", $selector)[0];
$data['project']['AdditionalServices']=json_decode($data['project']['AdditionalServices']);
$data['project']['ExtraCosts']=json_decode($data['project']['ExtraCosts']);

$selector = "`project_id` = '$id' AND `user_id`='$user_id'";
$data['objects'] = crud_read('project_objects',"*", $selector);

foreach($data['objects'] as $key => $item ){
    foreach(json_decode( $item['data'] ) as $key_ => $item_  ){
        $data['objects'][$key][$key_] = $item_;
    }
    unset($data['objects'][$key]['data']);
}


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>