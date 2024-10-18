<?php
$id = $rq_data -> id;
$selector = "`id_paragraph` = '$id' ORDER BY `id` ASC, cast(`number` as unsigned) ASC";
$data = crud_read('allowableCosts',"*", $selector);

foreach($data as $key=>$item){
    $data[$key]['number']= $key + 1;
    $id = $item["id"];

    $update = [];
    $selector = "`id`='$id'";
    $update['number'] = $key + 1;
    crud_update('allowableCosts', $update, $selector);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>