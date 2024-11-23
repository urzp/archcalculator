<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('HOAI_versions',$selector);

$selector = " true ORDER BY cast(`sequence` as unsigned) ASC";
$data = crud_read('HOAI_versions',"*", $selector);

foreach ($data as $key => $item){
    $id = $item['id'];
    $selector = "`id` = '$id'";
    $udateData['sequence'] = $key + 1;
    crud_update('HOAI_versions', $udateData, $selector);
}


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>