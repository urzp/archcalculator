<?php
$mysql = $mysql_calc;

$input_data = $rq_data -> data;

foreach($input_data as $key => $item){
    $id = $item -> id;
    $newdata['number'] = $item -> number;
    $selector = "`id` = '$id' AND `user_id`='$user_id'";
    crud_update('project_bills', $newdata, $selector);

}

$result = (object) [
    'success' => true,
];

?>