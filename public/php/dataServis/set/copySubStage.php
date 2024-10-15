<?php
$imput_data = $rq_data -> data;
$id_stage_copy = $imput_data -> id_stage_copy;
$id_stage_paste = $imput_data -> id_stage_paste;

$selector = "`id_stage` = '$id_stage_copy' ORDER BY  cast(`number` as unsigned)  ASC";
$copy_data = crud_read('subStage',"*", $selector);

foreach($copy_data as $copy_element){
    foreach ($copy_element as $key => $value){
        if($key!='id'){
            $data_element[$key] = $value;
            $data_element['id_stage'] = $id_stage_paste;
        }
    }
    crud_create('subStage', $data_element);
}


$result = (object) [
    'success' => true,
    'data' => '',
];


?>