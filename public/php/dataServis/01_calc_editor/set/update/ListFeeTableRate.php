<?php

$list = $rq_data -> data;

foreach ($list as $key => $item){
    $data = [];
    if($item->id=='new'){
        $data['id_paragraph'] = $item -> id_paragraph;
        $data['number'] = $item -> number;
        $data['value'] = $item -> value;
        crud_create('feeTableRateValue', $data);
    }else{
        $id = $item -> id;
        $selector = "`id` = '$id'";
        $data['value'] = $item -> value;
        crud_update('feeTableRateValue', $data, $selector);
    }
    
}

$result = (object) [
    'success' => true,
    'data' => '',
];

?>