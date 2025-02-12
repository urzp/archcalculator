<?php

$mysql = $mysql_calc;

$input_data = $rq_data -> data;
$id = $input_data -> id;
$id = $mysql->real_escape_string($id);
$value = $input_data -> value;
$value = $mysql->real_escape_string($value);
$type = $input_data -> type;
$type = $mysql->real_escape_string($type);

$forbiden_felds = [
    'id',
    'version',
    'created',
    'updated',
    'user_id',
    'project_id',
];

if(in_array($type, $forbiden_felds)){
    $type='';
    $result = (object) [
        'success' => false,
    ];
}else{
    $selector = "`id` = '$id' AND `user_id`='$user_id'";
    $data = crud_read('project_bills',"*", $selector)[0];
    $data = json_decode( fixJsonUTF8($data['data']) );
    
    $data -> project -> $type = $value;
    $newdata['data']=json_encode($data);
    $newdata[$type] = $value;
    
    crud_update('project_bills', $newdata, $selector);

    $result = (object) [
        'success' => true,
    ];
}

?>