<?php
$id = $rq_data -> id;
$selector = "`id_paragraph` = '$id'";
$selector = "`id_paragraph` = '$id' ORDER BY  cast(`number` as unsigned)  ASC";
$data = crud_read('feeTableHonorarZones',"*", $selector);

foreach($data as $key=>$item){
    $data[$key]['value']=$item['name'];
}

$result = (object) [
    'success' => true,
    'data' => $data,
];


?>