<?php
$imput_data = $rq_data -> data;
$id_paragraph_stage_copy = $imput_data -> id_paragraph_stage_copy;
$id_paragraph_stage_paste = $imput_data -> id_paragraph_stage_paste;
$deep = $imput_data -> deep;

$selector = "`id_paragraph` = '$id_paragraph_stage_copy' ORDER BY  cast(`number` as unsigned)  ASC";
$copy_data = crud_read('Stages',"*", $selector);

$selector = "`id_paragraph` = '$id_paragraph_stage_paste' ORDER BY  cast(`number` as unsigned)  ASC";
$old_data = crud_read('Stages',"*", $selector);
if(empty($old_data)){
    $last_stage_id = 0;
}else{
    $last_stage_id = end($old_data)['id'];
}

foreach($copy_data as $copy_element){
    $data_element = [];
    foreach ($copy_element as $key => $value){
        if($key!='id'){
            $data_element[$key] = $value;
            $data_element['id_paragraph'] = $id_paragraph_stage_paste;
        }
    }
    crud_create('Stages', $data_element);
}


if($deep){

    $selector = "`id_paragraph` = '$id_paragraph_stage_paste' AND `id`>'$last_stage_id'  ORDER BY  cast(`number` as unsigned)  ASC";
    $coped_stages = crud_read('Stages',"*", $selector);
    foreach($copy_data as $index=>$stage){
        $id_stage_copy = $stage['id'];
        $selector = "`id_stage` = '$id_stage_copy' ORDER BY  cast(`number` as unsigned)  ASC";
        $copy_data_subStage = crud_read('subStage',"*", $selector);
        
        foreach($copy_data_subStage as $copy_element){
            $data_element = [];
            $id_stage = $coped_stages[$index]['id'];
            foreach ($copy_element as $key => $value){
                if($key!='id'){
                    $data_element[$key] = $value;
                    $data_element['id_stage'] = $id_stage;
                }
            }
            crud_create('subStage', $data_element);
            $selector = "`id_stage` = '$id_stage' ORDER BY `id` ASC, cast(`number` as unsigned)  ASC";
            newOrder($newOrderData, 'subStage', $selector);
        }
    }

}

$selector = "`id_paragraph` = '$id_paragraph_stage_paste' ORDER BY `id` ASC, cast(`number` as unsigned)  ASC";
newOrder($newOrderData, 'Stages', $selector);



$result = (object) [
    'success' => true,
    '$data' => $selector ,
];


?>