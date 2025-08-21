<?php

$mysql = $mysql_calc;

$name = $rq_data ->  name;
$selector = "`name` = '$name'";
$data['content'] = $rq_data ->  content;


$find = crud_read('pages_inf', "*", $selector);
if(count($find)>0){
    crud_update('pages_inf' ,$data ,$selector );
}else{
    $data['name']=$name;
    $data['content'] = htmlspecialchars($data['content'], ENT_QUOTES);
    crud_create('pages_inf', $data);
}



$result = (object) [
    'success' => true,

];