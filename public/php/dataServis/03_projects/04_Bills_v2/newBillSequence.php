<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;

$i=0;
foreach($input_data as $key => $item){
    $i++;
    $id = $item -> id;
    $id = $mysql->real_escape_string($id);
    $newdata['number'] = $i;
    $selector = "`id` = '$id' AND `user_id`='$user_id'";
    crud_update('project_bills', $newdata, $selector);
}

$result = (object) [
    'success' => true,
];

?>