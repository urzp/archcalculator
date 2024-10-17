<?php

$update_data = $rq_data -> data;

$table = $update_data -> table;
$parent_name = $update_data -> parent_name;
$parent_id = $update_data -> parent_id;

$index_from = (int)( $update_data -> index_from );
$colum = $update_data -> colum;

$list = $update_data -> data;

$selector = "`$parent_name` = '$parent_id'";
$allItems = crud_read($table,"*", $selector);



$data_index = 0;
foreach ($allItems as $i => $item){
    if( $i >= $index_from){
        $id = $item['id'];
        $selector = "`id`='$id'";
        $value[$colum] = $list[$data_index];
        crud_update($table, $value, $selector);
        $data_index++;
    }
}

foreach ($list as  $i =>  $item){
    if( $i >= $data_index){
        $value[$colum] = $item;
        $value[$parent_name] = $parent_id;
        crud_create($table, $value);
    }
}



$selector = "`$parent_name` = '$parent_id' ORDER BY `id` ASC, cast(`number` as unsigned)  ASC";

newOrder($newOrderData, $table, $selector);



$result = (object) [
    'success' => true,
    'data' => $selector,
];

?>