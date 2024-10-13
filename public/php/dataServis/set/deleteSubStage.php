<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";

$data = crud_read('subStage',"*", $selector);
$id_stage = $data['id_stage'];

crud_delete('subStage',$selector);

$selector = "`id_stage` = '$id_stage' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('subStage',"*", $selector);

foreach($data as $key=>$item){
    $number = $key + 1;
    $id = $item['id'];
    $selector = "`id` = '$id'";
    $update['number']=$number;
    crud_update('subStage', $update, $selector);
}



$result = (object) [
    'success' => true,
    'data' => '',
];

?>