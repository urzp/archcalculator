<?php

$mysql = $mysql_calc;

$type = $rq_data ->  type;

if(isset($type)&&$type!='all') {
    $type = $mysql->real_escape_string($type);
    $selector = "`user_id`='$user_id' AND `status`='$type'";
}else{
    $selector = "`user_id`='$user_id'";
}

$collums = " `id`, `name` ,`created` , `updated`, `total` ";
$data = crud_read('projects',$collums, $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>