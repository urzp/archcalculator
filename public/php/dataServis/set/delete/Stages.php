<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";

$data = crud_read('Stages',"*", $selector);
$id_paragraph = $data['id_paragraph'];

crud_delete('Stages',$selector);

$selector = "`id_paragraph` = '$id_paragraph' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('Stages',"*", $selector);

foreach($data as $key=>$item){
    $number = $key + 1;
    $id = $item['id'];
    $selector = "`id` = '$id'";
    $update['number']=$number;
    crud_update('Stages', $update, $selector);
}



$result = (object) [
    'success' => true,
    'data' => '',
];

?>