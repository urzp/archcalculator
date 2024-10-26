<?php
$object_id = $rq_data -> data -> object_id;

$selector = "`object_id` = '$object_id'";
$mysql_  = $mysql;
$mysql = $mysql_calc;
$data = crud_read('paragraph',"*", $selector);

// if(count($data)==0){
//     $newdata['object_id'] = $object_id;
//     $newdata['paragraph_id'] = $paragraph_id;
//     crud_create('paragraph', $newdata);
// }

$data = $data[0];
$data['requirementsPoints'] = json_decode( $data['requirementsPoints'] );

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>