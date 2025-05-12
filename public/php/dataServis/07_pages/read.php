<?php

$mysql = $mysql_calc;

$name = $rq_data ->  name;
$name = $mysql->real_escape_string($name);
$selector = "`name` = '$name'";

$data = crud_read('pages_inf', "*", $selector);
if(count($data)>0){
    $success = true;
    $data = $data[0];
    $data['content'] = htmlspecialchars_decode($data['content']);
}else{
    $success = false;
}


$result = (object) [
    'success' => $success,
    'data' => $data,
];

?>