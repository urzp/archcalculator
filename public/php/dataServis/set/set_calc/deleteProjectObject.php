<?php
    $id =  $rq_data -> data;

    $mysql = $mysql_calc;
    $selector = "`id` = '$id'";
    crud_delete('objects',$selector);

    $result = (object) [
        'success' => true,
        'data' => '',
    ];
?>