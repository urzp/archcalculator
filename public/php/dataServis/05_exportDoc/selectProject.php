<?php

$mysql = $mysql_calc;

$id = $_GET['project'];
$downLoad_token = $_GET['download_token'];
$type = $_GET['type'];

$id = $mysql->real_escape_string($id);
$downLoad_token = $mysql->real_escape_string($downLoad_token);

if($downLoad_token!=''){

$selector = "`id`='$id' AND `downLoad_token`='$downLoad_token'";
$data['project'] = crud_read('projects',"*", $selector)[0];

if(empty($data['project'])){
    $result = (object) [
        'success' => false,
    ];    
}else{
    $data['project']['customer']=json_decode( fixJsonUTF8($data['project']['customer']) );
    $data['project']['AdditionalServices']=json_decode(  fixJsonUTF8($data['project']['AdditionalServices']) );
    $data['project']['ExtraCosts']=json_decode( fixJsonUTF8( $data['project']['ExtraCosts']) );
    unset($data['project']['owner_token']);

    if(!is_array($data['project']['AdditionalServices'])) $data['project']['AdditionalServices'] = [];
    if(!is_array($data['project']['ExtraCosts'])) $data['project']['ExtraCosts'] = [];

    $selector = "`project_id` = '$id'";
    $data['objects'] = crud_read('project_objects',"*", $selector);

    foreach($data['objects'] as $key => $item ){
        foreach(json_decode( fixJsonUTF8( $item['data'] ) ) as $key_ => $item_  ){
            $data['objects'][$key][$key_] = $item_;
        }
        unset($data['objects'][$key]['data']);
    }

}



switch ($type) {
    case 'excel': include "excel/project/pexcel.php"; break;
    case 'pdf': include "pdf/project/pdf.php"; break;
}

}


?>