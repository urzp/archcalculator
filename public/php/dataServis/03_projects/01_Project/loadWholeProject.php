<?php
$mysql = $mysql_calc;

$id = $rq_data ->  id;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";


$data['project'] = crud_read('projects',"*", $selector)[0];
if(empty($data['project'])){
    $result = (object) [
        'success' => false,
    ];    
}else{
    $data['project']['customer']=json_decode( fixJsonUTF8($data['project']['customer']) );
    $data['project']['AdditionalServices']=json_decode(  fixJsonUTF8($data['project']['AdditionalServices']) );
    $data['project']['ExtraCosts']=json_decode( fixJsonUTF8( $data['project']['ExtraCosts']) );

    if(!is_array($data['project']['AdditionalServices'])) $data['project']['AdditionalServices'] = [];
    if(!is_array($data['project']['ExtraCosts'])) $data['project']['ExtraCosts'] = [];

    $selector = "`project_id` = '$id' AND `user_id`='$user_id'";
    $data['objects'] = crud_read('project_objects',"*", $selector);

    foreach($data['objects'] as $key => $item ){
        foreach(json_decode( fixJsonUTF8( $item['data'] ) ) as $key_ => $item_  ){
            $data['objects'][$key][$key_] = $item_;
        }
        unset($data['objects'][$key]['data']);
    }

    $result = (object) [
        'success' => true,
        'data' => $data,
    ];
}




?>