<?php

$data = $rq_data -> data;
$selector = " `id` = '$user_id' AND `token` = '$token' ";

$key = $data -> key;
$value = $data -> value;

$forbiden = [
    'id',
    'password',
    'token',
    'resetCode',
    'level',
    'subscription',
];


if(!(in_array($key, $forbiden))){
    $new_data[$key]=$value;
    if($key=='data'){
        $new_data[$key] = json_encode($value);
    }
    crud_update('users', $new_data, $selector);
    $result = (object) [
        'success' => true,
    ];
}else{
    $result = (object) [
        'success' => false,
    ];   
}



?>