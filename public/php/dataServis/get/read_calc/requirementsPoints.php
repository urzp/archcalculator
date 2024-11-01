<?php
$id = $rq_data -> id;
$selector = "`id_paragraph` = '$id' ORDER BY `id` ASC, cast(`number` as unsigned) ASC";
$data = crud_read('requirementsPoints',"*", $selector);

foreach($data as $key=>$item){
    $data[$key]['value']= $item['minPoint'];
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>